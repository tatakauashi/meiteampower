<?php
/*
Template Name: stage-register
*/

namespace MEIMEI;

include_once('inc/meimei_libs.php');
include_once('inc/stage_libs.php');

// ログインの確認
$isLogined = false;
if (!is_user_logged_in()) {
	//header("Location: /message");
// 	include_once("404.php");
// 	exit;
} else {
	$isLogined = true;
}

$display = main();
include_once('page-templates/page-stage-input.tpl');
return;

function main()
{
	global $isLogined;

	// チェック済みのパラメータを取得する。
	$received = getReceivedParameter();
	// 公演詳細画面表示内容
	$display = (object) array();
	$display->stage_date = isset($received->stage_date) ? $received->stage_date : getSqlNowDate();

	//$stageDate = null;
	if (isset($received->stage_register) && $isLogined) {
		// 登録ボタン押下

		if (!$received->stage_register) {
			// 入力チェックの結果NG。画面再表示
			$display = $received;
		} else {
			// 公演を登録する
			$stageId = registerStage($received);
		
			if ($stageId > 0) {
				header("Location: /stage?stage_id=" . $stageId);
				return;
			} else {
				$display = $received;
				$display->error_message = "現在、登録ができません。";
// 				include_once('page-templates/page-stage-input.tpl');
// 				return;
			}
		}
	}
	else
	{
		if (isset($_GET["stage_id"]) && is_numeric($_GET["stage_id"])) {
			$display = (object) array();
			$display->is_update = true;	// 変更画面であることを示す
			$stageId = $_GET["stage_id"];
		
			// リビジョンを指定する
			$revision = -1;
			if (isset($_GET['revision']) && is_numeric($_GET['revision'])) {
				$revision = intval($_GET['revision']);
			}

			// 公演情報取得
			$stageInfos = getStageDetail($stageId, $revision);
			if ($stageInfos != null && count($stageInfos) > 0)
			{
				$stageInfo = $stageInfos[0];
				$display->stage_id = $stageInfo->stage_id;
				$display->revision = $stageInfo->revision;

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
// 				$display->stage_comment = array();
				$display->stage_comment = "";
// 				foreach ($stageInfo->commentList as $comment) {
// 					if ($comment != "") {
// 						$display->stage_comment[] = $comment;
// 					}
// 				}
				if (count($stageInfo->commentList) > 0) {
					$display->stage_comment = $stageInfo->commentList[0]->comment;
				}
			}
			else {
				$display->stage_date = getSqlNowDate();
				$display->revision = 0;
				$display->error_message = "該当する公演が見つかりません。";
			}
		}
		else {
			// 入力画面初期表示
			
// 			// 日付が指定されていた場合は、その日の編集を行う
// 			if (isset($_GET["stage_date"]) && $_GET["stage_date"] != "")
// 			{
// 				$display = (object) array();
// 				$display->stage_date = $_GET["stage_date"];
// 			}
			
			// デフォルトで、ダブルチェックが必要である旨のチェックをつけておく
			$display->stage_unofficial = true;
			$display->revision = 0;
			$display->stage_time[] = 1;
			
			if (!$isLogined) {
				$display->error_message = "現在、公演の登録・更新にはログインが必要です。";
			}
		}
	}

	// 前後の公演
	$display->previousStage = getPreviousStage(
			!empty($display->stage_id) ? $display->stage_id : 0, $display->stage_date);
	$display->nextStage = getNextStage(
			!empty($display->stage_id) ? $display->stage_id : 0, $display->stage_date);

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
			'revision' => isset($_POST["revision"]) && is_numeric($_POST["revision"]) ? intval($_POST["revision"]) : 0,
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
		if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'meimei_stage_register')) {
			$obj->error_message = "正しい入力を行ってください。";
		} else if ($obj->stage_date == "") {
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

	}
	else if (isset($_GET["stage_id"]) && preg_match('/^\d{10}$/', $_GET["stage_id"])) {
		// 公演情報表示
		$obj = (object) array('stage_id' => $_GET["stage_id"]);
		// 	} else if (isset($_POST["stage_date"]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["stage_date"]) == 1) {
	} else if (isset($_REQUEST["stage_date"]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST["stage_date"]) == 1) {
		// 登録画面を、日付を設定した状態で初期化
		$obj = (object) array('stage_date' => $_REQUEST["stage_date"]);
	}
	return $obj;
}