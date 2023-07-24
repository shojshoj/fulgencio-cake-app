<?php

class PostsController extends AppController {
    var $name = 'Posts';

    function beforeFilter() {
        //calling before filter from parent class
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

    function index($id = NULL) {
        $this->set('user', $this->Post->read(NUll, $id));
    }

    function view() {

    }
}