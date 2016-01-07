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

$stageId = 0;
$stageDate = null;
if (isset($_POST["stage_register"])) {
	// 日付
	$stageDate = $_POST["stage_date"];

	// チーム
	$teamId = $_POST["stage_team"];

	// シャッフル？
	$isShuffled = 0;
	if (isset($_POST["stage_shuffled"]))
	{
		$isShuffled = 1;
	}
	
	// 非公式情報か
	$isUnofficial = 0;
	if (isset($_POST["stage_unofficial"]))
	{
		$isUnofficial = 1;
	}
	
	// 公演名
	$programId = $_POST["stage_program"];
		
	// 出演メンバー
	$memberIds = getMemberIds($_POST["stage_members"]);
	
	// リンク
	$links = explode("\n", $_POST["stage_links"]);
	$links = array_map('trim', $links);
	$links = array_filter($links, 'strlen');

	// 何回目
	$stageTimes = $_POST["stage_time"];

	// イベント
	$eventIds = array();
	$eventMemberIds = array();
	for ($i = 1; $i <= 3; $i++) {
		if (isset($_POST["stage_event" . $i]) && isset($_POST["stage_event_member" . $i])
				&& $_POST["stage_event" . $i] != "0"
// 				&& $_POST["stage_event_member" . $i] != "0") {
				) {
			$eventIds[] = intval($_POST["stage_event" . $i]);
			$eventMemberIds[] = intval($_POST["stage_event_member" . $i]);
		}
	}
	
	// コメント
	$stageComment = "";
	if (isset($_POST["stage_comment"]) && $_POST["stage_comment"] != null) {
		$stageComment = $_POST["stage_comment"];
	}

	// 公演を登録する
	$stageId = registerStage($stageDate, $stageTimes, $teamId, $isShuffled, $isUnofficial,
			$programId, $memberIds, $links, $eventIds, $eventMemberIds, $stageComment);

	if ($stageId > 0) {
		header("Location: /stage?stage_id=" . $stageId);
		return;
	} else {
		include_once('page-templates/page-stage-input.tpl');
		return;
	}
}
else
{
	if (isset($_GET["stage_id"]) && is_numeric($_GET["stage_id"])) {
		$isUpdate = 1;	// 変更画面であることを示す
		$stageId = $_GET["stage_id"];
	
		// 公演情報取得
		$stageInfo = getStageDetail($stageId);
		if ($stageInfo != null)
		{
			// 公演日
			$stageDate = $stageInfo[0]->stage_date;
	
			// チーム
			eval("\$teamSelected" . $stageInfo[0]->team_id . " = \" selected\";");
	
			// その日の回数
			eval("\$timeSelected" . $stageInfo[0]->stage_time . " = \" selected\";");
	
			// 公演
			eval("\$programSelected" . $stageInfo[0]->program_id . " = \" selected\";");
	
			// シャッフル？
			$shuffledChecked = "";
			if ($stageInfo[0]->is_shuffled == 1) $shuffledChecked = " checked";

			// 非公式か？
			$unofficialChecked = "";
			if ($stageInfo[0]->is_unofficial == 1) $unofficialChecked = " checked";

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
	$obj = (object) array(
		'stage_register' => isset($_POST["stage_register"]),
		'stage_date' => preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["stage_date"]) == 1 ? $_POST["stage_date"] : "",
		'stage_shuffled' => isset($_POST["stage_shuffled"]),
		'stage_unofficial' => isset($_POST["stage_unofficial"]),
		'stage_program' => preg_match('/^\d{1,2}$/', $_POST["stage_program"]) ? intval($_POST["stage_program"]) : 0,
		'stage_members' => isset($_POST["stage_members"]) ? $_POST["stage_members"] : "",
		'stage_event' => array(),
		'stage_comment' => isset($_POST["stage_comment"]) ? $_POST["stage_comment"] : ""
	);
	$eventIndex = 0;
	for ($i = 0; $i < 3; $i++) {
		if (isset($_POST["stage_event" . $i]) && $_POST["stage_event" . $i] != "0"
				&& preg_match('/^\d$/', $_POST["stage_event" . $i])) {
			$obj[$eventIndex] = array(
				'event_id' => $_POST["stage_event" . $i],
				'member_id' => preg_match('/^\d+$/', $_POST["stage_event_member" . $i]) ? $_POST["stage_event_member" . $i] : 0
			);
			$eventIndex++;
		}
	}
	return $obj;
}