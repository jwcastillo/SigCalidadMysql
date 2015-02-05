<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
			'Acl',
			'Auth' => array(
					'authorize' => array(
							'Actions' => array('actionPath' => 'controllers')
					)
			),
			'Session',
			'Common', 
			'RequestHandler', 
			'Paginator', /*'DebugKit.Toolbar'*/
	);

	public $helpers = array('Html', 'Form', 'Charisma', 'Session', 
		'MenuBuilder.MenuBuilder' => array(
			//'activeClass' => 'active',
			//'firstClass' => 'first-item',
			//'childrenClass' => 'has-children',
			'menuClass' => 'nav nav-tabs nav-stacked',
			//'evenOdd' => false,
			//'itemFormat' => '<li%s>%s%s</li>',
			//'wrapperFormat' => '<ul%s>%s</ul>',
			//'wrapperClass' => null,
			'noLinkFormat' => '%s',
			//'menuVar' => 'menu',
			'authVar' => 'auth',
			'authModel' => 'User',
			'authField' => 'role',
			//'indentHtmlOutput' => true,
		)
	);

/**
 * Called before the controller action.
 *
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers.html#request-life-cycle-callbacks
 */
	public function beforeFilter() {
		
		//Configure AuthComponent
		$this->Auth->loginAction = array(
			'plugin' => false, 
			'controller' => 'users',
			'action' => 'login'
			);
		$this->Auth->logoutRedirect = array(
			'plugin' => false, 
			'controller' => 'users',
			'action' => 'login'
			);
		$this->Auth->loginRedirect = '/';

		$this->Auth->authError = __('You are not authorized to access that location.');
		//$this->Auth->loginError = __('Invalid Username or Password entered, please try again.');
		$this->Auth->flash = array(
			'element' => 'flash',
			'key' => 'auth',
			'params' => array('class' => 'warning')
		);

		// If YALP not loaded then use Form Auth
		if (CakePlugin::loaded('YALP'))
			$this->Auth->authenticate = array('YALP.LDAP' => null);
		// We can remove this line after we're finished
		//$this->Auth->allow();

		$this->layout = 'charisma';
		$this->paginate = array(
				'limit' => 25
		);
		$this->_loadOptions();
		//$this->_fakeSession();

		// Disable Compatibility View in IE
		if ($this->Common->isIE())
			$this->response->header('X-UA-Compatible', 'IE=9; IE=8; IE=7; IE=EDGE');

		// Menu
		$this->_getMenu();

		parent::beforeFilter();
	}

	/*function isAuthorized($user) {
		//return $this->Auth->loggedIn();
		return true;
	}*/

	protected function _loadOptions() {
		if (/*!$this->Session->check('Options')*/true) { // FIXME: Do not force true
			// Regular Options
			$this->loadModel('Options');
			$o = $this->Options->find('list', array('fields' => array('key', 'value')));
			$this->Session->write('Options', $o);
			// Set Managers
			$this->loadModel('QualityManager');
			$managers = $this->QualityManager->recursive = -1;
			$managers = $this->QualityManager->find('all', 
				array('fields' => array('DISTINCT(QualityManager.employee_id) AS manager'), 
					'order' => array('QualityManager.id')));
			
			$managers = Hash::extract($managers, '{n}.QualityManager.manager');

			$this->Session->write('Options.managers', $managers);
		}
	}
	
	private function _fakeSession() {
		$auth=array(
			'User' => array(
				'id' => '8',
				'username' => 'bc211041',
				'firstname' => 'Angie',
				'lastname' => 'Uzcategui',
				'email' => 'JCastillo@bancaribe.com.ve',
				'department' => 'Gerencia de Proyectos de Auditoria de Calidad IT',
				'group_id' => '3',
				'created' => '2014-01-31 23:06:30',
				'modified' => '2014-01-31 23:06:30',
				'employeeId' => '3',
				//'management' => array(2),
				'management' => array('2', '4'),
		));

		$this->Session->write('Auth', $auth);
	}

	/**
	 * Get Managements associeted with a User
	 *
	 * @return array|string containing managements
	 **/
	protected function _getManagements($username) {
		$this->loadModel('QualityManager');
		$this->loadModel('Employee');
		$options = array(
			'fields' => array(
				'QualityManager.management_id',
			),
			'contain' => array('Employee'),
			'conditions' => array('Employee.bc' => $username)
		);
		$qm = $this->QualityManager->find('list', $options);
		$qm = (isset($qm) && !empty($qm)) ? array_values($qm) : null;
		if (!isset($qm)) {
			$this->Employee->recursive = -1;
			$qm = $this->Employee->field('management_id', 
				 array('Employee.bc' => $username)
			);
			$qm = ($qm) ? array($qm) : array();
		}
		return $qm;
	}
		
	protected function _getEmployeeid($username) {
		$this->loadModel('Employee');
		$this->Employee->recursive = -1;
		$em = $this->Employee->field('id', 
				 array('Employee.bc' => $username)
			);
			//$em = array($em);
		return $em;
	}

	private function _getMenu() {
		// Define your menu
		$menu = array(
			'main-menu' => array(
				array(
					'title' => __('Main'), 
					'class' => 'nav-header' 
				),
				array(
					'title' => __('Dashboard'), 
					'url' => '/', 
					'iconClass' => 'icon-home', 
				),
			),
			'manager-menu' => array(
				array(
					'title' => __('Manager Menu'), 
					'class' => 'nav-header', 
					'permissions' => array('manager', 'area_manager', 'administrator', 'security'), 
				),
				array(
					'title' => __('Add Rfc'), 
					'url' => array('plugin' => null, 'controller' => 'rfcs', 'action' => 'add'), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager', 'area_manager', 'administrator', 'security'), 
				),
				array(
					'title' => __('Add Assignment'), 
					'url' => array('plugin' => null, 'controller' => 'assignments', 'action' => 'add'), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager',  'area_manager', 'administrator', 'security'), 
				),
					array(
					'title' => __('Assignments About to Expire'), 
					'url' => array('plugin' => null, 'controller' => 'assignments', 'action' => 'index', 2), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager',  'area_manager', 'administrator', 'security'), 
				),
						array(
					'title' => __('Expired Assignments'), 
					'url' => array('plugin' => null, 'controller' => 'assignments', 'action' => 'index', 3), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager', 'area_manager', 'administrator', 'security'), 
				),
			),
			'reports-menu' => array(
				array(
					'title' => __('Reports'), 
					'class' => 'nav-header', 
					'permissions' => array('manager','area_manager', 'administrator', 'security', 'development'), 
				),
				array(
					'title' => __('Packages'), 
					'url' => array('plugin' => null, 'controller' => 'packages', 'action' => 'reports'), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager','area_manager', 'administrator', 'security', 'development'), 
				),
				array(
					'title' => __('Certified Packages'), 
					'url' => array('plugin' => null, 'controller' => 'packages', 'action' => 'reports', 1), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager','area_manager', 'administrator', 'security', 'development'), 
				),
				array(
					'title' => __('High Impact'), 
					'url' => array('plugin' => null, 'controller' => 'rfcs', 'action' => 'highimpact'), 
					'iconClass' => 'icon-list-alt', 
					'permissions' => array('manager','area_manager', 'administrator', 'security', 'development'), 
				),
			),
			'evaluation-menu' => array(
				array(
					'title' => __('Evaluations'), 
					'class' => 'nav-header' 
				),
				array(
					'title' => __('Monthly Evaluation'), 
					'url' => array('plugin' => null, 'controller' => 'evaluations', 'action' => 'compute'), 
					'iconClass' => 'icon-thumbs-up', 
					'permissions' => array('manager', 'area_manager', 'administrator'), 
				),
				array(
					'title' => __('Yearly Evaluation'), 
					'url' => array('plugin' => null, 'controller' => 'evaluations', 'action' => 'yearlyEvaluation'), 
					'iconClass' => 'icon-road', 
					'permissions' => array('manager','area_manager', 'administrator', 'users'), 
				),
				array(
					'title' => __('Charts'), 
					'url' => array('plugin' => null, 'controller' => 'charts', 'action' => 'index'), 
					'iconClass' => 'icon-picture', 
				),
				array(
					'title' => __('Methodology'), 
					'url' =>  $this->Session->read('Options.mtweblink'), 
					'target' => '_blank', 
					'iconClass' => 'icon-check', 
				),
			), 
			'security-menu' => array(
				array(
					'title' => __('Security'), 
					'class' => 'nav-header', 
					'permissions' => array('administrator', 'security'), 
				),
				array(
					'title' => __('List Groups'), 
					'url' => array('plugin' => null, 'controller' => 'groups', 'action' => 'index'), 
					'iconClass' => 'icon-th-list', 
					'permissions' => array('administrator', 'security'), 
				),
				array(
					'title' => __('List Users'), 
					'url' => array('plugin' => null, 'controller' => 'users', 'action' => 'index'), 
					'iconClass' => 'icon-user', 
					'permissions' => array('administrator', 'security'), 
				),
				array(
					'title' => __('Manage permissions'), 
					'url' => array('plugin' => 'acl_manager', 'controller' => 'acl', 'action' => 'permissions'), 
					'iconClass' => 'icon-lock', 
					'permissions' => array('administrator', 'security'), 
				),
				array(
					'title' => __('List Options'), 
					'url' => array('plugin' => null, 'controller' => 'options', 'action' => 'index'), 
					'iconClass' => 'icon-wrench', 
					'permissions' => array('administrator', 'security'), 
				),
			),
			'user-menu' => array(
				array(
					'title' => __('User Menu'), 
					'class' => 'nav-header', 
				),
				array(
					'title' => __('List Assignments'), 
					'url' => array('plugin' => null, 'controller' => 'assignments', 'action' => 'index'), 
					'iconClass' => 'icon-list-alt', 
				),
				array(
					'title' => __('List Packages'), 
					'url' => array('plugin' => null, 'controller' => 'packages', 'action' => 'index'), 
					'iconClass' => 'icon-align-justify', 
				),
				array(
					'title' => __('List Rfcs'), 
					'url' => array('plugin' => null, 'controller' => 'rfcs', 'action' => 'index'), 
					'iconClass' => 'icon-th-list', 
				), 
				array(
					'title' => __('List Modules'), 
					'url' => array('plugin' => null, 'controller' => 'modules', 'action' => 'index'), 
					'iconClass' => 'icon-th-list', 
				), 
				array(
					'title' => __('Schedule'), 
					'url' => array('plugin' => null, 'controller' => 'employees', 'action' => 'schedule'), 
					'iconClass' => 'icon-tasks', 
				),
				array(
					'title' => __('List Absences'), 
					'url' => array('plugin' => null, 'controller' => 'Absences', 'action' => 'index'), 
					'iconClass' => 'icon-align-justify', 
				),
				array(
					'title' => __('List Holidays'), 
					'url' => array('plugin' => null, 'controller' => 'holidays', 'action' => 'index'), 
					'iconClass' => 'icon-align-justify', 
				),
			)
		);
		
		$menu = $this->buildMenu($menu);

		if ( isset( $this->Auth->user()['role'] ) )
			$this->set('auth', array('User' => array('role' => $this->Auth->user()['role']) ) );

		// For default settings name must be menu
		$this->set(compact('menu'));
	}

	private function buildMenu($menus) {

		$defaults = array(
			'titleFormat' => '<i class="%s"></i><span class="%s">&nbsp;%s</span>', 
			'spanClass' => '', 
			'iconClass' => 'icon-thumbs-up'
		);

		$auxMenu = array();
		foreach ($menus as $menuName => $menu) {
			$auxItems = array();
			foreach ($menu as $item) {

				if (isset($item['iconClass']) && !empty($item['iconClass'])) 
					$item['escapeTitle'] = false;

				if (isset($item['escapeTitle']) && !$item['escapeTitle']) {
					$item = array_merge($defaults, $item);
					$item['aTitle'] = sprintf($item['titleFormat'], $item['iconClass'], $item['spanClass'], $item['title']);
					unset($item['titleFormat'], $item['spanClass'], $item['iconClass']);
				}
				$auxItems[] = $item;
			}
			$auxMenu[$menuName] = $auxItems;
		}
		return $auxMenu;
	}
}
