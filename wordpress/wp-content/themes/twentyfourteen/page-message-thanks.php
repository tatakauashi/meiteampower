<?php
/*
Template Name: message-thanks
*/
?>
<?php
namespace MEIMEI;
	session_start();

include('inc/meimei_libs.php');

/*	global $wpdb;
	$sql = "SELECT name, message FROM meimei_message where message_id=%d";
	$sql = $wpdb->prepare($sql, $_SESSION["insert_id"]);
	$rows = $wpdb->get_results($sql);
	$meimei_name = '';
	if ($rows) {
		$meimei_name = "<br>" . $rows[0]->name;
	}*/
	
	$lang = 'ja';
	if (isset($_GET['meimei_l'])) {
		$lng = $_GET['meimei_l'];
		if ($lng == '1') {
			$lang = 'en';
		} else if ($lng == '2') {
			$lang = 'zh';
		}
	}
	// メッセージ読み込み
	loadXML($lang);
	setPV("meimei_lang_class", $lang);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48酒井萌衣 生誕メッセージ代筆フォーム</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body class="<?php echo getPV("meimei_lang_class"); ?>">
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><span class="orange nowrap"><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?></span> <span class="yellow nowrap"><?php echo getXmlMsg('meimeiTitleForm'); ?></span></h2>
</header><!-- .entry-header -->
<article class="main">
	<img id="right_top" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_113.png">
	<img id="left_bottom" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_161.png">
	<p id="explanation" class="explanation">
<?php echo getXmlMsg('meimei_thanksMessage'); ?>
<p style="text-align: center; margin-top: 1.5em;">
<a href="http://spn.ske48.co.jp/profile/index.php?id=sakai_mei">SKE48 Mei SAKAI Official Profile | SKE48 Mobile</a>
</p>
	</p>

	<p><img class="picture" src="<?php echo get_stylesheet_directory_uri(); ?>/images/mokomoko.jpg"></p>
<footer>
<small>
	Presented by <span id="footerText"><?php echo getXmlMsg('meimei_PresentedBy'); ?></span>
</small>
</footer>
</article>
<?php wp_footer(); ?>
</body>
</html>
