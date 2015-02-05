<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'HighCharts.HighCharts');

	public $helpers = array('Js' => 'Jquery');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
		//$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
		if ($this->request->is("ajax")) {
			$this->layout = 'ajax';
			//$this->view = 'table';
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * Login method
 *
 * @return void
 */
	public function login() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				// Find managements associated with user
				$username = $this->Auth->user('username');
				$man = $this->_getManagements($username);
				$user2=$this->User->findByUsername($username);
				$role=$user2['Group']['role'];
			
				$employeeId = $this->_getEmployeeId($username);
				$this->Session->write('Auth.User.employeeId', $employeeId);
				$this->Session->write('Auth.User.management', $man);
				$this->Session->write('Auth.User.role', $role);

				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Your username or password was incorrect.'), 'flash', array ('class' => 'error'));
		}

		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash(__('You are logged in!'), 'flash', array ('class' => 'warning'));
			return $this->redirect('/');
		}
	}

/**
 * Logout method
 *
 * @return void
 */
	public function logout() {
		$this->Session->setFlash('Good-Bye');
		$this->Session->setFlash(__('Good-bye'), 'flash', array ('class' => 'success'));
		$this->redirect($this->Auth->logout());
	}

/**
 * Called before the controller action.
 *
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers.html#request-life-cycle-callbacks
 */
	public function beforeFilter() {
		parent::beforeFilter();
		// We can remove this line after we're finished
		//$this->Auth->allow('initDB', 'login', 'import', 'rebuildARO');
	}

/**
 * Fields from to be setted on Users table
 * @access private
 * @var string 
 **/
	private $ldap_to_model = array (
		'samaccountname' => 'username', 
		'givenname' => 'firstname', 
		'sn' => 'lastname', 
		'mail' => 'email', 
		'department' => 'department'
	);

/**
 * Import users from LDAP
 *
 * Import users from LDAP using YALP Plugin and save them on Users table, 
 * if users already exist will be updated
 *
 * @return void
 **/
	public function import() {

		if ($this->request->is('post')) {

			$group = $this->request->data('User.group');
			$user = $this->request->data('User.user');

			$tempData = $this->_getLDAP($group, $user);

			if (isset($tempData) && ! empty($tempData)) {

				$usernames = $tempData['usernames'];
				$tempData = $tempData['data'];

				$this->User->recursive = -1;
				// Finding users already in database
				$currentData = $this->User->find('list', array(
					'conditions' => array ('User.username' => array_values($usernames)), 
					'fields' => array('User.username', 'User.id')
				));

				$updated = 0;
				// Setting id for exiting users
				foreach ($usernames as $key => $value) {
					if (isset($currentData[$value])) {
						$tempData[$key][$this->modelClass]['id'] = $currentData[$value];
						$updated++;
					} else {
						$tempData[$key][$this->modelClass]['group_id'] = $this->Session->read('Options.defaultGroup');
					}
				}
				// Added users vs updated users
				$added = sizeof($tempData) - $updated;

				// Saving
				if ($this->User->saveMany($tempData, array('fields' => array_values($this->ldap_to_model)))) {
					$this->Session->setFlash(__('Import successful. %s users were added and %s users were updated.', $added, $updated), 'flash', array ('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Users could not be imported, check the group name and try again.'), 'flash', array ('class' => 'error'));

				} // No save 

			} else {
				$this->Session->setFlash(__('No users were found, check the group name and try again.'), 'flash', array ('class' => 'warning'));
			} // No users were found
			
		} // No post request

		if ($this->request->is('ajax'))
		{
			$group = $this->request->data('group');
			$user = $this->request->data('user');
			
			$output = $this->_getLDAP($group, $user);

			$output = isset($output['data']) ? $output['data'] : array();

			$this->layout = 'ajax';

			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('data', $output);

			$this->set("_serialize", array('data'));

			/*$this->autoRender = false;
			$this->render('json');*/
		}

	} // End import function

	// DELETE FROM users WHERE username not in ('bc211366', 'user1', 'user2', 'user3'); ALTER TABLE users AUTO_INCREMENT=4;

