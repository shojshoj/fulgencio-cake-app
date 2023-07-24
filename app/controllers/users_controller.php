<?php

class UsersController extends AppController {

    var $name = "Users";
    
    function login() {
        //Framework understands this
    }

    function logout() {
        $user = $this->Session->read($this->Auth->sessionKey);
        $this->redirect($this->Auth->logout());
    }
}