<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48公演登録フォーム</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php /* wp_enqueue_script("jquery-effects-core"); */ ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-stage.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-stage-input.js?<?php echo date('YmdHis'); ?>"></script>
<?php
// 変更画面か
$inputReadOnly = " "; $inputDisabled = "";
if (isset($display->is_update) && $display->is_update)
{
	$inputReadOnly = " readonly";
	$inputDisabled = " disabled";
}

$stageDate;
if (!isset($stageDate)) $stageDate = "";

$teamSelected1; $teamSelected2; $teamSelected3; $teamSelected4; $teamSelected99;
if (!isset($teamSelected1)) $teamSelected1 = "";
if (!isset($teamSelected2)) $teamSelected2 = "";
if (!isset($teamSelected3)) $teamSelected3 = "";
if (!isset($teamSelected4)) $teamSelected4 = "";
if (!isset($teamSelected99)) $teamSelected99 = "";

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
$unofficialChecked;
if (!isset($unofficialChecked)) $unofficialChecked = "";
$memberNameList;
if (!isset($memberNameList)) $memberNameList = array();

$linkStringList;
if (!isset($linkStringList)) $linkStringList = array();

$memberInfoList;
if (!isset($memberInfoList)) $memberInfoList = "";
?>
</head>
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title">
<?php if ($isLogined) { ?>
<a href="<?php echo get_permalink() ?><?php printHtml((!isset($display->stage_date) || $display->stage_date == "") ? "" : "?stage_date=$display->stage_date") ?>">
<?php } ?>
<?php the_title(); ?>
<?php if ($isLogined) { ?>
</a>
<?php } ?>
</h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
		<?php wp_nonce_field('meimei_stage_register'); ?>
		<input type="hidden" id="revision" name="revision" value="<?php printHtml($display->revision) ?>">
<article class="main">
<?php if (isset($display->error_message)) { ?>
	<p style="color:red; text-decoration: bold; text-align:center;"><?php printHtml($display->error_message) ?></p>
<?php } ?>
	<div class="stage-navi">
		<div><?php if (!empty($display->previousStage)) {
			echo "<a href=\"" . get_permalink() . "?stage_id=" . $display->previousStage->stage_id . "\">" . "<< " . $display->previousStage->stage_date . " " . $display->previousStage->stage_time . "回目 " . $display->previousStage->program_name . "</a>";
		} ?></div>
		<div><?php if (!empty($display->nextStage)) {
			echo "<a href=\"" . get_permalink() . "?stage_id=" . $display->nextStage->stage_id . "\">" . ">> " . $display->nextStage->stage_date . " " . $display->nextStage->stage_time . "回目 " . $display->nextStage->program_name . "</a>";
		} ?></div>
	</div>
	<div class="formarea" style="clear:both;">
		<p><label>
			日付：<br>
			<input type="date" id="stage_date" name="stage_date" value="<?php echo $display->stage_date ?>" <?php echo $inputReadOnly ?> required> <span id="stageDay"></span>
		</label></p>
		<p><label>
			何回目：<br>
			<select name="stage_time[]" multiple required>
