<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
/**
 * 文字コードはUTF-8で保存する。
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$query_args = array(
			'family' => urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

//指定記事数の記事リストを表示（Homeで使用）
function getCatItems($atts, $content = null) {
	extract(shortcode_atts(array(
		"num" => '5'
	), $atts));
	global $post;
	$oldpost = $post;
	$myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date');
	$retHtml='<section class="shortcode-recent-posts">';
	$retHtml.='<div class="title">新着記事</div>';
	$retHtml.='<div class="content">';
	$retHtml.='<dl>';
	foreach($myposts as $post) :
		setup_postdata($post);
		$new_post = '';
		if (time() - get_post_time() < 60 * 60 * 24) {
			$new_post = '<span class="new-post">New</span>';
		} else {
			$new_post = '';
		}
		$retHtml.='<dt>'.get_post_time('Y/m/d').$new_post.'</dt>';
		$retHtml.='<dd><span class="cat-links">'.get_the_category_list( ' ' ).'</span><br><a href="'.get_permalink().'">'.the_title("","",false).'</a></dd>';
	endforeach;
	$retHtml.='</dl>';
	$retHtml.='</div>';
	$retHtml.='</section>';
	$post = $oldpost;
	return $retHtml;
}
add_shortcode("recent", "getCatItems");

// 現在のPHPスクリプトファイル名をデバッグ表示する
function debugScriptFileName($atts, $content = null) {
	if (is_user_logged_in()) {
		return '<!-- script filename: ' . $content . ' -->' . "\n";
	}
	return '';
}
add_shortcode("debug_filename", "debugScriptFileName");

// 公演リストを表示する
function getPerformList($atts, $content = null) {
	if ( ! is_front_page() ) {
		return '';
	}
	extract(shortcode_atts(array(
		"num" => '3'
	), $atts));
	if ($content == null) {
		$content = '公演の詳細はこちら！';
	}
	$retHtml  = '<dl class="perform-list">' . "\n";
	$retHtml .= '<dt>' . $content . '</dt>' . "\n";
	global $post;
	$oldpost = $post;
	$myposts = get_posts('category_name=perform&numberposts=' . $num . '&order=DESC&orderby=post_date');
	foreach($myposts as $post) :
		setup_postdata($post);
		$retHtml .= '<dd><a href="' . get_permalink() . '">' . the_title("","",false) . '</a></dd>' . "\n";
	endforeach;
	$retHtml.='</dl>' . "\n";
	$post = $oldpost;
	return $retHtml;
}
add_shortcode("perform_list", "getPerformList");

// 最後のcaptionで<!--を出力した際、ここで-->を出力してスキップ動作を終了する
function closeCaptionSkip( $attr, $content = null ) {
	global $caption_skip;
	if ($caption_skip === true) {
		$caption_skip = false;
		return '-->';
	}
	return '';
}
add_shortcode("close_caption_skip", "closeCaptionSkip");

// function category_display_one_articles( $wp_query ) {
//     if (!is_admin()) { //管理画面以外で
//         if ( $wp_query->is_main_query() && $wp_query->is_category('17') ) { // メインのクエリーでカテゴリーIDが17(perform)の時
//             $wp_query->set( 'posts_per_page', 1 ); // 表示件数は1件
//         }
        
//         // 選対のみ
//         if (!is_user_logged_in()) {
// //         	if (is_single() && hasTagSlug('sentaionly')) {
// //         		$wp_query->set_404();
// //         	}
        	
//         	// タグ直接指定対応。「みつかりません」ではなく 404 を表示するため。
//         	if ($wp_query->query_vars['tag'] == 'sentaionly') {
//         		$wp_query->query_vars['tag'] = 'safjklsadjfklsjafks';
//         		$wp_query->query_vars['tag_slug__in'] = array( 'safjklsadjfklsjafks' );
//         	}

//         	// 選対のみの記事を検索結果から除外する対応
//         	$wp_query->set( 'tag__not_in', array( 20, 21 ) );
//         }
//     }
// }
// add_action( 'pre_get_posts', 'category_display_one_articles' );

function for_single_article( $wp_query )
{
    if (!is_admin())
    {
    	if (is_single() && !is_user_logged_in() && hasAnySlug($wp_query, array( 'sentaionly' ) ) )
    	{
    		$wp_query->set_404();
    	}
    }
    
}
add_action( 'parse_query', 'for_single_article' );

// [caption]ショートコードのオーバーライド。
function img_caption_shortcode_custom( $attr, $content = null ) {
	global $caption_skip;
//	if ( isset( $attr['skip_home'] ) && is_front_page() ) {
	if ( isset( $attr['skip_home'] ) && ( is_front_page() || ( ! is_category('perform') && ( ! is_single() ) ) ) ) {
		$caption_skip = true;
		return '<!--';
	}
	$close_comment = '';
	if ($caption_skip === true) {
		$caption_skip = false;
		$close_comment = '-->';
	}
	return $close_comment . img_caption_shortcode($attr, $content);
}
add_shortcode('caption', 'img_caption_shortcode_custom');

// すでにロードされている記事に対して、その記事に指定したタグスラッグが紐づいているか調べる。
function hasTagSlug($tagSlug)
{
	$posttags = get_the_tags();
	$result = false;
	if ($posttags) : foreach($posttags as $tag) :
		if ($tag->slug == $tagSlug) :
			$result = true;
			break;
		endif;
	endforeach; endif;
	return $result;
}

// 記事IDを指定して、その記事に引数のカテゴリ・タグのスラッグが１件でも紐づいているか調べる。
function hasAnySlug($wp_query, $slugs)
{
	if (!isset($wp_query->query['p']) || $wp_query->query['p'] <= 0 || $slugs == null || count($slugs) <= 0) {
		return false;
	}
	$post_id = $wp_query->query['p'];

	global $wpdb;
	$query = 
		  " SELECT 'x' "
		. " FROM wp_term_relationships rel "
		. " JOIN wp_term_taxonomy tx ON (tx.term_taxonomy_id = rel.term_taxonomy_id) "
		. " JOIN wp_terms tm ON (tm.term_id = tx.term_id) "
		. " WHERE rel.object_id = %d AND tm.slug IN ( 'NOT_EXITS' ";
	$param = array();
	$param[] = $post_id;
	if ($slugs) : foreach($slugs as $slug) :
		$query .= ",%s";
		$param[] = $slug;
	endforeach; endif;
	$query .= ") ";
	$query = $wpdb->prepare($query, $param);
	$result = $wpdb->get_results($query);
	if ($result != null && count($result) > 0)
	{
		return true;
	}
	return false;
}

function my_login_redirect($url, $request, $user)
{
	if ($user && is_object($user) && is_a($user, 'WP_User')) {
		if ($user->has_cap('administrator')) {
			$url = admin_url();
		} else {
			$url = home_url('/stage/stagelist');
		}
	}
	return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);

// function add_realestate_type() {
// 	$args = array(
// 		'label' => 'めいちむ選挙対策ボード',
// 		'labels' => array(
// 			'singular_name' => 'めいちむ選挙対策ボード',
// 			'add_new_item' => '投稿する',
// 			'add_new' => '投稿する',
// 			'new_item' => '新規投稿',
// 			'edit_item' => '投稿を編集',
// 			'view_item' => '投稿を表示',
// 			'not_found' => '投稿は見つかりませんでした',
// 			'not_found_in_trash' => 'ゴミ箱に投稿はありません。',
// 			'search_items' => '投稿を検索',
// 		),
// 		'public' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 		'capability_type' => 'post',
// 		'hierarchical' => true,
// 		'menu_position' => 5,
// 		'supports' => array('title','editor','author','thumbnail',
// 			'excerpt','comments','custom-fields')
// 	);
// 	register_post_type('MeiteamBoard', $args);
// }
// add_realestate_type();
add_action( 'init', 'register_cpt_senkyoboard' );

function register_cpt_senkyoboard() {

	$labels = array(
					'name' => __( 'めいちむ選対ボード', 'senkyoboard' ),
					'singular_name' => __( 'めいちむ選対ボード', 'senkyoboard' ),
					'add_new' => __( '新規投稿', 'senkyoboard' ),
					'add_new_item' => __( '新しく投稿します', 'senkyoboard' ),
					'edit_item' => __( '投稿を編集', 'senkyoboard' ),
					'new_item' => __( '新しい投稿', 'senkyoboard' ),
					'view_item' => __( 'ボードを見る', 'senkyoboard' ),
					'search_items' => __( 'ボードを検索', 'senkyoboard' ),
					'not_found' => __( '投稿が見つかりません', 'senkyoboard' ),
					'not_found_in_trash' => __( 'ゴミ箱に投稿はありません', 'senkyoboard' ),
					'parent_item_colon' => __( '親の投稿', 'senkyoboard' ),
					'menu_name' => __( '選対ボード', 'senkyoboard' ),
	);

	$args = array(
					'labels' => $labels,
					'hierarchical' => false,
					'description' => '酒井萌衣さんの選挙対策チーム内部の情報共有・相談のボードです。選対メンバーのみ閲覧・投稿ができます。',
					'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions' ),
					'taxonomies' => array( 'category', 'post_tag' ),
					'public' => false,
					'show_ui' => true,//false,
					'menu_position' => 5,
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => true,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => true,
					'capability_type' => 'post'
	);

	register_post_type( 'senkyoboard', $args );

	
	
	
	$labels = array(
					'name' => __( 'plural', 'posttypekey' ),
					'singular_name' => __( 'singular', 'posttypekey' ),
					'add_new' => __( 'Add New Labelだよ', 'posttypekey' ),
					'add_new_item' => __( 'Add New Item Labelだよ', 'posttypekey' ),
					'edit_item' => __( 'Edit Item Labelだよ', 'posttypekey' ),
					'new_item' => __( 'New Item Labelだよ', 'posttypekey' ),
					'view_item' => __( 'View Item Labelだよ', 'posttypekey' ),
					'search_items' => __( 'Search Items Labelだよ', 'posttypekey' ),
					'not_found' => __( 'Not Found Labelだよ', 'posttypekey' ),
					'not_found_in_trash' => __( 'Not Found In Trash Labelだよ', 'posttypekey' ),
					'parent_item_colon' => __( 'Parent Text Labelだよ', 'posttypekey' ),
					'menu_name' => __( 'Menu Textだよ', 'posttypekey' ),
	);
	
	$args = array(
					'labels' => $labels,
					'hierarchical' => false,
					'description' => 'DescriptionDescriptionDescriptionDescriptionDescription',
					'supports' => array( 'editor', 'author', 'thumbnail', 'comments', 'revisions' ),
					'taxonomies' => array( 'category', 'post_tag' ),
					'public' => false,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 10,
					'show_in_nav_menus' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => true,
					'has_archive' => true,
					'query_var' => true,
					'can_export' => true,
					'rewrite' => true,
					'capability_type' => 'post'
	);
	
	register_post_type( 'posttypekey', $args );
}

// // サムネイルの登録を可能にする。
// add_theme_support( 'post-thumbnails', array( 'senkyoboard' ) );
// set_post_thumbnail_size( 150, 150, true );
