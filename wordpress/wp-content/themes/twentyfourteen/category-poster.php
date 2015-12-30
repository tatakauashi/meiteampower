<?php get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area-top">
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/photolist.css">
		<div id="content" class="site-content" role="main">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();
		?>

		<div class="one-title">
			<div class="entry-thumbnail">
				<?php /*<a href="<?php the_permalink(); ?>">*/ ?>
				<a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, 'full', true); echo $image_url[0]; ?>" data-lightbox="poster" data-title="<?php echo get_the_title(); ?>" _class="popupimg">
					<img src="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, '', true); echo $image_url[0]; ?>" width="100%" />
				</a>
				<?php the_title( '<p><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' ); ?>
			</div>

			<div class="entry-meta">
				<?php
					printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span>',
						esc_url( get_permalink() ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() )
					);
				?>
			</div>

			<?php /*span class="readmore"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/readmore.svg" alt="read more" /></a></span*/ ?>
		</div>

		<?php 
			endwhile;
		?>

		<br clear="all" />
		<?php 
			// Previous/next post navigation.
			twentyfourteen_paging_nav();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();