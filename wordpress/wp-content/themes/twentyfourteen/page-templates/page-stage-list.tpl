<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48公演リスト</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-stage-list.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
<?php if ($isLogined) { ?>
	<div style="text-align: right;"><a href="/stage">公演を登録するっ！</a></div>
<?php } ?>
	<div class="formarea">
		<p>
			<dl>
			<dt><label><input type="radio" id="stage_date_specify_duration" name="stage_date_specify" value="1" <?php echo isset($stageDateSpecify) && ($stageDateSpecify != "1") ? "" : "checked" ?>>期間：</label></dt>
			<dd><label>FROM:<br><input type="date" id="stage_date_from" name="stage_date_from" value="<?php echo $stageDateFrom ?>"></label></dd>
			<dd><label>To:<br><input type="date" id="stage_date_to" name="stage_date_to" value="<?php echo $stageDateTo ?>"></label></dd>
			</dl>

			<dl>
			<dt><label><input type="radio" id="stage_date_specify_one_day" name="stage_date_specify" value="2" <?php echo isset($stageDateSpecify) && ($stageDateSpecify == "2") ? "checked" : "" ?>>日付指定：</label></dt>
			<dd><label><input type="date" id="stage_date_one_day" name="stage_date_one_day" value="<?php echo $stageDateOneDay ?>"></label></dd>
			</dl>
		</p>

		<p><label>
			出演・共演メンバー：<?php echo isset($stageMemberNameList) && count($stageMemberNameList) > 0 ? implode("・", $stageMemberNameList) : "" ?><br>
			<select id="idStageMembers" name="stage_members[]" multiple>
				<option value="0">指定なし</option>
<?php foreach ($memberInfoList as $member) { ?>
				<option value="<?php echo $member->member_id ?>"<?php echo in_array($member->member_id, $stageMemberIds) ? " selected" : "" ?>><?php echo $member->member_name ?></option>
<?php } ?>
			</select>
		</label><br>
		<label>選んだメンバーが：<br>
		<select name="member_cond" _style="width:150px">
			<option value="0"<?php echo isset($memberCond) && $memberCond == 0 ? " selected" : "" ?>>みんな出演する</option>
			<option value="1"<?php echo isset($memberCond) && $memberCond == 1 ? " selected" : "" ?>>1人でも出演する</option>
		</select></label><br>
		出演するメンバーを：<br>
		<button id="member_cond_copy">下にコピー</button>　<button id="member_cond_clear">クリア</button>
		</p>

		<p><label>
			出演しないメンバー：<?php echo isset($stageMemberNameList2) && count($stageMemberNameList2) > 0 ? implode("・", $stageMemberNameList2) : "" ?><br>
			<select id="idStageMembers2" name="stage_members2[]" multiple>
				<option value="0">指定なし</option>
<?php foreach ($memberInfoList as $member2) { ?>
				<option value="<?php echo $member2->member_id ?>"<?php echo in_array($member2->member_id, $stageMemberIds2) ? " selected" : "" ?>><?php echo $member2->member_name ?></option>
<?php } ?>
			</select>
		</label><br>
		<label>選んだメンバーが：<br>
		<select name="member_cond2" _style="width:150px">
			<option value="0"<?php echo isset($memberCond2) && $memberCond2 == 0 ? " selected" : "" ?>>みんな出演しない</option>
			<!--<option value="1"<?php echo isset($memberCond2) && $memberCond2 == 1 ? " selected" : "" ?>>1人でも出演しない</option>-->
		</select></label><br>
		出演しないメンバーを：<br>
		<button id="member_cond2_copy">上にコピー</button>　<button id="member_cond2_clear">クリア</button>
		</p>

		<p><label>
			公演：<?php echo isset($programNameList) && count($programNameList) > 0 ? implode("・", $programNameList) : "" ?><br>
			<select name="stage_programs[]" multiple>
				<option value="0">指定なし</option>
