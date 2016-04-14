<?php
/*
Template Name: stage-list
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

// 日付指定方法
$stageDateSpecify = "1";
if (isset($_POST["stage_date_specify"]) && $_POST["stage_date_specify"] != "")
{
	$stageDateSpecify = $_POST["stage_date_specify"];
}
$stageDateFrom = "";
//if (isset($_POST["stage_date_from"]) && $_POST["stage_date_from"] != "")
if (isset($_POST["stage_date_from"]))
{
	$stageDateFrom = $_POST["stage_date_from"];
} else {
	$stageDateFrom = date("Y-m-d", time() - 31 * 24 * 60 * 60);
}
$stageDateTo = "";
if (isset($_POST["stage_date_to"]) && $_POST["stage_date_to"] != "")
{
	$stageDateTo = $_POST["stage_date_to"];
}
$stageDateOneDay = "";
if (isset($_POST["stage_date_one_day"]) && $_POST["stage_date_one_day"] != "")
{
	$stageDateOneDay = $_POST["stage_date_one_day"];
}

// 出演回数指定
$stageCount = 0;
if (isset($_POST["stage_count"]) && $_POST["stage_count"] != "" && ctype_digit($_POST["stage_count"]) && intval($_POST["stage_count"]) > 0)
{
	$stageCount = intval($_POST["stage_count"]);
}

// レギュラー・シャッフル
$stageRegularShuffle = 0;
if (isset($_POST["stage_regular_shuffle"]) && ($_POST["stage_regular_shuffle"] == "0" || $_POST["stage_regular_shuffle"] == "1" || $_POST["stage_regular_shuffle"] == "2"))
{
	$stageRegularShuffle = intval($_POST["stage_regular_shuffle"]);
}

// 特別公演を含むか
$inclSpecialStage = 1;
if (isset($_POST["stage_include_special"]) && ($_POST["stage_include_special"] == "0" || $_POST["stage_include_special"] == "1" || $_POST["stage_include_special"] == "2"))
{
	$inclSpecialStage = intval($_POST["stage_include_special"]);
}

// ダブルチェックが必要なもののみ
$notDoubleCheckedOnly = false;
if (isset($_POST["stage_not_double_checked_only"]) && $_POST["stage_not_double_checked_only"] == "1")
{
	$notDoubleCheckedOnly = intval($_POST["stage_not_double_checked_only"]) == 1;
}

$rows = array();
if (!isset($_POST["stage_register"])) {
	// 一覧取得
	global $wpdb;
	$wpdb->show_errors();

	$query = "SELECT s.stage_id, s.stage_time, s.stage_date, p.program_id, p.program_name, t.team_name, s.is_shuffled + 0 AS is_shuffled, s.delete_time, m2.CNT "
		. " FROM Stage s "
		. " JOIN (SELECT s2.stage_id, MAX(s2.revision) AS revision FROM Stage s2 GROUP BY s2.stage_id) sRev ON (s.stage_id = sRev.stage_id AND s.revision = sRev.revision) "
		. " JOIN Program p ON (s.program_id = p.program_id) "
		. " JOIN Team t ON (s.team_id = t.team_id) "
//		. " LEFT JOIN RelatedLink link ON (s.stage_id = link.stage_id) "
		. " LEFT JOIN (SELECT m.stage_id, m.revision, COUNT(*) AS CNT FROM Stage_Member m WHERE m.delete_time is null GROUP BY m.stage_id, m.revision ) m2 ON (s.stage_id = m2.stage_id AND s.revision = m2.revision) ";

	// 出演メンバーによる絞込み
	$stageMemberIds = array();
	if (isset($_POST["stage_members"]) && count($_POST["stage_members"]) > 0 && $_POST["stage_members"][0] != 0)
	{
		$stageMemberIds = $_POST["stage_members"];
		$stageMemberIdsString = implode(",", $stageMemberIds);
		// メンバーのOR条件
// 		$query .= " JOIN (SELECT selMem.stage_id, MAX(selMem.revision) AS revision FROM Stage_Member selMem WHERE selMem.member_id IN ($stageMemberIdsString) GROUP BY selMem.stage_id) selMem2 ON (s.stage_id = selMem2.stage_id AND s.revision = selMem2.revision) ";
		// メンバーのAND条件
		$query .= " JOIN (SELECT selMem.stage_id, selMem.revision, COUNT(*) AS CNT FROM Stage_Member selMem WHERE selMem.member_id IN ($stageMemberIdsString) GROUP BY selMem.stage_id, selMem.revision) selMem2 ON (s.stage_id = selMem2.stage_id AND s.revision = selMem2.revision AND selMem2.CNT = " . count($stageMemberIds) . ") ";

		// 画面表示用のメンバー名のリスト
		$stageMemberNameList = getMemberNameList($stageMemberIds);
	}
	
	// イベントによる絞込み
	$eventIds = array();
	if (isset($_POST["stage_events"]) && count($_POST["stage_events"]) > 0 && $_POST["stage_events"][0] != 0)
	{
		$eventIds = $_POST["stage_events"];
		$eventIdsString = implode(",", $eventIds);
		// イベントのOR条件
 		$query .= " JOIN (SELECT selEvt.stage_id, MAX(selEvt.revision) AS revision FROM Stage_Event selEvt WHERE selEvt.event_id IN ($eventIdsString) GROUP BY selEvt.stage_id) selEvt2 ON (s.stage_id = selEvt2.stage_id AND s.revision = selEvt2.revision) ";

		// 画面表示用のイベント名のリスト
		$eventNameList = getEventNameList($eventIds);
	}
	
	$condition = " WHERE ";
	$param = array();
	$needPreparedStatement = 0;
//	if (isset($_POST["stage_date_from"]) && $_POST["stage_date_from"] != "")
	// 期間、または日付指定で絞込み
	if ($stageDateSpecify == "1")
	{
		if ($stageDateFrom != "")
		{
			$query .= $condition . " s.stage_date >= %s ";
			$condition = " AND ";
			$param[] = $stageDateFrom;
			$needPreparedStatement = 1;
		}
		if (isset($_POST["stage_date_to"]) && $_POST["stage_date_to"] != "")
		{
			$query .= $condition .  " s.stage_date <= %s ";
			$condition = " AND ";
			$param[] = $_POST["stage_date_to"];
			$needPreparedStatement = 1;
		}
	}
	else if ($stageDateSpecify == "2")
	{
		if ($stageDateOneDay != "")
		{
			$query .= $condition . " s.stage_date = %s ";
			$condition = " AND ";
			$param[] = $stageDateOneDay;
			$needPreparedStatement = 1;
		}
	}

	// 公演名で絞込み
	$programIds = array();
	if (isset($_POST["stage_programs"]) && count($_POST["stage_programs"]) > 0 && $_POST["stage_programs"][0] != 0)
	{
		$programIds = $_POST["stage_programs"];
		$programIdsString = implode(",", $programIds);		
		$query .= $condition .  " p.program_id IN ($programIdsString) ";
		$condition = " AND ";
		
		// 画面表示用の公演名のリスト
		$programNameList = getProgramNameList($programIds);
	}

	// レギュラー公演かシャッフル公演で絞込み
	if ($stageRegularShuffle != 0) {
		if ($stageRegularShuffle == 1) {
			// レギュラー公演のみ
			$query .= $condition .  " s.is_shuffled = b'0' ";
			$condition = " AND ";
		}
		else {
			// シャッフル公演のみ
			$query .= $condition .  " s.is_shuffled = b'1' ";
			$condition = " AND ";
		}
	}

	// 特別公演を含むかどうかのフィルタ
	if ($inclSpecialStage != 0) {
		if ($inclSpecialStage == 1) {
			// 特別公演を含まない
			$query .= $condition .  " s.program_id != 51 ";
			$condition = " AND ";
		}
		else {
			// 特別公演のみ
			$query .= $condition .  " s.program_id = 51 ";
			$condition = " AND ";
		}
	}

	// ダブルチェックが必要な公演のみか
	if ($notDoubleCheckedOnly) {
		$query .= $condition .  " s.is_unofficial = b'1' ";
		$condition = " AND ";
	}
	
	$query .= $condition . " s.delete_time IS NULL ";
	$query .= " ORDER BY s.stage_id ";

	// 出演回数指定
	if ($stageCount > 0)
	{
		$query .= " limit %d ";
		$param[] = $stageCount;
	}

	if ($needPreparedStatement != 0)
	{
		$query = $wpdb->prepare($query, $param);
	}
	$rows = $wpdb->get_results($query);
}

// メンバーリスト
$memberInfoList = getMembers();
// 演目リスト
$programList = getPrograms();
// イベントリスト
$eventList = getEvents();
include_once('page-templates/page-stage-list.tpl');
