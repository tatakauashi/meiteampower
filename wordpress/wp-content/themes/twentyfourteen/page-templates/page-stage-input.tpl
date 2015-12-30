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
<body>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
	<div class="formarea">
		<div style="float:left; width:40%"><label>
			日付：<br>
			<input type="date" name="stage_date">
		</label></div>
		<div style="float:left; width:40%; margin-left: 1em;"><label>
			何回目：<br>
			<select name="stage_time[]" multiple>
				<option value="1" selected>１回目</option>
				<option value="2">２回目</option>
				<option value="3">３回目</option>
				<option value="4">４回目</option>
				<option value="5">５回目</option>
			</select>
		</label></div>
		<p style="clear:both;">
		<p><label>
			チーム：<br>
			<select name="stage_team">
				<option value="1">チームＳ</option>
				<option value="2">チームＫⅡ</option>
				<option value="3" selected>チームＥ</option>
				<option value="4">チーム研究生</option>
			</select>
		</label>
		<label style="margin-left:1em">シャッフル？<input type="checkbox" name="stage_shuffle"></label>
		</p>
		<p>
		<label>公演名：<br>
			<select name="stage_program">
				<option value="1">PARTYが始まるよ</option>
				<option value="2" selected>手をつなぎながら</option>
				<option value="3">会いたかった</option>
				<option value="4">制服の芽</option>
				<option value="5">パジャマドライブ</option>
				<option value="6">ラムネの飲み方</option>
				<option value="7">逆上がり</option>
				<option value="8">RESET</option>
				<option value="9">シアターの女神</option>
				<option value="10">僕の太陽</option>
			</select>
		</label>
		</p>

		<p><label>出演メンバー：<br>
		<textarea name="stage_members" rows="4" required></textarea>
		</label></p>
		
		<p><label>関連リンク：<br>
		<textarea name="stage_links" rows="2"></textarea>
		</label></p>
		
		<p><label>
			<input type="submit" name="stage_register" value=" 登 録 " style="width:70%; display:block; margin:auto;">
		</label></p>
		
		<p><label>
			<a href="/stage/list">リストへ</a>
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
