<?php
App::uses('AppModel', 'Model');

/*
 * 管理情報マスタのモデル。
 */
class ManagementInformation extends AppModel {
	function get() {
		$returns = $this->find('first', array(
			'order' => array('ManagementInformation.regist_date' => 'desc')
		));

		return $returns;
	}
	
	function insert($password, $passPhrase, $running, $ipAddress) {
		$data = array('ManagementInformation' => array(
						'password' => $password,
						'pass_phrase' => $passPhrase,
						'running' => $running,
						'ip_address' => $ipAddress,
						'regist_date' => date("Y-m-d H:i:s", time()/* + 9 * 60 * 60*/)
		));
		$fields = array('password', 'pass_phrase', 'running', 'ip_address', 'regist_date');
		parent::save($data, false, $fields);
	}
}