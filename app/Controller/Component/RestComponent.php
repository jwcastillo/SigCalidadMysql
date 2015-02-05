<?php

// http://miftyisbored.com/complete-restful-service-client-cakephp-tutorial/

class RestComponent extends Component {

	public $components = array('Auth', 'Session');

	private $request;

	public function isApi() {
		//debug($this->params, false);
		if ($this->request) 
			return array_key_exists('ext', $this->request->params) && $this->request->params['ext'];
		else
			return false;
	}

	public function getExt(){
		if ($this->isApi()) {
			return $this->request->params['ext'];
		}
	}

	public function isJson() {
		return $this->getExt() == 'json';
	}


	public function isXml() {
		return $this->getExt() == 'xml';
	}

	public function getRequestData() {
		$data = $this->isJson()
				? $this->request->input('json_decode', true) : $this->request->data;
		
		$data = is_null($data) ? $this->request->data : $data;
		
		return $data;
	}

	public function initialize(Controller $controller) {

		$this->request = $controller->request;

		if ($this->isApi()) {

			// TODO: Require SSL
			$this->Auth->authenticate = array(
				'Basic'
			);

			$this->Auth->login();
		}
	}

	public function beforeRender(Controller $controller){
		if ($this->isApi() && !$this->Auth->user()) {
			throw new ForbiddenException($this->Auth->authError);
		}
		parent::beforeRender($controller);
	}

	public function shutdown(Controller $controller) {

		//CakeLog::write('debug', '$controller->request ' . print_r($this->request, true) );

		//CakeLog::write('debug', 'Auth.User ' . print_r($this->Auth->user(), true) );

		if ($this->isApi() && array_key_exists('Basic', $this->Auth->authenticate) ) { 

			$this->Auth->logout();
			$this->Session->destroy();

		} // End isApi()
	} // End shutdown() 
}