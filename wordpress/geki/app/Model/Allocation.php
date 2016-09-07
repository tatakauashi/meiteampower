<?php
App::uses('AppModel', 'Model');

/*
 * 確保モデル。
 */
class Allocation extends AppModel {

    function get($userHash, $currentRevision) {

        // 画面出力項目の初期化
        $returns = array();
        for ($dateId = 1; $dateId <= 4; $dateId++) {  // 日
            for ($divisionId = 1; $divisionId <= 8; $divisionId++) {  // 部（1～６、７：当日券、８：写真のみ）
                $returns['mei' . $dateId . $divisionId] = 0;
                $returns['other' . $dateId . $divisionId] = 0;
            }
        }
        
        if ($currentRevision <= 0) {
        	return $returns;
        }

        // 自分のデータを取得
        $datas = $this->find('all', array('conditions' => array(
        				'Allocation.user_hash' => $userHash,
        				'Allocation.revision' => $currentRevision)));
        foreach ($datas as $data) {
            $returns['mei' . $data['Allocation']['date_id'] . $data['Allocation']['division_id']] = $data['Allocation']['mei_count'];
            $returns['other' . $data['Allocation']['date_id'] . $data['Allocation']['division_id']] = $data['Allocation']['other_count'];
        }

        return $returns;
    }
    
    function saves($datas, $fields) {

    	foreach ($datas as $data) {
			parent::save($data, false, $fields);
    	}
    }

    function summary() {
    	$this->virtualFields['meiCount'] = 0;
    	$this->virtualFields['otherCount'] = 0;
    	$datas = $this->find('all', array(
    					'fields' => array('sum(Allocation.mei_count) as Allocation__meiCount', 'sum(Allocation.other_count) as Allocation__otherCount'),
//     					'group' => array('Allocation.user_hash', 'Allocation.revision'),
    					'joins' => array(array(
    						'table' => 'history_latest_view',
    						'alias' => 'h',
    						'type' => 'INNER',
    						'foreignKey' => false,
    						'conditions' => array('Allocation.user_hash = h.user_hash',
    												'Allocation.revision = h.revision')
    					))
    	));

    	$returns = array();
    	foreach ($datas as $data) {
    		$returns = array(
    						'mei_count' => $data['Allocation']['meiCount'],
    						'other_count' => $data['Allocation']['otherCount']);
    	}
    	
    	return $returns;
    }
}
