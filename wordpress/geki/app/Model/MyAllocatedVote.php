<?php
App::uses('AppModel', 'Model');

/*
 * 自分の確保済みの票モデル。
 */
class MyAllocatedVote extends AppModel {

	function get($userHash, $currentRevision) {

        // 画面出力項目の初期化
        $returns = array('mobile' => 0, 'other' => 0);
        
        if ($currentRevision <= 0) {
        	return $returns;
        }

        // 自分のデータを取得
        $datas = $this->find('all', array('conditions' => array(
        				'MyAllocatedVote.user_hash' => $userHash,
        				'MyAllocatedVote.revision' => $currentRevision)));
        foreach ($datas as $data) {
            $returns['mobile'] = $data['MyAllocatedVote']['mobile'];
            $returns['other'] = $data['MyAllocatedVote']['other'];
        }

        return $returns;
	}
	
	function summary() {
		$this->virtualFields['mob'] = 0;
		$this->virtualFields['oth'] = 0;
		$datas = $this->find('all', array(
						'fields' => array('sum(MyAllocatedVote.mobile) as MyAllocatedVote__mob', 'sum(MyAllocatedVote.other) as MyAllocatedVote__oth'),
// 						'group' => array('MyAllocatedVote.user_hash', 'MyAllocatedVote.revision'),
						'joins' => array(array(
										'table' => 'history_latest_view',
										'alias' => 'h',
										'type' => 'INNER',
										'foreignKey' => false,
										'conditions' => array('MyAllocatedVote.user_hash = h.user_hash',
														'MyAllocatedVote.revision = h.revision')
						))
		));
	
		$returns = array();
		foreach ($datas as $data) {
			$returns = array(
							'mobile' => $data['MyAllocatedVote']['mob'],
							'other' => $data['MyAllocatedVote']['oth']);
		}
		 
		return $returns;
	}
}