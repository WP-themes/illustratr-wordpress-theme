<?php
/**
 * Illustratr functions and definitions
 *
 * @package Illustratr
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 840; /* pixels */
}

/**
 * Adjust the content width for image post format and single portfolio.
 */
function illustratr_set_content_width() {
	global $content_width;

	if ( 'image' == get_post_format() || ( is_singular() && 'jetpack-portfolio' == get_post_type() ) ) {
		$content_width = 1100;
	}
}
add_action( 'template_redirect', 'illustratr_set_content_width' );

if ( ! function_exists( 'illustratr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function illustratr_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Illustratr, use a find and replace
	 * to change 'illustratr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'illustratr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Editor styles.
	 */
	add_editor_style( 'editor-style.css' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 400, 300, true );
	add_image_size( 'illustratr-featured-image', 1100, 500, true );
	add_image_size( 'illustratr-portfolio-featured-image', 800, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'illustratr' ),
		'social'  => __( 'Social Menu', 'illustratr' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'illustratr_custom_background_args', array(
		'default-color' => '24282d',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	// Remove default gallery style
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // illustratr_setup
add_action( 'after_setup_theme', 'illustratr_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function illustratr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'illustratr' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'illustratr_widgets_init' );

/**
 * Register Google fonts.
 */
function illustratr_fonts() {
	/* translators: If there are characters in your language that are not supported
	   by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'illustratr' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Source Sans Pro character subset specific to your language, translate this to 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Source Sans Pro font: add new subset (vietnamese)', 'illustratr' );

		if ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Source+Sans+Pro:400,700,900,400italic,700italic,900italic',
			'subset' => $subsets,
		);
		wp_register_style( 'illustratr-source-sans-pro', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );

	}

	/* translators: If there are characters in your language that are not supported
	   by PT Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'PT Serif font: on or off', 'illustratr' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional PT Serif character subset specific to your language, translate this to 'cyrillic'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'PT Serif font: add new subset (cyrillic)', 'illustratr' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic-ext,cyrillic';
		}

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'PT+Serif:400,700,400italic,700italic',
			'subset' => $subsets,
		);
		wp_register_style( 'illustratr-pt-serif', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );

	}

	/* translators: If there are characters in your language that are not supported
	   by Source Code Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Source Code Pro font: on or off', 'illustratr' ) ) {

		$protocol = is_ssl() ? 'https' : 'http';

		wp_register_style( 'illustratr-source-code-pro', "$protocol://fonts.googleapis.com/css?family=Source+Code+Pro", array(), null );

	}
}
add_action( 'init', 'illustratr_fonts' );

/**
 * Enqueue scripts and styles.
 */
function illustratr_scripts() {
	wp_enqueue_style( 'illustratr-source-sans-pro' );

	wp_enqueue_style( 'illustratr-pt-serif' );

	wp_enqueue_style( 'illustratr-source-code-pro' );

	if ( wp_style_is( 'genericons', 'registered' ) ) {
		wp_enqueue_style( 'genericons' );
	} else {
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
	}

	wp_enqueue_style( 'illustratr-style', get_stylesheet_uri() );

	wp_enqueue_script( 'illustratr-transform', get_template_directory_uri() . '/js/transform.js', array(), '20140408', true );

	wp_enqueue_script( 'illustratr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'illustratr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'illustratr-sidebar', get_template_directory_uri() . '/js/sidebar.js', array( 'jquery', 'jquery-masonry' ), '20140325', true );
	}

	wp_enqueue_script( 'illustratr-script', get_template_directory_uri() . '/js/illustratr.js', array( 'jquery', 'underscore' ), '20140317', true );
}
add_action( 'wp_enqueue_scripts', 'illustratr_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function illustratr_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix ) {
		return;
	}

	wp_enqueue_style( 'illustratr-source-sans-pro' );

	wp_enqueue_style( 'illustratr-pt-serif' );
}
add_action( 'admin_enqueue_scripts', 'illustratr_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
