<?php
/*
Template Name: TopPage
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
<style rel="stylesheet">span.age-before:before { content: "<?php echo floor((date('Ymd') - 19971213) / 10000); ?>"; }</style>
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
<?php
	$script_file_path = str_replace('\\', '/', __FILE__);
	$script_file_name = substr($script_file_path, strrpos($script_file_path, '/') + 1);
	$permalink = get_permalink();
	$page_name = substr($permalink, strrpos($permalink, '/') + 1);
	$script_file_dir = str_replace('/' . $script_file_name, '', $script_file_path);
	if (file_exists($script_file_dir . '/css/page-' . $page_name . '.css')) {
?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-<?php echo $page_name; ?>.css">
<?php
	}
	if (file_exists($script_file_dir . '/js/page-' . $page_name . '.js')) {
?>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-<?php echo $page_name; ?>.js"></script>
<?php
	}
?>
		<div id="content" class="site-content" role="main">

			<?php

	// カスタマイズ・スタート
	global $post;
	$oldpost = $post;

	// 必ず１つは表示したい記事
	$disp_perform = false;  // 公演は１つだけ
	$disp_announce = false;
	$disp_poster = false;

	// ピン止めされた投稿の最新１件を取得する
	$myposts = get_posts('tag=pinned&numberposts=1&order=DESC&orderby=post_date');
	foreach($myposts as $post) :
		setup_postdata($post);
		// 普通に表示
		get_template_part( 'content', get_post_format() );
	endforeach;

	// 何件かさかのぼってみる
	$myposts = get_posts('numberposts=6&order=DESC&orderby=post_date');
	$post_count = 0;
	foreach($myposts as $post) :
		setup_postdata($post);
		
		// pinnedは１件のみ冒頭に表示する。その他にpinnedがあってもスキップする。
		if (hasTagSlug('pinned')) :
			continue;
		endif;
		
		$cat = get_the_category();
		$cat = $cat[0]->category_nicename;
		if ($cat == 'perform') :
			if ($disp_perform === false) :
				// 普通に表示
				get_template_part( 'content', get_post_format() );
				$disp_perform = true;
			endif;

		// アナウンスを表示したか
		elseif ($cat == 'ann') :
			// 普通に表示
			get_template_part( 'content', get_post_format() );
			$disp_announce = true;

		// ポスターを表示したか
		elseif ($cat == 'poster') :
			// ポスター専用テンプレートで表示
			get_template_part( 'content', 'poster' );
			$disp_poster = true;

		else :
			// その他、普通に表示
			get_template_part( 'content', get_post_format() );

		endif;
		
		// pinnedを除いても最低3件は表示する。
		$post_count = $post_count + 1;
		if ($post_count >= 3) :
			break;
		endif;
	endforeach;

	// 上で公演を表示していなかった場合、最新の１件を表示する
	if ($disp_perform === false) :
		$myposts = get_posts('category_name=perform&numberposts=1&order=DESC&orderby=post_date');
		$post = $myposts[0];
		setup_postdata($post);
		get_template_part( 'content', get_post_format() );
	endif;

	// 上でアナウンスを表示していなかった場合、最新の１件を表示する
	if ($disp_announce === false) :
		$myposts = get_posts('category_name=ann&numberposts=1&order=DESC&orderby=post_date');
		$post = $myposts[0];
		setup_postdata($post);
		get_template_part( 'content', get_post_format() );
	endif;
	
	// 上で応援ポスターを表示していなかった場合、最新の１件を表示する
	if ($disp_poster === false) :
		$myposts = get_posts('category_name=poster&numberposts=1&order=DESC&orderby=post_date');
		$post = $myposts[0];
		setup_postdata($post);
		get_template_part( 'content', 'poster' );
	endif;

	$post = $oldpost;
	// カスタマイズ・ここまで

				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->
<?php echo do_shortcode('[debug_filename]' . 'page-top.php' . '[/debug_filename]'); ?>
<?php
get_sidebar();
get_footer();
