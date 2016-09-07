<?php
App::uses('AppModel', 'Model');

/*
 * 登録履歴モデル。
 */
class History extends AppModel {
 
    function getCurrentRevision($userHash) {

        // 最新リビジョンの取得
// //         $sql = 'SELECT MAX(`revision`) AS `revision` from `histories` where `user_hash` = ? group by `user_hash`';
//         $sql = 'SELECT * from `history_latest_view` where `user_hash` = ?';
//     	$datas = $this->query($sql, array($userHash), false);
		$datas = $this->find('first', array(
			'conditions' => array('History.user_hash' => $userHash),
			'order' => array('History.revision' => 'desc')
		));
    	$currentRevision = 0;
        foreach ($datas as $data) {
//             $currentRevision = $data['0']['revision'];
			if (empty($data['delete_date'])) {
	            $currentRevision = $data['revision'];
			} else {
				$currentRevision = -1;
			}
        }
        
        return $currentRevision;
    }
    
    function getUsers() {

        // ユーザハッシュとその最新リビジョンを取得する
//         $sql = 'SELECT `user_hash`, MAX(`revision`) AS `revision` from `histories` group by `user_hash`';
//         $datas = $this->query($sql, array(), false);
		$this->virtualFields['rev'] = 0;
		$datas = $this->find('all', array(
						'fields' => array('History.user_hash', 'max(History.revision) as History__rev'),
						'conditions' => array('History.delete_date' => null),
						'group' => array('History.user_hash')
		));
		
		$returns = array();
		foreach ($datas as $data) {
			if (!empty($data['History']['delete_date'])) {
				continue;
			}
			$returns[] = array(
							'user_hash' => $data['History']['user_hash'],
							'revision' => $data['History']['rev']);
		}
		
        return $returns;
    }

    function getLastUpdate() {

        // 最新の登録日時を取得する
		$this->virtualFields['lastUpdate'] = null;
		$datas = $this->find('first', array(
						'fields' => array('max(History.regist_date) as History__lastUpdate'),
						'conditions' => array('History.delete_date' => null)
		));
//		print_r($datas);
//		$sql = 'SELECT MAX(`regist_date`) AS `lastUpdate` from `histories` where `delete_date` is null';
//		$datas = $this->query($sql, array(), false);
		if (!empty($datas[0]['History__lastUpdate'])) {
			return $datas[0]['History__lastUpdate'];
		}
		
        return null;
    }
    
    function insert($userHash, $revision, $ipAddress) {
        $data = array('History' => array(
            'user_hash' => $userHash,
            'revision' => ($revision + 1),
        	'ip_address' => $ipAddress,
            'regist_date' => date("Y-m-d H:i:s", time()/* + 9 * 60 * 60*/)
        ));
        $fields = array('user_hash', 'revision', 'ip_address', 'regist_date');
    	parent::save($data, false, $fields);
    }
}