<?php

App::uses('AppController', 'Controller');

class ManagementController extends AppController {
    public $uses = array('ManagementInformation');

    public function beforeRender() {
        parent::beforeRender();
		$this->set("title_for_layout","管理ページ");
    }

	public function index() {
		CakeSession::destroy();
	}

	public function submit() {

		// 現在の情報
		$datas = $this->ManagementInformation->get();
		
		$password = $this->request->data('ManagementInformation.password');
		$passwordHashed = md5($password . '@@@poi');

		if ($datas['ManagementInformation']['password'] == $passwordHashed) {
			
			// パスフレーズの変更
			$passPhrase = $datas['ManagementInformation']['pass_phrase'];
			if ($passPhrase == $this->request->data('ManagementInformation.oldPassPhrase')
					&& ($this->request->data('ManagementInformation.newPassPhrase')
							== $this->request->data('ManagementInformation.newPassPhraseConfirm'))) {
				$passPhrase = $this->request->data('ManagementInformation.newPassPhrase');
			}
			
			// サービスの変更
			$running = $this->request->data('ManagementInformation.running');
			$running = (empty($running) || $running != '1') ? 0 : 1;
			
			$this->ManagementInformation->insert(
					$passwordHashed, $passPhrase, $running, $this->request->clientIp());
		}
		$this->setAction('index');
	}

}
