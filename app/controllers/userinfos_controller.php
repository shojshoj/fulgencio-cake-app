<?php
class UserinfosController extends AppController {

	var $name = 'Userinfos';

	// function beforeFilter() {
    // 	parent::beforeFilter(); 
    //     $this->Auth->allow('index','view');
	// }

	function index($user_id = null) {
		$user_id = $this->Auth->user('id');
		$user_info = $this->Userinfo->find(
			'first',
			array(
				'conditions' => array('Userinfo.user_id' => $user_id)
			)
		);
		$this->set('userinfo', $user_info);
	}

	//Values below are from Cake bake

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid userinfo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userinfo', $this->Userinfo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Userinfo->create();
			if ($this->Userinfo->save($this->data)) {
				$this->Session->setFlash(__('The userinfo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userinfo could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Userinfo->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid userinfo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Userinfo->save($this->data)) {
				$this->Session->setFlash(__('The userinfo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userinfo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Userinfo->read(null, $id);
		}
		$users = $this->Userinfo->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for userinfo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Userinfo->delete($id)) {
			$this->Session->setFlash(__('Userinfo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Userinfo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
