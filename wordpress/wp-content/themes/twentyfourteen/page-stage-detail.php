<?php
/*
Template Name: stage-detail
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

$isUpdate = 1;	// 変更画面であることを示す
$rows = array();
if (isset($_GET["stage_id"]) && is_numeric($_GET["stage_id"])) {
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
		
		// 出演メンバー
		$memberList = "";
		if (isset($stageInfo[0]->memberList))
		{
			$memberNameList = array();
			for ($i = 0; $i < count($stageInfo[0]->memberList); $i = $i + 1)
			{
				$memberNameList[] = $stageInfo[0]->memberList[$i]->member_name;
			}
			$memberList = implode("・", $memberNameList);
		}

		// 関連リンク
		$linkList = "";
		if (isset($stageInfo[0]->linkList))
		{
			$linkStringList = array();
			for ($i = 0; $i < count($stageInfo[0]->linkList); $i = $i + 1)
			{
				$linkStringList[] = $stageInfo[0]->linkList[$i]->link;
			}
			$linkList = implode("\n", $linkStringList);
		}

		include_once('page-templates/page-stage-input.tpl');
		return;
	}
}

include_once('page-templates/page-stage-list.tpl');
