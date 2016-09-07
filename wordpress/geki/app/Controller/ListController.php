<?php

App::uses('AppController', 'Controller');

class ListController extends AppController {
	
	var $uses = array('History', 'Allocation',
		'MyAllocatedVote', 'FriendsVote', 'BulkBudget', 'Vote');

	public function beforeRender() {
        parent::beforeRender();
		$this->set("title_for_layout", "一覧");
		
		if (CakeSession::check('errMsg')) {
			$this->set("errMsg", CakeSession::read('errMsg'));
			CakeSession::delete('errMsg');
		}
    }

	public function index() {
		// ログインチェックとログインID取得
		$loginId =$this->_checkLogin();
    	if (empty($loginId)) {
    		$this->redirect('../login/');
    	}

		$userHash = $this->_getHash($loginId);
		$this->set('name', $loginId);
	    
		// 現在のリビジョンを取得する
		$currentRevision = $this->_getCurrentRevision($loginId);
		if ($currentRevision < 0) {
			// 履歴が削除済みの場合（ロックアウト状態）
			CakeSession::write('errMsg', "データが登録されていません。");
			$this->redirect('../login/logout/');
		}
		$this->set('currentRevision', $currentRevision);
		
		// 劇場盤データを取得する
		$datas = $this->Allocation->get($userHash, $currentRevision);
		$this->set('alloc', $datas);
		
		// 自分の確保済みの票
		$datas = $this->MyAllocatedVote->get($userHash, $currentRevision);
		$this->set('myAllocatedVote', $datas);

		// 友人・知人の票
		$datas = $this->FriendsVote->get($userHash, $currentRevision);
		$this->set('friendsVote', $datas);
	
		// 大量購入用予算
		$datas = $this->BulkBudget->get($userHash, $currentRevision);
		$this->set('bulkBudgets', $datas);

		// サマリーへの遷移を表示するか
		$users = $this->History->getUsers();	// 登録人数
// 		$currentRevision = $this->_getCurrentRevision($loginId);	// 現在のリビジョンを取得する
// 		$openFlag = (count($users) >= 5 && $currentRevision > 0) ? true : false;
		$votes = $this->Vote->get($userHash);	// ユーザーの投票数を取得する
		$openFlag = (count($users) >= 5 && $votes >= $this->UNDER_VOTES) ? true : false;	// 20票以上投票しなければサマリーは見られない
		$this->set('openFlag', $openFlag);
		
	}

	public function register() {
		// ログインチェックとログインID取得
		$loginId =$this->_checkLogin();
		if (empty($loginId)) {
			$this->redirect('../login/');
		}
		$userHash = $this->_getHash($loginId);
		 
		$nowDateString = date("Y-m-d H:i:s", time());
		if ("2016-06-17 15:00:00" < $nowDateString) {
			$this->redirect('../list/');
			return false;
		}

		// 現在のリビジョンを取得する
		$currentRevision = $this->_getCurrentRevision($loginId);
		if ($currentRevision != $this->request->data('currentRevision')) {
			CakeSession::write('errMsg', "既に変更されています。もう一度入力してください。");
			$this->redirect("../list/");
			return;
		}
		
		// 入力データのチェック
		$votes = $this->_calcVotes();
		if ($votes <= 0) {
			CakeSession::write('errMsg', "入力してください。");
			$this->redirect("../list/");
			return;
		}

		// 登録履歴
		$this->History->insert($userHash, $currentRevision, $this->request->clientIp());
		$currentRevision = $currentRevision + 1;
		// 劇場盤確保状況
		$this->Allocation->saves(
				$this->_getAllocationRegistData($userHash, $currentRevision),
				$this->_getAllocationFields());
		// 自分の確保済みの票
		$this->MyAllocatedVote->save(
				$this->_getMyAllocatedVoteRegistData($userHash, $currentRevision),
				false, $this->_getMyAllocatedVoteFields());
		// 友人・知人の票
		$this->FriendsVote->save(
				$this->_getFriendsVoteRegistData($userHash, $currentRevision),
				false, $this->_getFriendsVoteFields());
		// 大量購入用予算
		$this->BulkBudget->save(
				$this->_getBulkBudgetRegistData($userHash, $currentRevision),
				false, $this->_getBulkBudgetFields());
		// 総評数
		$this->Vote->save(
				array('Vote' => array(
								'user_hash' => $userHash,
								'revision' => $currentRevision,
								'vote' => $votes
				)),
				false,
				array('user_hash', 'revision', 'vote')
		);

        // 登録したら一覧を表示する
        $this->redirect('../list/');
	}

	// 現在のリビジョンを取得する
	function _getCurrentRevision($loginId) {
//		$this->loadModel('History');
		$revision = $this->History->getCurrentRevision($this->_getHash($loginId));
		return $revision;
	}

