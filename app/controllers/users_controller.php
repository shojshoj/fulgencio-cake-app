<?php
class UsersController extends AppController {

	var $name = 'Users';

	function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow(
			'login',
			'register', 
			'api_login', 
			'api_register', 
			'signup',
			'api_get_info'
		);
	}

    function login() {
    }

    function user_logout() {
        $this->Session->destroy(); 
        $this->redirect($this->Auth->logout());
    }

	function register() {
		// $this->log($this->data,'registerData');
		// if($this->Auth->user('id')){
		// 	$this->redirect(array('controller' => 'posts', 'action' => 'index'));
		// }
		// if ($this->data) {
		// 	$userExists = null;
		// 	$userExists = $this->User->find(
		// 		'all',
		// 		array(
		// 			'conditions' => array(
		// 				'User.username' => $this->data['User']['username']
		// 			)
		// 		)
		// 	);
		// 	if(!$userExists){
		// 		// if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
					
		// 		// }
		// 		$this->User->create();
		// 		$this->User->save($this->data);
		// 		$this->log($this->Auth->user('id'), 'user_id');
		// 	} else {
		// 		$this->Session->setFlash(__('This Username has already been taken.', true));
		// 	}
		// }
	}

	function signup() {

	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function api_login() {
		$data = $this->getJsonPostData();
		$this->log($this->getJsonPostData(),'loginData');
		$username = $data['username'];
		$password = Security::hash($data['password'], null, true);

		$user = $this->User->find(
			'first',
			array(
				'conditions' => array(
					'User.username' => $username,
					'User.password' => $password
				)
			)
		);

		if(!empty($user)){
			if ($this->Auth->login($user['User'])) {
				$this->Session->write('User', $user['User']);
				// $this->Session->write('user', $user['User']);
				// $user = $this->Session->read($this->Auth->sessionKey);
				// $this->set(compact('user'));
				// $user_id = $this->Auth->user('id');
				// $userinfo = $this->Userinfo->find(
				// 	'first',
				// 	array(
				// 		'conditions' => array('Userinfo.user_id' => $user['id'])
				// 	)
				// );
				// $this->set(compact('userinfo'));
				$response = $this->createResponse(true, "Login Successful.", $user['User']['username']);
			} else {
				$response = $this->createResponse(false, "Login Unsuccessful.", $user['User']['username']);
			}	
		} else {
			$response = $this->createResponse(false, "Invalid Username or Password", NULL);
		}

		$this->returnAsJson($response, 'loginData');
	}

	//Register Function
	function api_register() {
		$data = $this->getJsonPostData();
		$this->log($this->getJsonPostData(), 'registerData');
		$username = $data['username'];
		$password = Security::hash($data['password'], null, true);

		$userExists = $this->User->find(
			'first',
			array(
				'conditions' => array(
					'User.username' => $username
				)
			)
		);

		if(empty($userExists)) {
			$this->User->create();
			$this->User->set(array(
				'username' => $username,
				'password' => $password
			));
			$this->User->save();
			$user = array(
				'User.username' => $username,
				'User.password' => $password
			);
			if ($this->Auth->login($user)) { 	
				$this->Userinfo->create();
				$this->Userinfo->set(array(
					'first_name' => 'kero',
					'last_name' => '-'.$username.'-',
					'address_line_1' => 'No Address',
					'address_line_2' => 'No Address',
					'image_path' => '/'.basename(ROOT).'/files/user/default/uploads/images/user_image.png',
					'user_id' => $this->Auth->user('id')
				));
				$this->Userinfo->save();
				$response = $this->createResponse(true, 'Successfully Created User.', NULL);
			} else {
				$response = $this->createResponse(false, 'User Information was not created.', NULL);
			}
			// if($this->Auth->login($user['User'])){
			// 	$this->Userinfo->set(array(
			// 		'first_name' => 'kero',
			// 		'last_name' => '-'.$username.'-',
			// 		'address_line_1' => 'No Address',
			// 		'image_path' => $this->basename('ROOT'),
			// 		'user_id' => $this->Auth->user('id')
			// 	));
			// 	$response = $this->createResponse(true, 'User was Registered.', NULL);
			// }			
		} else {
			$response = $this->createResponse(true, 'Username already used.', NULL);
		}

		// if($this->Auth->user('id')){
		// 	$response = $this->createResponse(false, 'You are Logged in', NULL);
		// }

		$this->returnAsJson($response, 'registerData');
	}

	//Api that needs to be logged in.
	function api_get_info(){
		if($this->Auth->user('id')){
			$userinfo = $this->Userinfo->find(
				'first',
				array(
					'conditions' => array(
						'Userinfo.user_id' => $this->Auth->user('id')
					)
				)
			);
			$response = $this->createResponse(true, 'Successfully Retrieved User.', $userinfo);
		} else {
			$response = $this->createResponse(false, 'You are not Authenticated.');
		}

		$this->returnAsJson($response, 'registerData');
	}

	function user_view() {
	}
	// cake bake
	// function user_index() {
	// 	$this->User->recursive = 0;
	// 	$this->set('users', $this->paginate());
	// }

	// function user_view($id = null) {
	// 	if (!$id) {
	// 		$this->Session->setFlash(__('Invalid user', true));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	$this->set('user', $this->User->read(null, $id));
	// }

	// function user_add() {
	// 	if (!empty($this->data)) {
	// 		$this->User->create();
	// 		if ($this->User->save($this->data)) {
	// 			$this->Session->setFlash(__('The user has been saved', true));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
	// 		}
	// 	}
	// }

	// function user_edit($id = null) {
	// 	if (!$id && empty($this->data)) {
	// 		$this->Session->setFlash(__('Invalid user', true));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	if (!empty($this->data)) {
	// 		if ($this->User->save($this->data)) {
	// 			$this->Session->setFlash(__('The user has been saved', true));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
	// 		}
	// 	}
	// 	if (empty($this->data)) {
	// 		$this->data = $this->User->read(null, $id);
	// 	}
	// }

	// function user_delete($id = null) {
	// 	if (!$id) {
	// 		$this->Session->setFlash(__('Invalid id for user', true));
	// 		$this->redirect(array('action'=>'index'));
	// 	}
	// 	if ($this->User->delete($id)) {
	// 		$this->Session->setFlash(__('User deleted', true));
	// 		$this->redirect(array('action'=>'index'));
	// 	}
	// 	$this->Session->setFlash(__('User was not deleted', true));
	// 	$this->redirect(array('action' => 'index'));
	// }
}
