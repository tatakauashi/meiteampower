<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48公演登録フォーム</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<?php
// 変更画面か
$inputReadOnly = ""; $inputDisabled = "";
if (isset($isUpdate) && $isUpdate == 1)
{
	$inputReadOnly = " readonly";
	$inputDisabled = " disabled";
}

$stageDate;
if (!isset($stageDate)) $stageDate = "";

$teamSelected1; $teamSelected2; $teamSelected3; $teamSelected4;
if (!isset($teamSelected1)) $teamSelected1 = "";
if (!isset($teamSelected2)) $teamSelected2 = "";
if (!isset($teamSelected3)) $teamSelected3 = "";
if (!isset($teamSelected4)) $teamSelected4 = "";

$timeSelected1; $timeSelected2; $timeSelected3; $timeSelected4; $timeSelected5;
$timeSelected6; $timeSelected7; $timeSelected8; $timeSelected9; $timeSelected10;
if (!isset($timeSelected1)) $timeSelected1 = "";
if (!isset($timeSelected2)) $timeSelected2 = "";
if (!isset($timeSelected3)) $timeSelected3 = "";
if (!isset($timeSelected4)) $timeSelected4 = "";
if (!isset($timeSelected5)) $timeSelected5 = "";
if (!isset($timeSelected6)) $timeSelected6 = "";
if (!isset($timeSelected7)) $timeSelected7 = "";
if (!isset($timeSelected8)) $timeSelected8 = "";
if (!isset($timeSelected9)) $timeSelected9 = "";
if (!isset($timeSelected10)) $timeSelected10 = "";

$programSelected1; $programSelected2; $programSelected3; $programSelected4; $programSelected5;
if (!isset($programSelected1)) $programSelected1 = "";
if (!isset($programSelected2)) $programSelected2 = "";
if (!isset($programSelected3)) $programSelected3 = "";
if (!isset($programSelected4)) $programSelected4 = "";
if (!isset($programSelected5)) $programSelected5 = "";

$shuffledChecked;
if (!isset($shuffledChecked)) $shuffledChecked = "";

$memberList;
if (!isset($memberList)) $memberList = "";

$linkList;
if (!isset($linkList)) $linkList = "";
?>
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
	<div class="formarea">
		<div style="float:left; width:40%"><label>
			日付：<br>
			<input type="date" name="stage_date" value="<?php echo $stageDate ?>" <?php echo $inputReadOnly ?>>
		</label></div>
		<div style="float:left; width:40%; margin-left: 1em;"><label>
			何回目：<br>
			<select name="stage_time[]" multiple <?php echo $inputDisabled ?>>
				<option value="1" <?php echo $timeSelected1 ?>>１回目</option>
				<option value="2" <?php echo $timeSelected2 ?>>２回目</option>
				<option value="3" <?php echo $timeSelected3 ?>>３回目</option>
				<option value="4" <?php echo $timeSelected4 ?>>４回目</option>
				<option value="5" <?php echo $timeSelected5 ?>>５回目</option>
			</select>
		</label></div>
		<p style="clear:both;">
		<p><label>
			チーム：<br>
			<select name="stage_team">
				<option value="1" <?php echo $teamSelected1 ?>>チームＳ</option>
				<option value="2" <?php echo $teamSelected2 ?>>チームＫⅡ</option>
				<option value="3" <?php echo $teamSelected3 ?>>チームＥ</option>
				<option value="4" <?php echo $teamSelected4 ?>>研究生</option>
			</select>
		</label>
		<label style="margin-left:1em">シャッフル？<input type="checkbox" name="stage_shuffle" <?php echo $shuffledChecked ?>></label>
		</p>
		<p>
		<label>公演名：<br>
			<select name="stage_program">
				<option value="1" <?php echo $programSelected1 ?>>PARTYが始まるよ</option>
				<option value="2" <?php echo $programSelected2 ?>>手をつなぎながら</option>
				<option value="3" <?php echo $programSelected3 ?>>会いたかった</option>
				<option value="4" <?php echo $programSelected4 ?>>制服の芽</option>
				<option value="5" <?php echo $programSelected5 ?>>パジャマドライブ</option>
				<option value="6" <?php echo $programSelected6 ?>>ラムネの飲み方</option>
				<option value="7" <?php echo $programSelected7 ?>>逆上がり</option>
				<option value="8" <?php echo $programSelected8 ?>>RESET</option>
				<option value="9" <?php echo $programSelected9 ?>>シアターの女神</option>
				<option value="10" <?php echo $programSelected10 ?>>僕の太陽</option>
			</select>
		</label>
		</p>

		<p><label>出演メンバー：<br>
		<textarea name="stage_members" rows="4" required><?php echo $memberList ?></textarea>
		</label></p>
		
		<p><label>関連リンク：<br>
		<textarea name="stage_links" rows="2"><?php echo $linkList ?></textarea>
		</label></p>
		
		<p><label>
			<input type="submit" name="stage_register" value=" 登 録 " style="width:70%; display:block; margin:auto;">
		</label></p>
		
		<p><label>
			<a href="/stage/stagelist">リストへ</a>
		</label></p>
	</div>
<footer>
<small>
</small>
</footer>
</article>
</form>
<?php wp_footer(); ?>
</body>
</html>