<?php $days = array(1 => "１", 2 => "２", 3 => "３", 4 =>"４", 5 => "５"); for ($i = 1; $i <= 5; $i++) { ?>
				<option value="<?php echo $i ?>"<?php echo isset($display->stage_time) && in_array($i, $display->stage_time) ? " selected" : $inputDisabled ?>><?php echo $days[$i] ?>回目</option>
<?php } ?>
			</select>
		</label></p>
		<p><label>
			チーム：<br>
			<select id="stage_team" name="stage_team" required>
				<option value="1"<?php echo isset($display->stage_team) && $display->stage_team == 1 ? " selected" : "" ?>>チームＳ</option>
				<option value="2"<?php echo isset($display->stage_team) && $display->stage_team == 2 ? " selected" : "" ?>>チームＫⅡ</option>
				<option value="3"<?php echo isset($display->stage_team) && $display->stage_team == 3 ? " selected" : "" ?>>チームＥ</option>
				<option value="4"<?php echo isset($display->stage_team) && $display->stage_team == 4 ? " selected" : "" ?>>研究生</option>
				<option value="99"<?php echo isset($display->stage_team) && $display->stage_team == 99 ? " selected" : "" ?>>その他</option>
			</select>
		</label></p>
		<p><label>シャッフル？ <input type="checkbox" name="stage_shuffled"<?php echo isset($display->stage_shuffled) && $display->stage_shuffled ? " checked" : "" ?>></label></p>
		<p><label>ダブルチェックが必要？ <input type="checkbox" name="stage_unofficial" <?php echo isset($display->stage_unofficial) && $display->stage_unofficial ? " checked" : "" ?>></label></p>
		<p>
		<label>公演名：<br>
			<select id="stage_program" name="stage_program" required>
				<option value="0">選択してください</option>
				<option value="1"<?php echo isset($display->stage_program) && $display->stage_program == 1 ? " selected" : "" ?>>PARTYが始まるよ</option>
				<option value="2"<?php echo isset($display->stage_program) && $display->stage_program == 2 ? " selected" : "" ?>>手をつなぎながら</option>
				<option value="3"<?php echo isset($display->stage_program) && $display->stage_program == 3 ? " selected" : "" ?>>会いたかった</option>
				<option value="4"<?php echo isset($display->stage_program) && $display->stage_program == 4 ? " selected" : "" ?>>制服の芽</option>
				<option value="5"<?php echo isset($display->stage_program) && $display->stage_program == 5 ? " selected" : "" ?>>パジャマドライブ</option>
				<option value="6"<?php echo isset($display->stage_program) && $display->stage_program == 6 ? " selected" : "" ?>>ラムネの飲み方</option>
				<option value="7"<?php echo isset($display->stage_program) && $display->stage_program == 7 ? " selected" : "" ?>>逆上がり</option>
				<option value="8"<?php echo isset($display->stage_program) && $display->stage_program == 8 ? " selected" : "" ?>>RESET</option>
				<option value="9"<?php echo isset($display->stage_program) && $display->stage_program == 9 ? " selected" : "" ?>>シアターの女神</option>
				<option value="10"<?php echo isset($display->stage_program) && $display->stage_program == 10 ? " selected" : "" ?>>僕の太陽</option>
				<option value="11"<?php echo isset($display->stage_program) && $display->stage_program == 11 ? " selected" : "" ?>>アップカミング</option>
				<option value="12"<?php echo isset($display->stage_program) && $display->stage_program == 12 ? " selected" : "" ?>>ミッドナイト</option>
				<option value="13"<?php echo isset($display->stage_program) && $display->stage_program == 13 ? " selected" : "" ?>>0start</option>
				<option value="14"<?php echo isset($display->stage_program) && $display->stage_program == 14 ? " selected" : "" ?>>重ねた足跡</option>
				<option value="50"<?php echo isset($display->stage_program) && $display->stage_program == 50 ? " selected" : "" ?>>兼任先等の公演</option>
				<option value="51"<?php echo isset($display->stage_program) && $display->stage_program == 51 ? " selected" : "" ?>>特別公演</option>
			</select>
		</label>
		</p>

		<p><label>出演メンバー：<?php isset($display->memberNameList) ? printHtml("（" . count($display->memberNameList) . "名）") : "" ?><br>
		<textarea name="stage_members" rows="6"><?php printHtml(isset($display->memberNameList) ? implode("・", $display->memberNameList)
			: (isset($display->stage_member) ? $display->stage_member : "")) ?></textarea>
		</label></p>
		
		<p><label>関連リンク：
		<div style="word-wrap: break-word;">
		<?php if (isset($display->linkStringList)) { foreach ($display->linkStringList as $linkString) { ?>
			<a href="<?php printHtml($linkString) ?>" target="_blank"><?php printHtml($linkString) ?></a><br>
		<?php } } ?>
		</div>
		<textarea name="stage_links" rows="4"><?php printHtml(isset($display->linkStringList) ? implode("\n", $display->linkStringList)
			: (isset($display->stage_links) ? (is_array($display->stage_links) ? implode($display->stage_links) : $display->stage_links) : "")) ?></textarea>
		</label></p>

		<p>
		<div class="toggle-header" label="stage_event_register_area"><span>イベント登録</span></div>
		<div class="toggle-body" id="stage_event_register_area" style="display:<?php echo (!empty($display->stage_events) ? 'block' : 'none'); ?>;">

			<div>
				<p><label>イベント1<br>
					<select name="stage_event1">
						<option value="0">なし</option>
<?php foreach ($display->eventInfoList as $event) { ?>
						<option value="<?php printHtml($event->event_id) ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 0 && $display->stage_events[0]->event_id == $event->event_id ? " selected" : "" ?>><?php printHtml($event->event_name) ?></option>
<?php } ?>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member1">
						<option value="0">なし</option>
<?php foreach ($display->memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 0 && $display->stage_events[0]->member_id == $member->member_id ? " selected" : "" ?>><?php printHtml($member->member_name) ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

			<div>
				<p><label>イベント2<br>
					<select name="stage_event2">
						<option value="0">なし</option>
<?php foreach ($display->eventInfoList as $event) { ?>
						<option value="<?php printHtml($event->event_id) ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 1 && $display->stage_events[1]->event_id == $event->event_id ? " selected" : "" ?>><?php printHtml($event->event_name) ?></option>
<?php } ?>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member2">
						<option value="0">なし</option>
<?php foreach ($display->memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 1 && $display->stage_events[1]->member_id == $member->member_id ? " selected" : "" ?>><?php printHtml($member->member_name) ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

			<div>
				<p><label>イベント3<br>
					<select name="stage_event3">
						<option value="0">なし</option>
<?php foreach ($display->eventInfoList as $event) { ?>
						<option value="<?php printHtml($event->event_id) ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 2 && $display->stage_events[2]->event_id == $event->event_id ? " selected" : "" ?>><?php printHtml($event->event_name) ?></option>
<?php } ?>
					</select>
				</label></p>
				<p><label>関連メンバー<br>
					<select name="stage_event_member3">
						<option value="0">なし</option>
<?php foreach ($display->memberInfoList as $member) { ?>
						<option value="<?php echo $member->member_id ?>"<?php echo isset($display->stage_events) && count($display->stage_events) > 2 && $display->stage_events[2]->member_id == $member->member_id ? " selected" : "" ?>><?php printHtml($member->member_name) ?></option>
<?php } ?>
					</select>
				</label></p>
			</div>

		</div>
		</p>
		
		<p>
			<p><label>
				コメント・メモ：<br>
				<textarea name="stage_comment" rows="4"><?php printHtml(isset($display->stage_comment) ? $display->stage_comment : "") ?></textarea>
			</label></p>
		</p>
		
<?php if ($isLogined) { ?>
		<p><label>
			<input type="submit" name="stage_register" value=" 登 録 " style="width:70%; display:block; margin:auto;">
		</label></p>
<?php } ?>
		
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