	// 劇場盤確保状況
	function _getAllocationRegistData($userHash, $currentRevision) {
		$datas = array();
		for ($dateId = 1; $dateId <= 4; $dateId++) {
			for ($divisionId = 1; $divisionId <= 7; $divisionId++) {
				$mei = $this->request->data('Allocation.mei' . $dateId . $divisionId);
				$mei = (empty($mei) || !ctype_digit($mei)) ? 0 : $mei;
				$other = $this->request->data('Allocation.other' . $dateId . $divisionId);
				$other = (empty($other) || !ctype_digit($other)) ? 0 : $other;
				$data = array('Allocation' => array(
								'date_id' => $dateId,
								'division_id' => $divisionId,
								'user_hash' => $userHash,
								'revision' => $currentRevision,
								'mei_count' => $mei,
								'other_count' => $other
				));
				
				$datas[] = $data;
			}
		}
		
		// 写真のみ
		$mei = $this->request->data('Allocation.mei18');
		$mei = (empty($mei) || !ctype_digit($mei)) ? 0 : $mei;
		$data = array('Allocation' => array(
						'date_id' => 1,
						'division_id' => 8,
						'user_hash' => $userHash,
						'revision' => $currentRevision,
						'mei_count' => $mei,
						'other_count' => 0,
		));
		$datas[] = $data;
		
		return $datas;
	}
	function _getAllocationFields() {
		$fields = array('date_id', 'division_id', 'user_hash', 'revision',
						'mei_count', 'other_count'
		);
	}
	
	// 自分の確保済みの票
	function _getMyAllocatedVoteRegistData($userHash, $currentRevision) {
		$mob = $this->request->data('MyAllocatedVote.mobile');
		$mob = (empty($mob) || !ctype_digit($mob)) ? 0 : 1;
		$other = $this->request->data('MyAllocatedVote.other');
		$other = (empty($other) || !ctype_digit($other)) ? 0 : $other;
		$data = array('MyAllocatedVote' => array(
						'user_hash' => $userHash,
						'revision' => $currentRevision,
						'mobile' => $mob,
						'other' => $other
		));
		return $data;
	}
	function _getMyAllocatedVoteFields() {
		$fields = array('user_hash', 'revision',
						'mobile', 'other'
		);
	}
	
	// 友人・知人の票
	function _getFriendsVoteRegistData($userHash, $currentRevision) {
		$mob = $this->request->data('FriendsVote.mobile');
		$mob = (empty($mob) || !ctype_digit($mob)) ? 0 : $mob;
		$other = $this->request->data('FriendsVote.other');
		$other = (empty($other) || !ctype_digit($other)) ? 0 : $other;
		$data = array('FriendsVote' => array(
						'user_hash' => $userHash,
						'revision' => $currentRevision,
						'mobile' => $mob,
						'other' => $other
		));
		return $data;
	}
	function _getFriendsVoteFields() {
		$fields = array('user_hash', 'revision',
						'mobile', 'other'
		);
	}
	
	// 大量購入用予算
	function _getBulkBudgetRegistData($userHash, $currentRevision) {
		$money = $this->request->data('BulkBudget.money');
		$money = (empty($money) || !ctype_digit($money)) ? 0 : $money;
		$data = array('BulkBudget' => array(
						'user_hash' => $userHash,
						'revision' => $currentRevision,
						'money' => $money
		));
		return $data;
	}
	function _getBulkBudgetFields() {
		$fields = array('user_hash', 'revision',
						'money'
		);
	}
	
	function _calcVotes() {

		// 劇場盤CD
		$sum = 0;
		for ($dateId = 1; $dateId <= 4; $dateId++) {
			for ($divisionId = 1; $divisionId <= 7; $divisionId++) {
				$mei = $this->request->data('Allocation.mei' . $dateId . $divisionId);
				$mei = (empty($mei) || !ctype_digit($mei)) ? 0 : intval($mei);
				$sum += $mei;
				$other = $this->request->data('Allocation.other' . $dateId . $divisionId);
				$other = (empty($other) || !ctype_digit($other)) ? 0 : intval($other);
				$sum += $other;
			}
		}
		// 写真のみ
		$mei = $this->request->data('Allocation.mei18');
		$mei = (empty($mei) || !ctype_digit($mei)) ? 0 : intval($mei);
		$sum += $mei;

		// 自分の確保済みの票
		$mob = $this->request->data('MyAllocatedVote.mobile');
		$mob = (empty($mob) || !ctype_digit($mob)) ? 0 : 1;
		$sum += intval($mob) * 10;
		$other = $this->request->data('MyAllocatedVote.other');
		$other = (empty($other) || !ctype_digit($other)) ? 0 : intval($other);
		$sum += $other;

		// 友人・知人の票
		$mob = $this->request->data('FriendsVote.mobile');
		$mob = (empty($mob) || !ctype_digit($mob)) ? 0 : intval($mob);
		$sum += $mob * 5;
		$other = $this->request->data('FriendsVote.other');
		$other = (empty($other) || !ctype_digit($other)) ? 0 : intval($other);
		$sum += $other;
		
		// 大量購入残予算
		$money = $this->request->data('BulkBudget.money');
		$money = (empty($money) || !ctype_digit($money)) ? 0 : intval($money);
		$sum += $money / 800;
		
		return $sum;
	}
}
