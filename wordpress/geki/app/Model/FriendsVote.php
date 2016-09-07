<?php
App::uses('AppModel', 'Model');

/*
 * 友人・知人の票モデル。
 */
class FriendsVote extends AppModel {

	function get($userHash, $currentRevision) {

        // 画面出力項目の初期化
        $returns = array('mobile' => 0, 'other' => 0);
        
        if ($currentRevision <= 0) {
        	return $returns;
        }

        // 自分のデータを取得
        $datas = $this->find('all', array('conditions' => array(
        				'FriendsVote.user_hash' => $userHash,
        				'FriendsVote.revision' => $currentRevision)));
        foreach ($datas as $data) {
            $returns['mobile'] = $data['FriendsVote']['mobile'];
            $returns['other'] = $data['FriendsVote']['other'];
        }

        return $returns;
	}

	function summary() {
		$this->virtualFields['mob'] = 0;
		$this->virtualFields['oth'] = 0;
		$datas = $this->find('all', array(
						'fields' => array('sum(FriendsVote.mobile) as FriendsVote__mob', 'sum(FriendsVote.other) as FriendsVote__oth'),
						// 						'group' => array('MyAllocatedVote.user_hash', 'MyAllocatedVote.revision'),
						'joins' => array(array(
										'table' => 'history_latest_view',
										'alias' => 'h',
										'type' => 'INNER',
										'foreignKey' => false,
										'conditions' => array('FriendsVote.user_hash = h.user_hash',
														'FriendsVote.revision = h.revision')
						))
		));
	
		$returns = array();
		foreach ($datas as $data) {
			$returns = array(
							'mobile' => $data['FriendsVote']['mob'],
							'other' => $data['FriendsVote']['oth']);
		}
			
		return $returns;
	}
}