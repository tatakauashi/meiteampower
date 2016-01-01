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
<?php
// 変更画面か
$inputReadOnly = " "; $inputDisabled = "";
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

$programSelected1; $programSelected2; $programSelected3; $programSelected4; $programSelected5;
$programSelected6; $programSelected7; $programSelected8; $programSelected9; $programSelected10;
$programSelected11; $programSelected12;
if (!isset($programSelected1)) $programSelected1 = "";
if (!isset($programSelected2)) $programSelected2 = "";
if (!isset($programSelected3)) $programSelected3 = "";
if (!isset($programSelected4)) $programSelected4 = "";
if (!isset($programSelected5)) $programSelected5 = "";
if (!isset($programSelected6)) $programSelected6 = "";
if (!isset($programSelected7)) $programSelected7 = "";
if (!isset($programSelected8)) $programSelected8 = "";
if (!isset($programSelected9)) $programSelected9 = "";
if (!isset($programSelected10)) $programSelected10 = "";
if (!isset($programSelected11)) $programSelected11 = "";
if (!isset($programSelected12)) $programSelected12 = "";

$timeSelected1; $timeSelected2; $timeSelected3; $timeSelected4; $timeSelected5;
if (!isset($timeSelected1)) $timeSelected1 = $inputDisabled;
if (!isset($timeSelected2)) $timeSelected2 = $inputDisabled;
if (!isset($timeSelected3)) $timeSelected3 = $inputDisabled;
if (!isset($timeSelected4)) $timeSelected4 = $inputDisabled;
if (!isset($timeSelected5)) $timeSelected5 = $inputDisabled;

$shuffledChecked;
if (!isset($shuffledChecked)) $shuffledChecked = "";

$memberNameList;
if (!isset($memberNameList)) $memberNameList = array();

$linkStringList;
if (!isset($linkStringList)) $linkStringList = array();

$memberInfoList;
if (!isset($memberInfoList)) $memberInfoList = "";
?>
<script>
function changeStageDate(me)
{
	if (me.value != "") {
		var d = new Date(me.value);
		var span = document.getElementById('stageDay');
		while( span.firstChild ) {
		    span.removeChild( span.firstChild );
		}
		span.appendChild( document.createTextNode("(" + [ "日", "月", "火", "水", "木", "金", "土" ][d.getDay()] + ")") );
	}
}
</script>
</head>
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><a href="<?php echo get_permalink() ?><?php echo $stageDate == "" ? "" : "?stage_date=$stageDate" ?>"><?php the_title(); ?></a></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
	<div class="formarea">
		<div style="float:left; width:40%"><label>
			日付：<br>
			<input type="date" id="stage_date" name="stage_date" value="<?php echo $stageDate ?>" <?php echo $inputReadOnly ?> onchange="changeStageDate(this);"> <span id="stageDay"></span>
		</label></div>
		<div style="float:left; width:40%; margin-left: 1em;"><label>
			何回目：<br>
			<select name="stage_time[]" multiple>
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
				<option value="99" <?php echo $teamSelected99 ?>>その他</option>
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
				<option value="11" <?php echo $programSelected11 ?>>アップカミング</option>
				<option value="12" <?php echo $programSelected12 ?>>ミッドナイト</option>
			</select>
		</label>
		</p>

		<p><label>出演メンバー：（<?php echo count($memberNameList) ?> 名）<br>
		<textarea name="stage_members" rows="4" required><?php echo implode("・", $memberNameList) ?></textarea>
		</label></p>
		
		<p><label>関連リンク：<br>
		<?php foreach ($linkStringList as $linkString) { ?>
			<a href="<?php echo $linkString ?>" target="_blank"><?php echo $linkString ?></a><br>
		<?php } ?>
		<textarea name="stage_links" rows="2"><?php echo implode("\n", $linkStringList) ?></textarea>
		</label></p>

		<div id="stage_event_register_header">イベント登録 開く</div>
		<div id="stage_event_register_area">

			<div>
				<p><label>イベント1<br>
					<select name="stage_event1">
						<option value="0">なし</option>
						<option value="1" <?php echo isset($stageEventSelected1) && $stageEventSelected1 == 1 ? " selected" : "" ?>>生誕祭</option>
						<option value="2" <?php echo isset($stageEventSelected1) && $stageEventSelected1 == 2 ? " selected" : "" ?>>劇場最終公演</option>
						<option value="3" <?php echo isset($stageEventSelected1) && $stageEventSelected1 == 3 ? " selected" : "" ?>>AKB48劇場出張公演</option>
						<option value="4" <?php echo isset($stageEventSelected1) && $stageEventSelected1 == 4 ? " selected" : "" ?>>NMB48劇場出張公演</option>
						<option value="5" <?php echo isset($stageEventSelected1) && $stageEventSelected1 == 5 ? " selected" : "" ?>>HKT48劇場出張公演</option>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member1">
						<option value="0">なし</option>