/**
 * Get users from LDAP using YALP Plugin
 *
 * Query users from LDAP using group and user filters if provided,
 * the original array is parsed to meet CakePHP save methods.
 *
 * @return array Usernames and users array parsed according to CakePHP needs.
 **/
	public function _getLDAP($group = NULL, $user = NULL) {

		App::uses('YalpUtility', 'YALP.Lib'); $yalp = new YalpUtility();

		$users = (isset($group)) ? $yalp->getUsers($group, $user) : null;

		if (isset($users) && !empty($users)) {
			// Parsing data to model structure
			$usernames = $data = array();
			foreach ($users as $key => $user) {

				foreach ($user as $ldapField => $value) {
					$modelField = $this->ldap_to_model[$ldapField];
					$data[$key][$this->modelClass][$modelField] = $value;
					if ($modelField == 'username')
					{
						//$existingID = $this->User->field('id', array('User.username' => $value));
						//$data[$key][$this->modelClass]['id'] = ($existingID) ? $existingID : NULL;
						$usernames[$key] = $value;
					}
				}
			}
			return compact(array('data', 'usernames'));
		}
	}

/**
 * profile method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function profile($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		// Check for an associated employee
		$this->loadModel('Employee');
		$e_options = array('conditions' => array('Employee.bc' => $user['User']['username'] ));
		$employee = $this->Employee->find('first', $e_options);

		$this->set(compact('user', 'employee'));
	}

	public function initDB() {
		$group = $this->User->Group;
		//Allow admins to everything
		//$group->id = 1;
		//$this->Acl->allow($group, 'controllers');

		$group->role = 1;
		$this->Acl->deny($group, 'controllers/Respondents/add');

		
		//allow managers to posts and widgets
		/*$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');
		$this->Acl->allow($group, 'controllers/Widgets');*/
		
		//allow users to only add and edit on posts and widgets
		/*$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts/add');
		$this->Acl->allow($group, 'controllers/Posts/edit');
		$this->Acl->allow($group, 'controllers/Widgets/add');
		$this->Acl->allow($group, 'controllers/Widgets/edit');*/
		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}

	function rebuildARO() {
		// Build the groups.
		$this->loadModel('Group');
		$groups = $this->Group->find('all');
		$aro = new Aro();
		foreach($groups as $group) {
			$aro->create();
			$aro->save(array(
				'alias'=>$group['Group']['name'],
				'foreign_key' => $group['Group']['id'],
				'model'=>'Group',
				'parent_id' => null
			));
		}
	 
		// Build the users.
		$users = $this->User->find('all');
		$i=0;
		foreach($users as $user) {
			$aroList[$i++]= array(
				'alias' => $user['User']['username'],
				'foreign_key' => $user['User']['id'],
				'model' => 'User',
				'parent_id' => $user['User']['group_id']
			);	
		}
		foreach($aroList as $data) {
			$aro->create();
			$aro->save($data);
		}
	 
		echo "AROs rebuilt!";
		exit;
	}

	public function updatePermissions() {

		$perms =  isset($this->request->data['Perms']) ? $this->request->data['Perms'] : array();
		foreach ($perms as $aco => $aros) {
			$action = str_replace(":", "/", $aco);
			foreach ($aros as $node => $perm) {
				list($model, $id) = explode(':', $node);
				$node = array('model' => $model, 'foreign_key' => $id);
				if ($perm == 'allow') {
					$result = $this->Acl->allow($node, $action);
				}
				elseif ($perm == 'inherit') {
					$result = $this->Acl->inherit($node, $action);
				}
				elseif ($perm == 'deny') {
					$result = $this->Acl->deny($node, $action);
				}
			}
		}

		$response = array();
		if ($result) {
			$response['status'] = 'success';
			$response['data'] = array('message' => __('The permisions have been setted'));
		} else {
			$response['status'] = 'error';
			$response['data'] = array('message' => __('The permissions could not be setted.'));
		}
		$response['data']['check'] = $this->Acl->check($node, $action);

		if ($this->request->is('ajax')) {

			$this->layout = 'ajax';

			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('status', $response['status']);
			$this->set('data', $response['data']);

			$this->set("_serialize", array('status', 'data'));
		}

	}

} // End of class
