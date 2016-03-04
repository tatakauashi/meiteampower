<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
namespace MEIMEI;

// 404を返す。
if (!headers_sent()) {
//	http_response_code(404);
	header("HTTP/1.1 404 Not Found");
}

include_once('inc/meimei_libs.php');
loadXML("ja");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48酒井萌衣応援サイト めいちむぱわー</title>
<meta name="viewport" content="width=device-width">
<meta name="robots" content="noindex">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-message.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-message.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body class="ja"><?php /*
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>*/ ?>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><span class="orange nowrap">SKE48酒井萌衣応援サイト</span> <span class="yellow nowrap">めいちむぱわー</span></h2>
</header><!-- .entry-header -->
<article class="main">
	<img id="right_top" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_113.png">
	<img id="left_bottom" src="<?php echo get_stylesheet_directory_uri(); ?>/images/free/e_present_161.png">
<div class="formarea">
	<p>
ページが見つかりませんでした。<br>
URLをご確認いただくか、こちらよりどうぞ。
<dl style="margin-left: 8px;">
<dd>めいちむぱわーは <a href="/" class="nowrap">こちら</a></dd>
<dd>酒井萌衣オフィシャルプロフィールは <a href="http://spn.ske48.co.jp/profile/index.php?id=sakai_mei" class="nowrap">こちら</a></dd>
</dl>
	</p>
	<p>
Requested page is not found.<br>
Check your request or choose the links.
<dl style="margin-left: 8px;">
<dd>Mei SAKAI&apos;s supporting site &apos;Meiteam Power&apos; is <a href="/" class="nowrap">here.</a></dd>
<dd>Official profile is <a href="http://spn.ske48.co.jp/profile/index.php?id=sakai_mei" class="nowrap">here.</a></dd>
</dl>
	</p>
</div>

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