<?php foreach ($programList as $program) { ?>
				<option value="<?php echo $program->program_id ?>"<?php echo in_array($program->program_id, $programIds) ? " selected" : "" ?>><?php echo $program->program_name ?></option>
<?php } ?>
			</select>
		</label><br>
		<label>選択した公演を：<br>
		<select name="stage_cond">
			<option value="0"<?php echo isset($stageCond) && $stageCond == 0 ? " selected" : "" ?>>含む</option>
			<option value="1"<?php echo isset($stageCond) && $stageCond == 1 ? " selected" : "" ?>>含まない</option>
		</select></label></p>

		<p>
			シャッフル公演を含む？<br>
			<label><input type="radio" name="stage_regular_shuffle" value="0" <?php echo isset($stageRegularShuffle) && ($stageRegularShuffle == 0) ? "checked" : "" ?>> すべて</label>　
			<label><input type="radio" name="stage_regular_shuffle" value="1" <?php echo isset($stageRegularShuffle) && ($stageRegularShuffle == 1) ? "checked" : "" ?>> 含まない</label>　
			<label><input type="radio" name="stage_regular_shuffle" value="2" <?php echo isset($stageRegularShuffle) && ($stageRegularShuffle == 2) ? "checked" : "" ?>> シャッフルのみ</label>
		</p>

		<p>
			特別公演を含む？<br>
			<label><input type="radio" name="stage_include_special" value="0" <?php echo isset($inclSpecialStage) && ($inclSpecialStage == 0) ? "checked" : "" ?>> すべて</label>　
			<label><input type="radio" name="stage_include_special" value="1" <?php echo isset($inclSpecialStage) && ($inclSpecialStage == 1) ? "checked" : "" ?>> 含まない</label>　
			<label><input type="radio" name="stage_include_special" value="2" <?php echo isset($inclSpecialStage) && ($inclSpecialStage == 2) ? "checked" : "" ?>> 特別公演のみ</label>
		</p>

		<p>
			<label><input type="checkbox" name="stage_not_double_checked_only" value="1" <?php echo isset($notDoubleCheckedOnly) && $notDoubleCheckedOnly ? "checked" : "" ?>> ダブルチェックが必要な公演のみ</label>
		</p>

		<p><label>
			イベント：<?php echo isset($eventNameList) && count($eventNameList) > 0 ? implode("・", $eventNameList) : "" ?><br>
			<select name="stage_events[]" multiple>
				<option value="0">指定なし</option>
<?php foreach ($eventList as $event) { ?>
				<option value="<?php echo $event->event_id ?>"<?php echo in_array($event->event_id, $eventIds) ? " selected" : "" ?>><?php echo $event->event_name ?></option>
<?php } ?>
			</select>
		</label></p>

		<p>
			<dl>
			<dt>出演回数指定：</label></dt>
			<dd><label><input type="number" name="stage_count" value="<?php echo $stageCount ?>"></label></dd>
			</dl>
		</p>

		<p><label><input type="submit" name="stage_period" value=" 検 索 "></label></p>

		<p>表示公演数：<?php echo count($rows) ?><br>
			<table style="margin-bottom:0;">
				<tr>
					<th>No</th>
					<th>日付</th>
					<th>公演名</th>
					<th>チーム</th>
					<th>　</th>
				</tr>
				<?php $rowCount = 1; ?>
				<?php foreach ($rows as $stage) { ?>
				<tr>
					<td style="text-align:center"><?php echo $rowCount++; ?></td>
					<td><a href="/stage?stage_id=<?php echo $stage->stage_id ?>"><?php echo $stage->stage_date ?> (<?php echo $stage->stage_time ?>)</a></td>
					<td><?php echo $stage->program_name ?></td>
					<td><?php echo $stage->team_name . ($stage->is_shuffled ? "(シ)" : "") ?></td>
					<td><?php echo $stage->CNT ?> 名</td>
				</tr>
				<?php } ?>
			</table>
			(シ)：シャッフル公演
		</p>
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
