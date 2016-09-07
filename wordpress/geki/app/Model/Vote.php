<?php
App::uses('AppModel', 'Model');

/*
 * 登録時の、その個人の総票数のモデル。
 */
class Vote extends AppModel {

	public function get($userHash) {
		$datas = $this->find('first', array(
						'conditions' => array('Vote.user_hash' => $userHash),
						'order' => array('Vote.revision' => 'desc')
		));
		
		$votes = 0;
		foreach ($datas as $data) {
			$votes = intval($data['vote']);
		}

		return $votes;
	}
}