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

// チェック済みのパラメータを取得する。
$received = getReceivedParameter();
// 公演詳細画面表示内容
$display = null;

//$stageId = 0;
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
		$isUpdate = 1;	// 変更画面であることを示す
		$display->is_update = 1;
		$stageId = $_GET["stage_id"];
	
		// 公演情報取得
		$stageInfo = getStageDetail($stageId);
		if ($stageInfo != null)
		{
			// 公演日
			$display->stage_date = $stageInfo[0]->stage_date;
	
			// チーム
			eval("\$teamSelected" . $stageInfo[0]->team_id . " = \" selected\";");
			$display->team_id = $stageInfo[0]->team_id;
	
			// その日の回数
			eval("\$timeSelected" . $stageInfo[0]->stage_time . " = \" selected\";");
			$display->stage_time = array(0 => $stageInfo[0]->stage_time);
			
			// 公演
			eval("\$programSelected" . $stageInfo[0]->program_id . " = \" selected\";");
			$display->stage_program = $stageInfo[0]->program_id;
	
			// シャッフル？
			$shuffledChecked = "";
			if ($stageInfo[0]->is_shuffled == 1) $shuffledChecked = " checked";
			$display->stage_shuffled = ($stageInfo[0]->is_shuffled == 1);

			// 非公式か？
			$unofficialChecked = "";
			if ($stageInfo[0]->is_unofficial == 1) $unofficialChecked = " checked";
			$display->stage_unofficial = ($stageInfo[0]->is_unofficial == 1);
			
			// 出演メンバー
			$memberNameList = array();
			if (isset($stageInfo[0]->memberList))
			{
				for ($i = 0; $i < count($stageInfo[0]->memberList); $i = $i + 1)
				{
					$memberNameList[] = $stageInfo[0]->memberList[$i]->member_name;
				}
			}

			// 関連リンク
			$linkStringList = array();
			if (isset($stageInfo[0]->linkList))
			{
				for ($i = 0; $i < count($stageInfo[0]->linkList); $i = $i + 1)
				{
					$linkStringList[] = $stageInfo[0]->linkList[$i]->link;
				}
			}

			// イベント
			if (isset($stageInfo[0]->eventMemberList)
					&& count($stageInfo[0]->eventMemberList) > 0) {
				$i = 1;
				foreach ($stageInfo[0]->eventMemberList as $eventMember) {
					eval("\$stageEventSelected" . $i . " = $eventMember->event_id;");
					eval("\$stageEventMemberSelected" . $i . " = $eventMember->member_id;");
					$i++;
				}
			}
			
			// コメント
			$commentList = array();
			foreach ($stageInfo[0]->commentList as $comment) {
				if ($comment != "") {
					$commentList[] = $comment;
				}
			}
		}
	}
	else if (isset($_GET["stage_date"]) && $_GET["stage_date"] != "")
	{
		$stageDate = $_GET["stage_date"];
	}
}

// メンバーリスト
$memberInfoList = getMembers($stageDate);
include_once('page-templates/page-stage-input.tpl');
return;

function getReceivedParameter()
{
	$obj = null;
	if (isset($_POST["stage_register"])) {
		// 登録ボタン押下時

		$obj = (object) array(
			'stage_register' => true,
			'stage_date' => isset($_POST["stage_date"]) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["stage_date"]) == 1 ? $_POST["stage_date"] : "",
			'stage_time' => isset($_POST["stage_time"]) && is_array($_POST["stage_time"])
				? $_POST["stage_time"] : array(),
			'stage_shuffled' => isset($_POST["stage_shuffled"]),
			'stage_unofficial' => isset($_POST["stage_unofficial"]),
			'stage_program' => preg_match('/^\d{1,2}$/', $_POST["stage_program"]) ? intval($_POST["stage_program"]) : 0,
			'stage_members' => isset($_POST["stage_members"]) ? getMemberIds($_POST["stage_members"]) : array(),
			'stage_event' => array(),
			'stage_comment' => isset($_POST["stage_comment"]) ? $_POST["stage_comment"] : ""
		);
		
		// 関連リンク
		if (isset($_POST["stage_links"]) && is_array($_POST["stage_links"])) {
			$links = explode("\n", $_POST["stage_links"]);
			$links = array_map('trim', $links);
			$links = array_filter($links, 'strlen');
			$obj->stage_links = $links;
		} else {
			$obj->stage_links = array();
		}
		
		// イベント
		$eventIndex = 0;
		for ($i = 0; $i < 3; $i++) {
			if (isset($_POST["stage_event" . $i]) && $_POST["stage_event" . $i] != "0"
					&& preg_match('/^\d$/', $_POST["stage_event" . $i])) {
				$obj[$eventIndex] = (object) array(
					'event_id' => $_POST["stage_event" . $i],
					'member_id' => preg_match('/^\d+$/', $_POST["stage_event_member" . $i]) ? $_POST["stage_event_member" . $i] : 0
				);
				$eventIndex++;
			}
		}

		// チェック
		$obj->stage_register = false;
		if ($obj->stage_date == "") {
			$obj->error_message = "公演日を指定してください。";
		} else if (count($obj->stage_time) <= 0) {
			$obj->error_message = "公演日の回数を指定してください。";
		} else if($obj->stage_program > 0) {
			$obj->error_message = "公演を指定してください。";
		} else {
			// 登録可能
			$obj->stage_register = true;
			
			// 回数のチェックと調整
			for ($i = 0; $i < 5; $i++) {
				if (!preg_match('/^\d$/', $obj->stage_time[$i])
						|| $obj->stage_time[$i] < 1 || $obj->stage_time[$i] > 5) {
					$obj->stage_time[$i] = 0;
				}
			}
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