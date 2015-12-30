<?php
/*
Template Name: stage-list
*/

namespace MEIMEI;

include_once('inc/meimei_libs.php');

	// ログインの確認
	if (!is_user_logged_in()) {
		//header("Location: /message");
		include_once("404.php");
		exit;
	}

$rows = array();
if (!isset($_POST["stage_register"])) {
	// 一覧取得
	global $wpdb;
	$wpdb->show_errors();

	$query = "SELECT s.stage_id, s.stage_time, s.stage_date, p.program_name, t.team_name, s.is_shuffled + 0 AS is_shuffled, m2.CNT "
		. " FROM Stage s "
		. " JOIN Program p ON (s.program_id = p.program_id) "
		. " JOIN Team t ON (s.team_id = t.team_id) "
//		. " LEFT JOIN RelatedLink link ON (s.stage_id = link.stage_id) "
		. " LEFT JOIN (SELECT m.stage_id, COUNT(*) AS CNT FROM Stage_Member m WHERE m.delete_time is null GROUP BY m.stage_id ) m2 ON (s.stage_id = m2.stage_id) ";

	$condition = " WHERE ";
	$param = array();
	$needPreparedStatement = 0;
	if (isset($_POST["stage_date_from"]) && $_POST["stage_date_from"] != "")
	{
		$query .= $condition . " s.stage_date >= %s ";
		$condition = " AND ";
		$param[] = $_POST["stage_date_from"];
		$needPreparedStatement = 1;
	}
	if (isset($_POST["stage_date_to"]) && $_POST["stage_date_to"] != "")
	{
		$query .= $condition .  " s.stage_date <= %s ";
		$param[] = $_POST["stage_date_to"];
		$needPreparedStatement = 1;
	}
	$query .= " ORDER BY s.stage_id ";

	if ($needPreparedStatement != 0)
	{
		$query = $wpdb->prepare($query, $param);
	}
	$rows = $wpdb->get_results($query);
}

$stageDateFrom = "";
if (isset($_POST["stage_date_from"]) && $_POST["stage_date_from"] != "")
{
	$stageDateFrom = $_POST["stage_date_from"];
}
$stageDateTo = "";
if (isset($_POST["stage_date_to"]) && $_POST["stage_date_to"] != "")
{
	$stageDateTo = $_POST["stage_date_to"];
}

include_once('page-templates/page-stage-list.tpl');
