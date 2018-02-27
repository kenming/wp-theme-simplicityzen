<?php
/**
 * SimplicityZen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SimplicityZen
 */

if ( ! function_exists( 'simplicityzen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function simplicityzen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SimplicityZen, use a find and replace
		 * to change 'simplicityzen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simplicityzen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'simplicityzen' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'simplicityzen_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'simplicityzen_setup' );

function devwp_add_editor_style() {
	add_editor_style( '/assets/css/editor-style.css' );
}
add_action( 'admin_init', 'devwp_add_editor_style' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simplicityzen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simplicityzen_content_width', 1140 );
}
add_action( 'after_setup_theme', 'simplicityzen_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function simplicityzen_scripts() {
	wp_enqueue_style( 'simplicityzen-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	wp_enqueue_style( 'simplicityzen-style', get_stylesheet_uri() );

	wp_enqueue_script( 'simplicityzen-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('simplicityzen-fontawesome', get_template_directory_uri().'/assets/js/fontawesome-all.js', null, null, true );

	/**
	 * 	Enquese bootstrap 4.x scripts
	 */

	if ( ! is_admin() ) {
		// Update the JQuery version.
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery',get_template_directory_uri().'/assets/js/jquery-min.js',array(),'',true);
		wp_enqueue_script( 'jquery' );
	}

	// refer: http://getbootstrap.com/docs/4.0/getting-started/download/#bootstrapcdn
	wp_enqueue_script( 'popper_min',get_template_directory_uri().'/assets/js/popper.min.js',array('jquery'),'',true);
	wp_enqueue_script( 'bootstrap_min',get_template_directory_uri().'/assets/js/bootstrap.min.js',array('popper_min','jquery'),'',true);
}
add_action( 'wp_enqueue_scripts', 'simplicityzen_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Widgets file.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load Custom Navigation Walker file.
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

