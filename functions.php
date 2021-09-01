<?php
/**
 * ordquidea-deluxe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ordquidea-deluxe
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'orquidea_deluxe_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function orquidea_deluxe_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ordquidea-deluxe, use a find and replace
		 * to change 'orquidea-deluxe' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'orquidea-deluxe', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'orquidea-deluxe' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'orquidea_deluxe_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'orquidea_deluxe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function orquidea_deluxe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'orquidea_deluxe_content_width', 640 );
}
add_action( 'after_setup_theme', 'orquidea_deluxe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function orquidea_deluxe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'orquidea-deluxe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'orquidea-deluxe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'orquidea_deluxe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function orquidea_deluxe_scripts() {
	wp_enqueue_style( 'orquidea-deluxe-style', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', array(), _S_VERSION, true);
	wp_enqueue_script(  'orquidea-contactform', get_template_directory_uri() . '/js/contactform.js', array('axios'), _S_VERSION, true );
	wp_localize_script( 'orquidea-contactform', 'orquidea_obj', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'orquidea_nonce' ),
		'image_path' => get_template_directory_uri() . '/images'
	));
}
add_action( 'wp_enqueue_scripts', 'orquidea_deluxe_scripts' );
