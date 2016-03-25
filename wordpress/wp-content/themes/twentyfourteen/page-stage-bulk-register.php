<?php
/*
 Template Name: stage-bulk-register
*/

namespace MEIMEI;

include_once('inc/meimei_libs.php');
include_once('inc/stage_libs.php');

// ログインの確認
if (!is_user_logged_in() || wp_get_current_user()->user_login != "tatakauashi") {
	include_once("404.php");
	exit;
}

$successStages = array();
$errorStageDate = "";
$stageProgram = isset($_POST["stage_program"]) ? $_POST["stage_program"] : 0;
$stageTeam = isset($_POST["stage_team"]) ? $_POST["stage_team"] : 0;
if (!empty($stageProgram)) {
	$stageDataString = $_POST["stage_data"];
	$stageDates = explode("\r\n", $stageDataString);
	$stageDates = array_map('trim', $stageDates);
	$stageDates = array_filter($stageDates, 'strlen');
	
	$relatedLinks = array();
	$relatedLinks[] = $_POST["related_link"];

	foreach ($stageDates as $stageInfo) {
		$stageInfoArray = explode("：", $stageInfo);
		$stageInfoArray = array_map('trim', $stageInfoArray);
		$stageInfoArray = array_filter($stageInfoArray, 'strlen');
		
		$stageDate = $stageInfoArray[0];
		$stageTimes = array();
		$stageTimes[] = $stageInfoArray[1];
		$stageMemberIds = getMemberIds($stageInfoArray[2]);
		
// 		$successStages[] = $stageDate;
// 		$successStages[] = $stageTime;
// 		$successStages[] = join("・", $stageMemberIds);
// 		break;
		
		$registerInfo = (object) array(
			'stage_comment' => "",
			'stage_events' => array()
		);
		$registerInfo->stage_date = $stageDate;
		$registerInfo->stage_time = $stageTimes;
		$registerInfo->stage_members = $stageMemberIds;
		$registerInfo->stage_links = $relatedLinks;
		$registerInfo->stage_program = $stageProgram;
		$registerInfo->stage_team = $stageTeam;
		$registerInfo->stage_shuffled = false;
		$registerInfo->stage_unofficial = true;
		
		$stageId = registerStage($registerInfo);
		if ($stageId != 0) {
			array_push($successStages, $stageId);
		}
		else {
			$errorStageDate = $registerInfo->stage_date;
			break;
		}
	}
}

// 演目リスト
$programList = getPrograms();
?>
<!DOCTYPE html>
<html>
<head>
<title>公演バルク登録</title>
<meta chaset="UTF-8">
<meta name="robots" content="noindex">
<script type='text/javascript' src='http://sakaimei-senkyo.net/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script><script>jQueryWP = jQuery;</script>
<script type='text/javascript' src='http://sakaimei-senkyo.net/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script>
jQuery(function($) {
	$('#btnSubmit').click(function() {
		if ($("#stage_program").val() == 0 || $("#stage_team").val() == 0 || $("#related_link").val() == "") {
			alert("公演、チーム、関連リンクを入力してください。");
			return false;
		}
		return true;
	});
});
</script>
</head>
<body>
<?php
if (!empty($successStages)) {
	echo "<div>\r\n";
	foreach ($successStages as $val) {
		printHtml($val);
		echo ", <br>\r\n";
	}
	echo "</div>\r\n";
}
if (!empty($errorStageDate)) {
	echo "<div style='color:red;'>\r\n";
	printHtml($errorStageDate);
	echo "</div>\r\n";
}
?>
<form action="http://sakaimei-senkyo.net/stage/stagebulkregister" method="post">
<p><label>
公演：
<select id="stage_program" name="stage_program">
<option value="0">指定なし</option>
<?php foreach ($programList as $program) { ?>
<option value="<?php echo $program->program_id ?>"><?php echo $program->program_name ?></option>
<?php } ?>
</select>
</label></p>

<p><label>
チーム：
<select id="stage_team" name="stage_team">
	<option value="0" selected>選択してください</option>
	<option value="1">チームS</option>
	<option value="2">チームKⅡ</option>
	<option value="3">チームE</option>
	<option value="4">研究生</option>
	<option value="99">その他</option>
</select>
</label></p>

<p>関連リンク：<br>
<input type="text" id="related_link" name="related_link" style="width:100%"></p>

<p>
<textarea name="stage_data" style="width:100%; height:300px;"></textarea>
</p>

<p><input type="submit" id="btnSubmit" name="register" style="width:100%; height:3em;"></p>
</form>
</body>
</html>