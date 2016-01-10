<?php
/*
Template Name: stage-register
*/

namespace MEIMEI;

include_once('inc/meimei_libs.php');
include_once('inc/stage_libs.php');

// ログインの確認
if (!is_user_logged_in()) {
	//header("Location: /message");
	include_once("404.php");
	exit;
}

$display = main();
include_once('page-templates/page-stage-input.tpl');
return;

function main()
{
	// チェック済みのパラメータを取得する。
	$received = getReceivedParameter();
	// 公演詳細画面表示内容
	$display = (object) array();
	$display->stage_date = isset($received->stage_date) ? $received->stage_date : getSqlNowDate();

	//$stageDate = null;
	if (isset($received->stage_register)) {
		// 登録ボタン押下
		
		if (!$received->stage_register) {
			// 入力チェックの結果NG。画面再表示
			$display = $received;
		} else {
	// 		// 日付
	// 		$stageDate = $_POST["stage_date"];
		
	// 		// チーム
	// 		$teamId = $_POST["stage_team"];
		
	// 		// シャッフル？
	// 		$isShuffled = 0;
	// 		if (isset($_POST["stage_shuffled"]))
	// 		{
	// 			$isShuffled = 1;
	// 		}
			
	// 		// 非公式情報か
	// 		$isUnofficial = 0;
	// 		if (isset($_POST["stage_unofficial"]))
	// 		{
	// 			$isUnofficial = 1;
	// 		}
			
	// 		// 公演名
	// 		$programId = $_POST["stage_program"];
				
	// 		// 出演メンバー
	// 		$memberIds = getMemberIds($_POST["stage_members"]);
			
	// 		// リンク
	// 		$links = explode("\n", $_POST["stage_links"]);
	// 		$links = array_map('trim', $links);
	// 		$links = array_filter($links, 'strlen');
		
	// 		// 何回目
	// 		$stageTimes = $_POST["stage_time"];
		
	// 		// イベント
	// 		$eventIds = array();
	// 		$eventMemberIds = array();
	// 		for ($i = 1; $i <= 3; $i++) {
	// 			if (isset($_POST["stage_event" . $i]) && isset($_POST["stage_event_member" . $i])
	// 					&& $_POST["stage_event" . $i] != "0"
	// 	// 				&& $_POST["stage_event_member" . $i] != "0") {
	// 					) {
	// 				$eventIds[] = intval($_POST["stage_event" . $i]);
	// 				$eventMemberIds[] = intval($_POST["stage_event_member" . $i]);
	// 			}
	// 		}
			
	// 		// コメント
	// 		$stageComment = "";
	// 		if (isset($_POST["stage_comment"]) && $_POST["stage_comment"] != null) {
	// 			$stageComment = $_POST["stage_comment"];
	// 		}
		
			// 公演を登録する
			$stageId = registerStage($received);
		
			if ($stageId > 0) {
				header("Location: /stage?stage_id=" . $stageId);
				return;
			} else {
				$display = $received;
				include_once('page-templates/page-stage-input.tpl');
				return;
			}
		}
	}
	else
	{
		if (isset($_GET["stage_id"]) && is_numeric($_GET["stage_id"])) {
			$display = (object) array();
			$display->is_update = true;	// 変更画面であることを示す
			$stageId = $_GET["stage_id"];
		
			// 公演情報取得
			$stageInfos = getStageDetail($stageId);
			if ($stageInfos != null && count($stageInfos) > 0)
			{
				$stageInfo = $stageInfos[0];
				// 公演日
				$display->stage_date = $stageInfo->stage_date;
		
				// チーム
				$display->stage_team = $stageInfo->team_id;
		
				// その日の回数
				$display->stage_time = array(0 => $stageInfo->stage_time);
				
				// 公演
				$display->stage_program = $stageInfo->program_id;
		
				// シャッフル？
				$display->stage_shuffled = ($stageInfo->is_shuffled == 1);
	
				// 非公式か？
				$display->stage_unofficial = ($stageInfo->is_unofficial == 1);

				// 出演メンバー
				$display->memberNameList = array();
				if (isset($stageInfo->memberList))
				{
					foreach ($stageInfo->memberList as $member)
					{
						$display->memberNameList[] = $member->member_name;
					}
				}
	
				// 関連リンク
				$display->linkStringList = array();
				if (isset($stageInfo->linkList))
				{
					foreach ($stageInfo->linkList as $link)
					{
						$display->linkStringList[] = $link->link;
					}
				}

				// イベント
				$display->stage_events = array();
				if (isset($stageInfo->eventMemberList)
						&& count($stageInfo->eventMemberList) > 0) {
					$i = 1;
					foreach ($stageInfo->eventMemberList as $eventMember) {
						$display->stage_events[] = (object) array(
							'event_id' => $eventMember->event_id,
							'member_id' => $eventMember->member_id
						);
					}
				}
				
				// コメント
				$display->stage_comment = array();
				foreach ($stageInfo->commentList as $comment) {
					if ($comment != "") {
						$display->stage_comment[] = $comment;
					}
				}
			}
			else {
				$display->stage_date = getSqlNowDate();
				$display->error_message = "該当する公演が見つかりません。";
			}
		}
		else if (isset($_GET["stage_date"]) && $_GET["stage_date"] != "")
		{
			$display = (object) array();
			$display->stage_date = $_GET["stage_date"];
		}
	}
	
	// イベントリスト
	$display->eventInfoList = getEvents();
	// メンバーリスト
	$display->memberInfoList = getMembers($display->stage_date);
	return $display;
}

