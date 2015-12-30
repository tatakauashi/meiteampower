<?php
/*
Template Name: TopPageTest
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
		<div id="content" class="site-content home" role="main">

			<?php
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
<?php echo do_shortcode('[debug_filename]' . 'page-toptest.php' . '[/debug_filename]'); ?>
<?php
get_sidebar();
get_footer();
