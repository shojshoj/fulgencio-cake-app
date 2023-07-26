<?php
class PostsController extends AppController {

	var $name = 'Posts';

    function beforeFilter() {
    	parent::beforeFilter(); 
        $this->Auth->allow('index','view');
	}

	function index() {
		$posts = $this->paginate('Post');
		$this->set('posts', $posts);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	// function add() {
	// 	if (!empty($this->data)) {
	// 		$this->Post->create();
	// 		if ($this->Post->save($this->data)) {
	// 			$this->Session->setFlash(__('The post has been saved', true));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
	// 		}
	// 	}
	// 	$users = $this->Post->User->find('list');
	// 	$this->set(compact('users'));
	// }

	// function edit($id = null) {
	// 	if (!$id && empty($this->data)) {
	// 		$this->Session->setFlash(__('Invalid post', true));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	if (!empty($this->data)) {
	// 		if ($this->Post->save($this->data)) {
	// 			$this->Session->setFlash(__('The post has been saved', true));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
	// 		}
	// 	}
	// 	if (empty($this->data)) {
	// 		$this->data = $this->Post->read(null, $id);
	// 	}
	// 	$users = $this->Post->User->find('list');
	// 	$this->set(compact('users'));
	// }

	// function delete($id = null) {
	// 	if (!$id) {
	// 		$this->Session->setFlash(__('Invalid id for post', true));
	// 		$this->redirect(array('action'=>'index'));
	// 	}
	// 	if ($this->Post->delete($id)) {
	// 		$this->Session->setFlash(__('Post deleted', true));
	// 		$this->redirect(array('action'=>'index'));
	// 	}
	// 	$this->Session->setFlash(__('Post was not deleted', true));
	// 	$this->redirect(array('action' => 'index'));
	// }

	//Get User ID
	function user_index() {
		$user_id = $this->Auth->user('id');
		$posts = $this->Post->find(
			'all',
			array(
				'conditions' => array(
					'Post.user_id' => $user_id
				)
			)
		);
		$this->set('posts', $posts);
	}

	function user_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		// how to output this as json
		$this->set('post', $this->Post->read(null, $id));
	}

	function user_add() {
		// if (!empty($this->data)) {
		// 	$this->Post->create();
		// 	if ($this->Post->save($this->data)) {
		// 		$this->Session->setFlash(__('The post has been saved', true));
		// 		$this->redirect(array('action' => 'index'));
		// 	} else {
		// 		$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
		// 	}
		// }
		// $users = $this->Post->User->find('list');
		// $this->set(compact('users'));
		if ($this->request->is('post')) {
			$this->Post->create();
			
			// Handle the image upload
			if (!empty($this->request->data['Post']['image_path']['tmp_name'])) {
			  $file = $this->request->data['Post']['image_path'];
			  $file_path = WWW_ROOT . 'files' . DS . 'uploads' . DS . 'images' . DS . $file['name'];
			  
			  if (move_uploaded_file($file['tmp_name'], $file_path)) {
				$this->request->data['Post']['image_path'] = 'uploads' . DS . 'images' . DS . $file['name'];
			  } else {
				// Handle upload error
				$this->Session->setFlash('Error uploading image.');
				$this->redirect(array('action' => 'add'));
			  }
			}
	  
			if ($this->Post->save($this->request->data)) {
			  $this->Session->setFlash('Post saved successfully.');
			  $this->redirect(array('action' => 'index'));
			} else {
			  $this->Session->setFlash('Error saving post.');
			}
		}
	}

	function user_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function user_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Post was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