function getReceivedParameter()
{
	$obj = null;
	if (isset($_POST["stage_register"])) {
		// 登録ボタン押下時

		$obj = (object) array(
			'stage_date' => isset($_POST["stage_date"]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["stage_date"]) == 1 ? $_POST["stage_date"] : "",
			'stage_time' => isset($_POST["stage_time"]) && is_array($_POST["stage_time"])
				? $_POST["stage_time"] : array(),
			'stage_team' => isset($_POST["stage_team"]) && is_numeric($_POST["stage_team"]) ? intval($_POST["stage_team"]) : 0,
			'stage_shuffled' => isset($_POST["stage_shuffled"]),
			'stage_unofficial' => isset($_POST["stage_unofficial"]),
			'stage_program' => preg_match('/^\d{1,2}$/', $_POST["stage_program"]) ? intval($_POST["stage_program"]) : 0,
			'stage_members' => isset($_POST["stage_members"]) ? getMemberIds($_POST["stage_members"]) : array(),
			'stage_event' => array(),
			'stage_comment' => isset($_POST["stage_comment"]) ? $_POST["stage_comment"] : ""
		);
		
		// 関連リンク
		if (isset($_POST["stage_links"])) {
			$links = explode("\n", $_POST["stage_links"]);
			$links = array_map('trim', $links);
			$links = array_filter($links, 'strlen');
			$obj->stage_links = $links;
		} else {
			$obj->stage_links = array();
		}
		
		// イベント
		$obj->stage_events = array();
		for ($i = 1; $i <= 3; $i++) {
			if (isset($_POST["stage_event" . $i]) && $_POST["stage_event" . $i] != "0"
					&& is_numeric($_POST["stage_event" . $i])) {
				$obj->stage_events[] = (object) array(
					'event_id' => intval($_POST["stage_event" . $i]),
					'member_id' => isset($_POST["stage_event_member" . $i])
						&& is_numeric($_POST["stage_event_member" . $i])
							? intval($_POST["stage_event_member" . $i]) : 0
				);
			}
		}

		// 回数のチェックと調整
		$validTime = false;
		for ($i = 0; $i < count($obj->stage_time); $i++) {
			if (!is_numeric($obj->stage_time[$i])
					|| $obj->stage_time[$i] < 1 || $obj->stage_time[$i] > 5
					&& in_array($obj->stage_time[$i])) {
				$obj->stage_time[$i] = 0;
			} else {
				$validTime = true;
			}
		}
		if (!$validTime) {
			$obj->stage_time = array();
		}
		
		// チェック
		$obj->stage_register = false;
		if ($obj->stage_date == "") {
			$obj->error_message = "公演日を指定してください。";
		} else if (count($obj->stage_time) <= 0) {
			$obj->error_message = "公演日の回数を指定してください。";
		} else if($obj->stage_team <= 0) {
			$obj->error_message = "チームを指定してください。";
		} else if($obj->stage_program <= 0) {
			$obj->error_message = "公演を指定してください。";
		} else {
			// 登録可能
			$obj->stage_register = true;
			
		}

	} else if (isset($_GET["stage_id"]) && preg_match('/^\d{10}$/', $_GET["stage_id"])) {
		// 公演情報表示
		$obj = (object) array('stage_id' => $_GET["stage_id"]);
	} else if (isset($_POST["stage_date"]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["stage_date"]) == 1) {
		// 登録画面を、日付を設定した状態で初期化
		$obj = (object) array('stage_date' => $_POST["stage_date"]);
	}
	return $obj;
}