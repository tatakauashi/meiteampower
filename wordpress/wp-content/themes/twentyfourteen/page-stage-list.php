<?php
/*
Template Name: stage-list
*/

namespace MEIMEI;

session_start();

include_once('inc/meimei_libs.php');
include_once('inc/stage_libs.php');

$wSearchCondHash = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["stage_period"])) {
		$json_string = json_encode($_POST);
		$key = getSearchKey($json_string);
		if (!empty($key)) {
			header("Location: /stage/stagelist?mei_s=$key");
			return;
		}

		$wNum = 1;
		$wIsSuccess = false;
		do {
			$key = genSearchKey($wNum++);
			$wIsSuccess = registerSearchCond($key, $json_string);
		} while ($wIsSuccess == false);

		header("Location: /stage/stagelist?mei_s=$key");
		return;
	} else {
		header("Location: /stage/stagelist");
		return;
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['mei_s'])) {
		$key = $_GET['mei_s'];
		$json_string = getSearchCond($key);
		if (empty($json_string)) {
			header("Location: /stage/stagelist");
			return;
		}
		$wSearchCondHash = json_decode($json_string, true);
		logSearchCond($key);
	}
} else {
	header("Location: /stage/stagelist");
	return;
}


// ログインの確認
$isLogined = false;
if (!is_user_logged_in()) {
	//header("Location: /message");
// 	include_once("404.php");
// 	exit;
} else {
	$isLogined = true;
}

// 日付指定方法
$stageDateSpecify = "0";
if (isset($wSearchCondHash["stage_date_specify"]) && $wSearchCondHash["stage_date_specify"] != "")
{
	$stageDateSpecify = $wSearchCondHash["stage_date_specify"];
}
$stageDateSpecifyInner = $stageDateSpecify;
$stageDateFrom = "";
if ($stageDateSpecify == "1" && isset($wSearchCondHash["stage_date_from"]) && $wSearchCondHash["stage_date_from"] != "")
{
	$stageDateFrom = $wSearchCondHash["stage_date_from"];
} else {
	$stageDateFrom = date("Y-m-d", time() - 31 * 24 * 60 * 60);
}
$stageDateTo = "";
if ($stageDateSpecify == "1" && isset($wSearchCondHash["stage_date_to"]) && $wSearchCondHash["stage_date_to"] != "")
{
	$stageDateTo = $wSearchCondHash["stage_date_to"];
}
$stageDateOneDay = "";
if (isset($wSearchCondHash["stage_date_one_day"]) && $wSearchCondHash["stage_date_one_day"] != "")
{
	$stageDateOneDay = $wSearchCondHash["stage_date_one_day"];
}

// 出演回数指定
$stageCount = 0;
if (isset($wSearchCondHash["stage_count"]) && $wSearchCondHash["stage_count"] != "" && ctype_digit($wSearchCondHash["stage_count"]) && intval($wSearchCondHash["stage_count"]) > 0)
{
	$stageCount = intval($wSearchCondHash["stage_count"]);
}

// レギュラー・シャッフル
$stageRegularShuffle = 0;
if (isset($wSearchCondHash["stage_regular_shuffle"]) && ($wSearchCondHash["stage_regular_shuffle"] == "0" || $wSearchCondHash["stage_regular_shuffle"] == "1" || $wSearchCondHash["stage_regular_shuffle"] == "2"))
{
	$stageRegularShuffle = intval($wSearchCondHash["stage_regular_shuffle"]);
}

// 特別公演を含むか
$inclSpecialStage = 1;
if (isset($wSearchCondHash["stage_include_special"]) && ($wSearchCondHash["stage_include_special"] == "0" || $wSearchCondHash["stage_include_special"] == "1" || $wSearchCondHash["stage_include_special"] == "2"))
{
	$inclSpecialStage = intval($wSearchCondHash["stage_include_special"]);
}

// ダブルチェックが必要なもののみ
$notDoubleCheckedOnly = false;
if (isset($wSearchCondHash["stage_not_double_checked_only"]) && $wSearchCondHash["stage_not_double_checked_only"] == "1")
{
	$notDoubleCheckedOnly = intval($wSearchCondHash["stage_not_double_checked_only"]) == 1;
}

// 出演メンバー指定の条件
$memberCond = 0;
if (isset($wSearchCondHash["member_cond"])) {
	if ($wSearchCondHash["member_cond"] == "1") { $memberCond = 1; }
}
// 出演していないメンバー指定の条件
$memberCond2 = 0;
if (isset($wSearchCondHash["member_cond2"])) {
	if ($wSearchCondHash["member_cond2"] == "1") { $memberCond2 = 1; }
}
// 公演の絞り込み条件
$stageCond = 0;
if (isset($wSearchCondHash["stage_cond"])) {
	if ($wSearchCondHash["stage_cond"] == "1") { $stageCond = 1; }
}

