<?php

App::uses('AppController', 'Controller');

class LoginController extends AppController {
    public $uses = array('History');
    private $PASS_PHRASE = 'mei2016##1';

    public function beforeRender() {
        parent::beforeRender();

        $this->_setupSession();
		$this->set("title_for_layout","ログイン");
    }

	public function index() {
		$loginId = $this->_checkLogin();
		if (!empty($loginId)) {
			$this->redirect('../summary/');
		}

		if (CakeSession::check('errMsg')) {
			$this->set("errMsg", CakeSession::read('errMsg'));
			CakeSession::delete('errMsg');
		}
	}

	public function logout() {
	
		// ログイン状態を削除する
		CakeSession::delete('loginId');
// 		CakeSession::destroy();

		// ログイン画面を表示する
		$this->redirect("../login/");
	}
	
	public function login() {

		if ($this->request->is('POST')) {
			$passPhrase = $this->request->data['Login']['passPhrase'];
   			$loginId = $this->request->data['Login']['loginId'];
			if ($passPhrase == $this->PASS_PHRASE && !empty($loginId)) {
				CakeSession::write('loginId', $loginId);
				
        		// サマリーへの遷移を表示するか
        		$users = $this->History->getUsers();
        		$openFlag = count($users) >= 5 ? true : false;

        		if ($openFlag) {
	        		$this->redirect("../summary/");
        		} else {
        			$this->redirect("../list/");
        		}
            }
		}

		$this->setAction('index');
	}
	
}
