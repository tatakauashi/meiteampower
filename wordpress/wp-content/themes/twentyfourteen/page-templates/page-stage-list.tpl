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
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
	<div class="formarea">
		<p><label>
			期間：<br>
			<input type="date" name="stage_date_from" value="<?php echo $stageDateFrom ?>"></label>～
			<label><input type="date" name="stage_date_to" value="<?php echo $stageDateTo ?>">　
			<input type="submit" name="stage_period" value=" 期間指定 ">
		</label></p>

		<p>
			<table>
				<tr>
					<th>日付</th>
					<th>公演名</th>
					<th>チーム</th>
					<th>　</th>
				</tr>
				<?php foreach ($rows as $stage) { ?>
				<tr>
					<td><a href="/stagedetail?stage_id=<?php echo $stage->stage_id ?>"><?php echo $stage->stage_date ?> (<?php echo $stage->stage_time ?>)</a></td>
					<td><?php echo $stage->program_name ?></td>
					<td><?php echo $stage->team_name . ($stage->is_shuffled ? "（シャッフル）" : "") ?>
					<td><?php echo $stage->CNT ?> 名</td>
				</tr>
				<?php } ?>
			</table>
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