$rows = array();
if (!isset($wSearchCondHash["stage_register"])) {
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
	if (isset($wSearchCondHash["stage_members"]) && count($wSearchCondHash["stage_members"]) > 0 && $wSearchCondHash["stage_members"][0] != "0")
	{
		$stageMemberIds = $wSearchCondHash["stage_members"];
		$stageMemberIdsString = implode(",", $stageMemberIds);

		// 出演メンバーの条件 0. AND
		$memberCondString = " = " . count($stageMemberIds);
		if ($memberCond == 1) { $memberCondString = " > 0 "; }	// 1. OR

		// メンバーによる絞込み
//		$query .= " JOIN (SELECT selMem.stage_id, selMem.revision, COUNT(*) AS CNT FROM Stage_Member selMem WHERE selMem.member_id IN ($stageMemberIdsString) GROUP BY selMem.stage_id, selMem.revision) selMem2 ON (s.stage_id = selMem2.stage_id AND s.revision = selMem2.revision AND selMem2.CNT = " . count($stageMemberIds) . ") ";
		$query .= " JOIN (SELECT selMem.stage_id, selMem.revision, COUNT(*) AS CNT FROM Stage_Member selMem WHERE selMem.member_id IN ($stageMemberIdsString) GROUP BY selMem.stage_id, selMem.revision) selMem2 ON (s.stage_id = selMem2.stage_id AND s.revision = selMem2.revision AND selMem2.CNT " . $memberCondString . ") ";

		// 画面表示用のメンバー名のリスト
		$stageMemberNameList = getMemberNameList($stageMemberIds);
	}

	// イベントによる絞込み
	$eventIds = array();
	if (isset($wSearchCondHash["stage_events"]) && count($wSearchCondHash["stage_events"]) > 0 && $wSearchCondHash["stage_events"][0] != "0")
	{
		$eventIds = $wSearchCondHash["stage_events"];
		$eventIdsString = implode(",", $eventIds);
		// イベントのOR条件
 		$query .= " JOIN (SELECT selEvt.stage_id, MAX(selEvt.revision) AS revision FROM Stage_Event selEvt WHERE selEvt.event_id IN ($eventIdsString) GROUP BY selEvt.stage_id) selEvt2 ON (s.stage_id = selEvt2.stage_id AND s.revision = selEvt2.revision) ";

		// 画面表示用のイベント名のリスト
		$eventNameList = getEventNameList($eventIds);
	}
	
	$condition = " WHERE ";
	$param = array();
	$needPreparedStatement = 0;

	// 期間、または日付指定で絞込み
	if ($stageDateSpecifyInner == "0") {
		// 過去１か月
		$stageDateSpecifyInner = "1";
	}
	if ($stageDateSpecifyInner == "1")
	{
		if ($stageDateFrom != "")
		{
			$query .= $condition . " s.stage_date >= %s ";
			$condition = " AND ";
			$param[] = $stageDateFrom;
			$needPreparedStatement = 1;
		}
		if (isset($wSearchCondHash["stage_date_to"]) && $wSearchCondHash["stage_date_to"] != "")
		{
			$query .= $condition .  " s.stage_date <= %s ";
			$condition = " AND ";
			$param[] = $wSearchCondHash["stage_date_to"];
			$needPreparedStatement = 1;
		}
	}
	else if ($stageDateSpecifyInner == "2")
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
	if (isset($wSearchCondHash["stage_programs"]) && count($wSearchCondHash["stage_programs"]) > 0 && $wSearchCondHash["stage_programs"][0] != "0")
	{
		// 絞り込み条件
		$stageCondString = "";
		if ($stageCond == 1) { $stageCondString = " NOT "; }
		$programIds = $wSearchCondHash["stage_programs"];
		$programIdsString = implode(",", $programIds);		
		$query .= $condition .  " p.program_id $stageCondString IN ($programIdsString) ";
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

	// 出演していないメンバーによる絞込み
	$stageMemberIds2 = array();
	if (isset($wSearchCondHash["stage_members2"]) && count($wSearchCondHash["stage_members2"]) > 0 && $wSearchCondHash["stage_members2"][0] != "0")
	{
		$stageMemberIds2 = $wSearchCondHash["stage_members2"];
		$stageMemberIdsString2 = implode(",", $stageMemberIds2);

		// メンバーによる絞込み
		$query .= $condition . " NOT EXISTS (SELECT 'x' FROM Stage_Member selNotMem WHERE selNotMem.member_id IN ($stageMemberIdsString2) AND s.stage_id = selNotMem.stage_id AND s.revision = selNotMem.revision) ";

		// 画面表示用のメンバー名のリスト
		$stageMemberNameList2 = getMemberNameList($stageMemberIds2);
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
