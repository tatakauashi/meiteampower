<?php
App::uses('AppModel', 'Model');

/*
 * サマリーモデル。
 */
class Summary extends AppModel {
 
	function getSummary($userHash) {
		$currentRevision = _getCurrentRevision($userHash);

        $sql = 'SELECT sum(`mei_count`) + sum(`other_count`) AS `count` from `allocations` where `user_hash` = ? and revsion = ? group by `user_hash`, `revision`';
        $datas = $this->query($sql, array($userHash, $currentRevision), false);
        $alloc = 0;
        foreach ($datas as $data) {
            $alloc = $data['0']['count'];
        }
	
        $sql = 'SELECT sum(`mobile`) as my_votes_mobile, sum(`other`) AS `my_votes_other` from `my_allocated_votes` where `user_hash` = ? and revsion = ? group by `user_hash`, `revision`';
        $datas = $this->query($sql, array($userHash, $currentRevision), false);
        $myVotesMobile = 0;
        $myVotesOther = 0;
        foreach ($datas as $data) {
            $myVotesMobile = $data['0']['my_votes_mobile'];
            $myVotesOther = $data['0']['my_votes_other'];
        }
		
        $sql = 'SELECT sum(`mobile`) as friends_mobile, sum(`other`) AS `friends_other` from `friends_votes` where `user_hash` = ? and revsion = ? group by `user_hash`, `revision`';
        $datas = $this->query($sql, array($userHash, $currentRevision), false);
        $friendsMobile = 0;
        $friendsOther = 0;
        foreach ($datas as $data) {
            $friendsMobile = $data['0']['friends_mobile'];
            $friendsOther = $data['0']['friends_other'];
        }
	
        $sql = 'SELECT sum(`money`) AS `money` from `bulk_budgets` where `user_hash` = ? and revsion = ? group by `user_hash`, `revision`';
        $datas = $this->query($sql, array($userHash, $currentRevision), false);
        $money = 0;
        foreach ($datas as $data) {
            $money = $data['0']['money'];
        }
	}

	function _getCurrentRevision($userHash) {

        // 最新リビジョンの取得
        $sql = 'SELECT MAX(`revision`) AS `revision` from `histories` where `user_hash` = ? group by `user_hash`';
        $datas = $this->query($sql, array($userHash), false);
        $currentRevision = 0;
        foreach ($datas as $data) {
            $currentRevision = $data['0']['revision'];
        }
        
        return $currentRevision;
    }
    
    function insert($userHash, $revision) {
        $data = array('History' => array(
            'user_hash' => $userHash,
            'revision' => ($revision + 1),
            'regist_date' => date("Y-m-d H:i:s", time()/* + 9 * 60 * 60*/)
        ));
        $fields = array('user_hash', 'revision', 'regist_date');
    	parent::save($data, false, $fields);
    }
}