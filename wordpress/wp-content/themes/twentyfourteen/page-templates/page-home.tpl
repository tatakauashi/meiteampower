<?php namespace MEIMEI; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SKE48酒井萌衣応援サイト めいちむぱわー</title>
<meta name="viewport" content="width=device-width">
<?php include_once('common-meta.tpl'); ?>
<?php wp_head(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/lightbox.js"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/lightbox.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-home.css?<?php echo date('YmdHis'); ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-home.js?<?php echo date('YmdHis'); ?>"></script>
<script>
</script>
</head>
<body><?php /* ?>
<p class="thumbnail"><?php the_post_thumbnail(); ?></p>
<header class="entry-header"><h2 id="headerTitle" class="entry-title"><?php the_title(); ?></h2>
</header><!-- .entry-header --><?php */ ?>
<header class="renewing"><span class="nowrap">SKE48酒井萌衣応援サイト めいちむぱわー</span> 
<span class="nowrap">リニューアル中です！</span></header>
<section class="news-titles">
	<section>
		<a href="http://shop.mu-mo.net/st/special/ske48_1606/" target="_blank"><img class="banner" src="/wp-content/uploads/2016/07/header_42qb.jpg" alt="SKE48 20thシングル「金の愛、銀の愛」劇場盤販売サイト"></a>
<?php if ($sellingStarted) { ?>
		5次販売中！<?php /* ?><span class="red">7/25(月)12:00(正午)</span>まで！<?php */ ?>
<?php } else { ?>
		5次販売が始まります！！
<?php } ?>
		<a href="#kobetsu20th">くわしく！</a>
	</section>
	<section style="background-color: white;">
		<h3>個別生写真発売中！</h3>
		<ul class="photo">
			<li>
				<a href="/wp-content/uploads/2016/07/SK-126-1607-21574_p04_500_.jpg" data-lightbox="popup" data-title="New 7月度 ベースボール"><img src="/wp-content/uploads/2016/07/SK-126-1607-21574_p04_500_.jpg"></a><br>
				<a href="http://shopping.akb48-group.com/products/detail.php?product_id=43772&ske48" target="_blank"><span class="new-post">New</span> 7月度<br>ベースボール</a>
			</li>
			<li>
				<a href="/wp-content/uploads/2016/07/SK-126-1607-20968_p01_500_.jpg" data-lightbox="popup" data-title="7月度 ドームストライプ"><img src="/wp-content/uploads/2016/07/SK-126-1607-20968_p01_500_.jpg"></a><br>
				<a href="http://shopping.akb48-group.com/products/detail.php?product_id=43451&ske48" target="_blank">7月度<br>ドームストライプ</a>
			</li>
			<li>
				<a href="/wp-content/uploads/2016/07/SK-126-1607-20836_p02_500_.jpg" data-lightbox="popup" data-title="6月度 マリンスタイル"><img src="/wp-content/uploads/2016/07/SK-126-1607-20836_p02_500_.jpg"></a><br>
				<a href="http://shopping.akb48-group.com/products/detail.php?product_id=42974&ske48" target="_blank">6月度<br>マリンスタイル</a>
			</li>
		</ul>
	</section>
	<section>
		<h3><span class="nowrap">劇場公演400回！</span></h3>
		7/26(火)のチームE『手をつなぎながら』公演で、 <span class="nowrap">酒井萌衣</span>さんは劇場公演<strong class="blinking pink larger">400回</strong>を迎えました！<br>
		おめでとうございます！！<br>
		公演履歴は<a href="https://docs.google.com/spreadsheets/d/1_LVaQ3tf2JXhd8dYr3qF3bD0aKPc480966-ehnY2XGA/edit?usp=sharing" target="_blank">こちら</a>です。
	</section>
	<section>
		<h3>東海テレビ「まるナツ2016謎解きクイズで美浜海遊祭盛り上げますSP」</h3>
		<dl>
			<dt>7/25(月)　8/1(月)　8/8(月)</dt>
			<dd>放送局／東海テレビ<br>
			放送時間／24:50～</dd>
		</dl>
	</section>
	<section>
		<h3>雑誌</h3>
		<dl>
			<dt>7/28(木)</dt>
			<dd><a href="#bigonegirls34th">BIG ONE GIRLS No.34</a><br>
			<div class="magazine">
				<p>
					酒井萌衣さん、竹内彩姫さん、江籠裕奈さん、日高優月さんと
					「総選挙リベンジ組」として掲載。
				</p>
				<img src="/wp-content/uploads/2016/07/BigOneGirls34thCover.jpg">
			</div>
			</dd>
			<dt>7/29(金)</dt>
			<dd>
			<div class="magazine">
				<img src="/wp-content/uploads/2016/07/IMG_20160726_054953.jpg">
				<p>
					FLASHスペシャル グラビア BEST2016 (<a href="https://www.amazon.co.jp/FLASH%E3%82%B9%E3%83%9A%E3%82%B7%E3%83%A3%E3%83%AB-%E3%82%B0%E3%83%A9%E3%83%93%E3%82%A2BEST2016%E7%9B%9B%E5%A4%8F%E5%8F%B7-FLASH%E5%A2%97%E5%88%8A-%E5%85%89%E6%96%87%E7%A4%BE%E3%82%A8%E3%83%B3%E3%82%BF%E3%83%86%E3%82%A4%E3%83%B3%E3%83%A1%E3%83%B3%E3%83%88%E7%B7%A8%E9%9B%86%E9%83%A8/dp/B01G7I3XFW" target="_blank">アマゾン</a>)
				</p>
			</div>
			</dd>
			<dt>8/3(水)</dt>
			<dd><span class="pink blinking">水着サプライズ</span> (<a href="https://www.amazon.co.jp/AKB48%E7%B7%8F%E9%81%B8%E6%8C%99-%E6%B0%B4%E7%9D%80%E3%82%B5%E3%83%97%E3%83%A9%E3%82%A4%E3%82%BA%E7%99%BA%E8%A1%A82016-%E9%9B%86%E8%8B%B1%E7%A4%BE%E3%83%A0%E3%83%83%E3%82%AF-%E9%80%B1%E5%88%8A%E3%83%97%E3%83%AC%E3%82%A4%E3%83%9C%E3%83%BC%E3%82%A4%E7%B7%A8%E9%9B%86%E9%83%A8/dp/4081022194" target="_blank">アマゾン</a>)</dd>
		</dl>
	</section>
	<section>
		<h3>カップリング２曲のMVが公開</h3>
		<dl>
		<dt>ハッピーランキング</dt>
		<dd>総選挙ランクインメンバー20人が歌います。<br>
			8/17発売20th.Single「金の愛、銀の愛」のTYPE-Aに収録されます。<br>
			<div style="text-align:center; margin-bottom: 0.5em;">
				<a href="/wp-content/uploads/2016/07/CoQY5AXUMAAt8Jc_cut.jpg" data-lightbox="popup" data-title="ハッピーランキング"><img src="/wp-content/uploads/2016/07/CoQY5AXUMAAt8Jc_cut.jpg" style="max-width: 80%;"></a><br>
				<a href="http://www.youtube.com/watch?v=MIIQormZF6A" target="_blank">ハッピーランキング(YouTube)</a>
			</div>
		</dd>
		<dt>サヨナラが美しくて</dt>
		<dd>４期生が歌う、 <span class="nowrap">柴田阿弥さん</span>の卒業ソングです。<br>
			8/17発売20th.Single「金の愛、銀の愛」のTYPE-Cに収録されます。<br>
			<div style="text-align:center;">
				<a href="/wp-content/uploads/2016/07/IMG_8300.jpg" data-lightbox="popup" data-title="サヨナラが美しくて"><img src="/wp-content/uploads/2016/07/IMG_8300.jpg" style="max-width: 80%;"></a><br>
				<a href="http://www.youtube.com/watch?v=vyd3EVKUM_M" target="_blank">サヨナラが美しくて(YouTube)</a>
			</div>
		</dd>
		</dl>
	</section>
</section>
<section class="detail">
<article id="kobetsu20th">
<section>
<div style="text-align: center;"><img style="max-width: 100%;" src="/wp-content/uploads/2016/08/20160808_KinGin5ji.jpg" alt="SKE48 20th Single 個別握手会『金の愛、銀の愛』"></div>
<section class="content">
<div>
<h3><span class="nowrap">SKE48『金の愛、銀の愛』</span>
<span class="nowrap">個別握手会</span></h3>
お申込みはこちらから！<br>
<a href="http://shop.mu-mo.net/st/special/ske48_1606/" target="_blank"><img class="banner" src="/wp-content/uploads/2016/07/header_42qb.jpg" alt="SKE48 20thシングル「金の愛、銀の愛」劇場盤販売サイト"></a>
</div>
<?php if ($sellingStarted) { ?>
<p>5次先着販売中です！</p>
<?php } else { ?>
<h4>5次先着販売がまもなく8月8日(月)19:00～スタートです！！</h4>
<?php } ?>
<dl>
<dt>会場ごとに販売期間が異なりますのでご注意ください。</dt>
<dt>9月4日(日)パシフィコ横浜分</dt>
<dd>販売期間: 8月8日(月)19:00～8月26日(金)12:00(正午)</dd>
<dt>9月10日(土)ポートメッセなごや、9月11日(日)ポートメッセなごや分</dt>
<dd>販売期間: 8月8日(月)19:00～9月1日(木)12:00(正午)</dd>
<dt>9月22日(木・祝)さいたまスーパーアリーナ コミュニティアリーナ、
9月24日(土)インテックス大阪、9月25日(日)インテックス大阪分</dt>
<dd>販売期間: 8月8日(月)19:00～9月12日(月)12:00(正午)</dd>
<dt>11月23日(水・祝)ポートメッセなごや分</dt>
<dd>販売期間: 8月8日(月)19:00～11月14日(月)12:00(正午)</dd>
</dl>
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
<dd>B5部	16:10～17:10（16:50レーン締め切り）</dd>
</dl>
</section>
</section>
</article>
<article id="bigonegirls34th">
<section>
<section class="content">
<h3><span class="nowrap">BIG ONE GIRLS No.34</h3>
<blockquote class="twitter-tweet" data-lang="ja"><p lang="ja" dir="ltr">【BOG告知】<br>『BIG ONE GIRLS No.34』は10日間後の7月28日発売。<br><br>表紙＆巻頭は、SKE48（北川綾巴ちゃん、江籠裕奈ちゃん、高柳明音ちゃん、古畑奈和ちゃん、熊崎晴香ちゃん、須田亜香里ちゃん）です！！ <a href="https://t.co/Q4b0qHGmjN">pic.twitter.com/Q4b0qHGmjN</a></p>&mdash; BIG ONE GIRLS編集部 (@BIGONEGIRLS) <a href="https://twitter.com/BIGONEGIRLS/status/755031527201779712">2016年7月18日</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</section>
</section>
</article>
</section>
<footer>
<small>
<span class="nowrap">SKE48酒井萌衣応援サイト めいちむぱわー</span> 
<span class="nowrap">リニューアル中です！</span>
</small>
</footer>
<?php wp_footer(); ?>
</body>
</html>
