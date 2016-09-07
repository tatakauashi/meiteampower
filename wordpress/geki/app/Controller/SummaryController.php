<?php

App::uses('AppController', 'Controller');

class SummaryController extends AppController {

	var $uses = array('History', 'Allocation',
					'MyAllocatedVote', 'FriendsVote', 'BulkBudget',
					'SummaryAccessLog', 'Vote'
	);

	public function beforeRender() {
		parent::beforeRender();
		$this->set("title_for_layout", "サマリー");

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
		
		// アクセスログを取る
		$this->SummaryAccessLog->save(
				$this->_getSummaryAccessLogRegistData($loginId, $userHash),
				false,
				$this->_getSummaryAccessLogFields());

//		$currentRevision = $this->History->getCurrentRevision($userHash);
		$votes = $this->Vote->get($userHash);	// ユーザーの投票数を取得する
// 		if ($currentRevision <= 0) {
		if ($votes < $this->UNDER_VOTES) {
			$this->redirect('../list/');
		}
		
		$datas = $this->History->getUsers();
		$this->set('datas', $datas);
		$this->set('historyCount', count($datas));
		$lastUpdate = $this->History->getLastUpdate();
		$isNewUpdate = false;
		if (empty($lastUpdate)) {
			$lastUpdate = '';
		}
		else {
			$lastUpdateDateTime = new DateTime($lastUpdate);
			$second = time() - $lastUpdateDateTime->getTimestamp();
			if ($second <= 60 * 60 * 24) {
				$isNewUpdate = true;
			}
		}
		$this->set('lastUpdate', $lastUpdate);
		$this->set('isNewUpdate', $isNewUpdate);

		$allocSummary = $this->Allocation->summary();
		$this->set('allocatesCount', $allocSummary['mei_count'] + $allocSummary['other_count']);
		$myAllocVoteSummary = $this->MyAllocatedVote->summary();
		$this->set('myAllocatedVotesMobile', $myAllocVoteSummary['mobile']);
		$this->set('myAllocatedVotesOther', $myAllocVoteSummary['other']);
		$friendsVoteSummary = $this->FriendsVote->summary();
		$this->set('friendsVotesMobile', $friendsVoteSummary['mobile']);
		$this->set('friendsVotesOther', $friendsVoteSummary['other']);
		$bulkBudgetSummary = $this->BulkBudget->summary();
		$this->set('bulkBudgetsMoney', $bulkBudgetSummary['money']);
		
		if (isset($this->request->query['m'])) {
			$this->set('memberList', 1);
		}

		// サマリーへの遷移を表示するか
		$this->set('openFlag', true);
	}

	// アクセスログ
	function _getSummaryAccessLogRegistData($loginId, $userHash) {
		$data = array('SummaryAccessLog' => array(
						'login_id' => $loginId,
						'user_hash' => $userHash,
						'ip_address' => $this->request->clientIp(),
						'regist_date' => date("Y-m-d H:i:s", time()/* + 9 * 60 * 60*/)
		));
		return $data;
	}
	function _getSummaryAccessLogFields() {
		$fields = array('login_id', 'user_hash',
						'ip_address', 'regist_date'
		);
	}
	
}