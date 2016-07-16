<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48酒井萌衣応援サイト めいちむぱわー</title>
<meta name="viewport" content="width=device-width">
<?php include_once('common-meta.tpl'); ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-home.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-home.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body><?php /* ?>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header --><?php */ ?>
<article id="kobetsu20th">
<section class="detail">
<div style="text-align: center;"><img style="max-width: 100%;" src="http://sakaimei-senkyo.net/wp-content/uploads/2016/07/CnJiXfkUMAAhy24.jpg" alt="SKE48 20th Single 個別握手会『金の愛、銀の愛』"></div>
<section>
<div>
<h3><span class="nowrap">SKE48『金の愛、銀の愛』</span>
<span class="nowrap">個別握手会</span></h3>
お申込みはこちらから！<br>
<a href="http://shop.mu-mo.net/st/special/ske48_1606/" target="_blank"><img class="banner" src="http://sakaimei-senkyo.net/wp-content/uploads/2016/07/header_x9yp.jpg" alt="SKE48 20thシングル「金の愛、銀の愛」劇場盤販売サイト"></a>
</div>
<?php if ($sellingFinished) { ?>
<p>3次抽選まで終了しました。<br>4次以降の抽選の情報が入り次第、お知らせいたします。</p>
<?php } else { ?>
<h2>まもなく締め切りです！！</h2>
<dl>
<dt>★3次抽選:7/14(木)15:00～<span class="blinking red">7/15(金)12:00(正午)</span></dt>
<dd>結果通知:7/15(金)13:00～順次メールにて</dd>
</dl>
<?php } ?>
<dl lining="8em">
<dt>握手会の日程はこちら</dt>
<dd>9/4(<span class="sun">日</span>)	パシフィコ横浜<span class="blinking pink normal">&hearts;</span></dd>
<dd>9/10(<span class="sat">土</span>)	ポートメッセなごや</dd>
<dd>9/11(<span class="sun">日</span>)	ポートメッセなごや<span class="blinking pink normal">&hearts;</span></dd>
<dd>9/22(<span class="bold">木・</span><span class="sun">祝</span>)	さいたまスーパーアリーナ</dd>
<dd>9/24(<span class="sat">土</span>)	インテックス大阪</dd>
<dd>9/25(<span class="sun">日</span>)	インテックス大阪</dd>
<dd>11/23(<span class="bold">水・</span><span class="sun">祝</span>)	ポートメッセなごや</dd>
</dl>

<dl lining="4em">
<dt>酒井萌衣さんの時間</dt>
<dd>昼の部	14:00～15:10（14:50レーン締め切り）</dd>
<dd>B5部	16:00～17:10（16:50レーン締め切り）</dd>
</dl>
</section>
</section>
</article>
<footer>
<small>
<span class="nowrap">SKE48酒井萌衣応援サイト めいちむぱわー</span> 
<span class="nowrap">リニューアル中です！</span>
</small>
</footer>
<?php wp_footer(); ?>
</body>
</html>
