<?php
App::uses('AppModel', 'Model');

/*
 * 選対大量購入用予算モデル。
 */
class BulkBudget extends AppModel {

	function get($userHash, $currentRevision) {

        // 画面出力項目の初期化
        $returns = 0;
        
        if ($currentRevision <= 0) {
        	return $returns;
        }

        // 自分のデータを取得
        $datas = $this->find('all', array('conditions' => array(
        				'BulkBudget.user_hash' => $userHash,
        				'BulkBudget.revision' => $currentRevision)));
        foreach ($datas as $data) {
            $returns = $data['BulkBudget']['money'];
        }

        return $returns;
	}

	function summary() {
		$this->virtualFields['mone'] = 0;
		$datas = $this->find('all', array(
						'fields' => array('sum(BulkBudget.money) as BulkBudget__mone'),
						// 						'group' => array('MyAllocatedVote.user_hash', 'MyAllocatedVote.revision'),
						'joins' => array(array(
										'table' => 'history_latest_view',
										'alias' => 'h',
										'type' => 'INNER',
										'foreignKey' => false,
										'conditions' => array('BulkBudget.user_hash = h.user_hash',
														'BulkBudget.revision = h.revision')
						))
		));
	
		$returns = array();
		foreach ($datas as $data) {
			$returns = array(
							'money' => $data['BulkBudget']['mone']);
		}
			
		return $returns;
	}
}