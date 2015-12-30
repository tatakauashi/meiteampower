<?php
/*
Template Name: message-list
*/
?>
<?php
namespace MEIMEI;
	session_start();

include_once('inc/meimei_libs.php');

	// ログインの確認
	if (!is_user_logged_in()) {
		//header("Location: /message");
		include("404.php");
		exit;
	}

	global $wpdb;
//	$sql = "SELECT name, message FROM meimei_message where message_id=%d";
	$sql = "SELECT m.message_id, m.name, p.color_name, l.lang_name, m.message FROM meimei_message m "
			. " JOIN Color_Palette p ON (m.pen_color = p.color_id) "
			. " JOIN Language l ON (m.view_language = l.lang_id) "
			. " WHERE NOT EXISTS (SELECT 'x' FROM Check_Message cm WHERE cm.message_id = m.message_id) ";
//	$sql = $wpdb->prepare($sql, $_SESSION["insert_id"]);
	$rows = $wpdb->get_results($sql);
	$meimei_name = '';
	if ($rows) {
		$meimei_name = "<br>" . $rows[0]->name;
	}

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
<div>
<?php if ($rows) { ?>
            <table style="max-width:90%">
<?php     foreach ($rows as $row) { ?>
               <tr>
                   <td><?php echo $row->message_id ?></td>
                   <td>名前</td><td><?php echo escapeHtml($row->name) ?></td>
                   <td>ペンの色</td><td><?php echo $row->color_name ?></td>
                   <td><?php echo $row->lang_name ?></td>
               </tr>
               <tr><td colspan="6"><textarea style="height:200px;" readonly><?php echo escapeHtml($row->message) ?></textarea><td>
               </tr>
<?php     } ?>
            </table>
<?php } else { ?>
          メッセージはありません。
<?php } ?>
</div>
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
