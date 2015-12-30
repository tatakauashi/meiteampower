<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48酒井萌衣 生誕メッセージ代筆フォーム</title>
<meta name="viewport" content="width=device-width">
<meta name="keywords" content="酒井萌衣,Mei SAKAI,めいめい,MEI-MEI,SKE48,エス ケー イー フォーティーエイト,チームＥ,Team E,生誕祭,代筆フォーム,Birthday Festival, Birthday card,雨のピアニスト,Pianist in the rain,向日葵,Sunflower,劇場公演,劇場公演の女優,シアターの女優,AKB48,48グループ,48 Group">
<meta name="description" content="SKE48チームE酒井萌衣さんの生誕カード代筆フォームです。握手会会場の生誕スペースに来られない方のために、酒井萌衣さんのお誕生日を祝うメッセージを送信いただき、代わりに生誕カードに代筆して酒井萌衣さんにお届けします。温かいメッセージをお願いいたします。">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
<style>
div#float-box {
	display: <?php echo getPV("meimei_floatbox"); ?>;
}
</style>
</head>
<body class="<?php echo getPV("meimei_lang_class"); ?>">
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><span class="orange nowrap"><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?></span> <span class="yellow"><?php echo getXmlMsg('meimeiTitleForm'); ?></span></h2>
</header><!-- .entry-header -->
	<form name="form1" action="<?php echo get_permalink(); ?>" method="post">
<article class="main">
	<img id="right_top" alt="ribbon" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_113.png">
	<img id="left_bottom" alt="present" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_161.png">
	<div class="formarea">
	<p id="explanation" class="explanation">
		<?php echo getXmlMsg('meimei_leadMessage'); ?>
		<?php if (getPV("meimei_floatbox") == "block") { ?>
		<br><span style="font-size: 100%;" class="english">You can change language with icons on right side.</span>
		<?php } ?>
	</p>
	<p id="aboutRequired" class="explanation">
		<?php echo getXmlMsg('meimei_Required'); ?>
	</p>

		<p><label>
		<?php echo getXmlMsg('meimei_input_meimei_name'); ?> <span class="required">(・ω・)ノ</span><br>
<?php if (getPV("meimei_lang_class") != "en") { ?>
		<span class="english">your name or nickname</span><br>
<?php } ?>
		<input id="txtName" type="text" name="meimei_name" value="<?php echo getPV("meimei_name"); ?>" _required><br>
		<span class="inputError"><?php echo getErrMsg("error_meimei_name"); ?></span>
		</label></p>

		<p><label>
		<?php echo getXmlMsg('meimei_input_messageColor'); ?><br>
<?php if (getPV("meimei_lang_class") != "en") { ?>
		<span class="english">message color</span><br>
<?php } ?>
		<select id="messageColor" name="meimei_messageColor">
			<option value="0" <?php echo getPV('meimei_checked_messageColor_0'); ?>>Please choose...</option>
			<option value="1" <?php echo getPV('meimei_checked_messageColor_1'); ?>>くろ (Black)</option>
			<option value="2" <?php echo getPV('meimei_checked_messageColor_2'); ?>>あか (Red)</option>
			<option value="3" <?php echo getPV('meimei_checked_messageColor_3'); ?>>あお (Blue)</option>
			<option value="4" <?php echo getPV('meimei_checked_messageColor_4'); ?>>きいろ (Yellow)</option>
			<option value="5" <?php echo getPV('meimei_checked_messageColor_5'); ?>>みどり (Green)</option>
			<option value="6" <?php echo getPV('meimei_checked_messageColor_6'); ?>>オレンジ (Orange)</option>
			<option value="7" <?php echo getPV('meimei_checked_messageColor_7'); ?>>むらさき (Purple)</option>
			<option value="8" <?php echo getPV('meimei_checked_messageColor_8'); ?>>ちゃいろ (Brown)</option>
		</select>
		</label></p>

		<p><label>
		<?php echo getXmlMsg('meimei_input_meimei_message'); ?> <span class="required">(・ω・)ノ</span><br>
<?php if (getPV("meimei_lang_class") != "en") { ?>
		<span class="english">message to Mei SAKAI (MEI-MEI)</span><br>
<?php } ?>
		<textarea id="txtareaMessage" name="meimei_message" rows="4" _required><?php echo getPV("meimei_message"); ?></textarea><br>
		<span class="inputError"><?php echo getErrMsg("error_meimei_message"); ?></span>
		</label></p>

		<p><img class="picture" alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/images/mokomoko.jpg"></p>

		<p>
		<input type="submit" id="meimei_submit" value="<?php echo getXmlMsg('meimei_Submit'); ?>">
		<input type="hidden" name="meimei_lang" value="<?php echo getPV("meimei_lang"); ?>">
		<input type="hidden" name="meimei_lang_hidden" value="<?php echo getPV("meimei_lang_hidden"); ?>">
		<input type="hidden" id="meimei_load" name="meimei_load" value="0">
		</p>
	</div>
<footer>
<small>
	Presented by <span id="footerText"><?php echo getXmlMsg('meimei_PresentedBy'); ?></span>
</small>
</footer>
</article>
<div id="float-box">
	<table style="width: 100%; height: 100%;">
		<tr><td><input type="submit" name="meimei_lang_hide" id="lang_hide" value="×"></td></tr>
		<tr><td class="<?php echo getPV("meimei_lang_jp_selected"); ?>"><input type="submit" name="meimei_lang_jp" id="lang_jp" value="　"></td></tr>
		<tr><td class="<?php echo getPV("meimei_lang_en_selected"); ?>"><input type="submit" name="meimei_lang_en" id="lang_en" value="　"></td></tr>
		<tr><td class="<?php echo getPV("meimei_lang_zh_selected"); ?>"><input type="submit" name="meimei_lang_zh" id="lang_zh" value="　"></td></tr>
	</table>
</div>
</form>
<?php wp_footer(); ?>
</body>
</html>
