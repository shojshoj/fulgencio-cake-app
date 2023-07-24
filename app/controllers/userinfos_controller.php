<?php
class UserinfosController extends AppController {

	var $name = 'Userinfos';

	// function beforeFilter() {
    // 	parent::beforeFilter(); 
    //     $this->Auth->allow('index','view');
	// }

	function index() {
		$this->Userinfo->recursive = 0;
		$this->set('userinfos', $this->paginate());
	}

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
	function user_index() {
		$this->Userinfo->recursive = 0;
		$this->set('userinfos', $this->paginate());
	}

	function user_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid userinfo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userinfo', $this->Userinfo->read(null, $id));
	}

	function user_add() {
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

	function user_edit($id = null) {
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

	function user_delete($id = null) {
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
