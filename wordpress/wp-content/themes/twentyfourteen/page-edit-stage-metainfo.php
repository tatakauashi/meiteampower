<?php
/*
 Template Name: stage-metainfo
 */

namespace MEIMEI;

include_once('inc/meimei_libs.php');
include_once('inc/stage_libs.php');

$stageInfoResult = "";
if (isset($_POST["convertStageInfo"])) {
	$memberNames = explode("\t", $_POST["memberName"]);
	$stageInfoMetaRows = explode("\r\n", $_POST["stageInfoMeta"]);

	$stageInfoResults = array();
	foreach ($stageInfoMetaRows as $row) {
		$row = trim($row);
		$stageInfoMetas = explode("\t", $row);
		$i = 0;
		$rows = array();
		$rows[] = $stageInfoMetas[$i++];
		$rows[] = $stageInfoMetas[$i++];

		foreach ($memberNames as $memberName) {
			if ($stageInfoMetas[$i] == "AAA") {
				$rows[] = $memberName;
			} else if ($stageInfoMetas[$i] == "BBB") {
				$rows[] = $memberName . "(一部出演)";
			}
			$i++;
		}
		$stageInfoResults[] = implode("\t", $rows);
	}
	$stageInfoResult = implode("\n", $stageInfoResults);
//	$stageInfoResult = implode("\n", $memberNames);
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48公演データ変換フォーム</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
</head>
<body>
<form action="<?php echo get_permalink() ?>" method="post">
<p><label>メンバー：<br><textarea name="memberName"></textarea></label></p>
<p><label>公演情報（メタ）)：<br><textarea name="stageInfoMeta"></textarea></label></p>
<p><label><input type="submit" name="convertStageInfo" value=" 変 換 "></label></p>
<p><label>公演情報（結果）：<br><textarea name="stageInfoResult"><?php printHtml($stageInfoResult) ?></textarea></label></p>
</form>
<?php wp_footer(); ?>
</body>
</html>