<?php foreach ($memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>" <?php echo isset($stageEventMemberSelected1) && $stageEventMemberSelected1 == $member->member_id ? " selected" : "" ?>><?php echo $member->member_name ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

			<div>
				<p><label>イベント2<br>
					<select name="stage_event2">
						<option value="0">なし</option>
						<option value="1" <?php echo isset($stageEventSelected2) && $stageEventSelected2 == 1 ? " selected" : "" ?>>生誕祭</option>
						<option value="2" <?php echo isset($stageEventSelected2) && $stageEventSelected2 == 2 ? " selected" : "" ?>>劇場最終公演</option>
						<option value="3" <?php echo isset($stageEventSelected2) && $stageEventSelected2 == 3 ? " selected" : "" ?>>AKB48劇場出張公演</option>
						<option value="4" <?php echo isset($stageEventSelected2) && $stageEventSelected2 == 4 ? " selected" : "" ?>>NMB48劇場出張公演</option>
						<option value="5" <?php echo isset($stageEventSelected2) && $stageEventSelected2 == 5 ? " selected" : "" ?>>HKT48劇場出張公演</option>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member2">
						<option value="0">なし</option>
<?php foreach ($memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>" <?php echo isset($stageEventMemberSelected2) && $stageEventMemberSelected2 == $member->member_id ? " selected" : "" ?>><?php echo $member->member_name ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

			<div>
				<p><label>イベント3<br>
					<select name="stage_event3">
						<option value="0">なし</option>
						<option value="1" <?php echo isset($stageEventSelected3) && $stageEventSelected3 == 1 ? " selected" : "" ?>>生誕祭</option>
						<option value="2" <?php echo isset($stageEventSelected3) && $stageEventSelected3 == 2 ? " selected" : "" ?>>劇場最終公演</option>
						<option value="3" <?php echo isset($stageEventSelected3) && $stageEventSelected3 == 3 ? " selected" : "" ?>>AKB48劇場出張公演</option>
						<option value="4" <?php echo isset($stageEventSelected3) && $stageEventSelected3 == 4 ? " selected" : "" ?>>NMB48劇場出張公演</option>
						<option value="5" <?php echo isset($stageEventSelected3) && $stageEventSelected3 == 5 ? " selected" : "" ?>>HKT48劇場出張公演</option>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member3">
						<option value="0">なし</option>
<?php foreach ($memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>" <?php echo isset($stageEventMemberSelected3) && $stageEventMemberSelected3 == $member->member_id ? " selected" : "" ?>><?php echo $member->member_name ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

		</div>
		
		<div>
			<p><label>
				コメント・メモ：<br>
				<textarea name="stage_comment" rows="4"><?php echo isset($commentList) && count($commentList) > 0 ? $commentList[0]->comment : "" ?></textarea>
			</label></p>
		</div>
		
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
