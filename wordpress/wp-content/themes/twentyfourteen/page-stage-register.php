<?php
/*
Template Name: stage-register
*/

namespace MEIMEI;

include_once('inc/meimei_libs.php');

	// ログインの確認
	if (!is_user_logged_in()) {
		//header("Location: /message");
		include_once("404.php");
		exit;
	}

if (isset($_POST["stage_register"])) {
	// 登録処理
	global $wpdb;
	$wpdb->show_errors();
	array_push($wpdb->tables, 'Stage');
	array_push($wpdb->tables, 'Member');
	array_push($wpdb->tables, 'Stage_Member');
	array_push($wpdb->tables, 'Related_Link');

	// 日付
	$stageDate = $_POST["stage_date"];

	// チーム
	$teamId = $_POST["stage_team"];

	// シャッフル？
	$isShuffle = 0;
	if (isset($_POST["stage_shuffle"]))
	{
		$isShuffle = 1;
	}

	// 公演名
	$programId = $_POST["stage_program"];
		
	// 出演メンバー
	$stageMembers = explode("・", $_POST["stage_members"]);
	$memberIds = array();
	foreach ($stageMembers as $memberName)
	{
		$query = "SELECT member_id FROM Member WHERE member_name = %s ";
		$rows = $wpdb->get_results($wpdb->prepare($query, $memberName));
		if (count($rows) > 0)
		{
			$memberIds[] = $rows[0]->member_id;
		}
	}
	
	// リンク
	$links = explode("\n", $_POST["stage_links"]);
	$links = array_map('trim', $links);
	$links = array_filter($links, 'strlen');

	$results = array();
	$wpdb->query('START TRANSACTION');

	// 何回目
	$stageTimes = $_POST["stage_time"];
	foreach ($stageTimes as $stageTime)
	{
		$stageId = str_replace("-", "", $stageDate) . "0" . $stageTime;

		// 公演の登録
		$results[] = $wpdb->insert(
			'Stage',
			array(
				'stage_id' => $stageId,
				'program_id' => $programId,
				'team_id' => $teamId,
				'stage_date' => $stageDate,
				'stage_time' => $stageTime,
				'is_shuffled' => $isShuffle,
				'regist_time' => date("Y-m-d H:i:s TO")
			),
			array(
				'%d',
				'%d',
				'%d',
				'%s',
				'%d',
				'%d',
				'%s'
			)
		);
		
		// 出演メンバー
		foreach ($memberIds as $memberId)
		{
			$results[] = $wpdb->insert(
				'Stage_Member',
				array(
					'stage_id' => $stageId,
					'member_id' => $memberId,
					'regist_time' => date("Y-m-d H:i:s TO")
				),
				array(
					'%d',
					'%d',
					'%s'
				)
			);
		}
		
		// リンク
		foreach ($links as $link)
		{
			$results[] = $wpdb->insert(
				'Related_Link',
				array(
					'stage_id' => $stageId,
					'link' => $link,
					'regist_time' => date("Y-m-d H:i:s TO")
				),
				array(
					'%d',
					'%s',
					'%s'
				)
			);
		};
	}
	
	$success = 1;
	foreach ($results as $result)
	{
		$success = $success * $result;
	}
	if ($success > 0)
	{
		$wpdb->query("COMMIT;");
	}
	else
	{
		$wpdb->query("ROLLBACK;");
	}
}

include_once('page-templates/page-stage-input.tpl');
