<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
    //Components that are going to be called.
    //var $components = array('Auth', 'Session');

    //var $helpers = array('Js','Javascript'); //default uses all helpers
    var $components = array('Session','Auth','RequestHandler');
	var $helpers = array('Html', 'Form', 'Javascript', 'Session', 'Paginator'); 
    var $uses = array('Userinfo');

    //Methods that are going to be done before using other controllers
    function beforeFilter() {
        $this->Auth->loginAction = array('user' => false, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'posts', 'actions' => 'index');
        $this->Auth->allow('display');
    }

    //Saving to Session User Key
    public function beforeRender() {
        if(!array_key_exists('requested', $this->params)) {
            $user = $this->Session->read($this->Auth->sessionKey);
            $this->set(compact('user'));
            // $user_id = $this->Auth->user('id');
            $userinfo = $this->Userinfo->find(
                'first',
                array(
                    'conditions' => array('Userinfo.user_id' => $user['id'])
                )
            );
            $this->set(compact('userinfo'));
        }
    }

    //API BACKBONE??
    function getJsonPostData() {
		$rawData = file_get_contents("php://input");
		return json_decode($rawData, true);
	}
}
