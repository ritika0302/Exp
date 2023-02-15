<?php
/**
 * example functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package example
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function example_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on example, use a find and replace
		* to change 'example' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'example', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'example' ),
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
			'example_custom_background_args',
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
add_action( 'after_setup_theme', 'example_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function example_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'example_content_width', 640 );
}
add_action( 'after_setup_theme', 'example_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function example_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'example' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'example_widgets_init' );

function home_script_enqueue() {
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css');
    wp_enqueue_style( 'flex-slider', get_stylesheet_directory_uri().'/assets/css/style.css');


    wp_enqueue_script( 'isotope', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'lightbox', get_stylesheet_directory_uri().'/assets/js/jquery-1.11.1.min.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'port', get_stylesheet_directory_uri().'/assets/js/port.js' );
wp_enqueue_script( 'port', get_stylesheet_directory_uri().'/assets/js/style.js' );
wp_enqueue_script( 'gallery-navigation', get_stylesheet_directory_uri().'/js/navigation.js', array(), _S_VERSION, true );
}

add_action('wp_enqueue_scripts', 'home_script_enqueue');



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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';

}
    function create_post_type() {
    register_post_type( 'Portfolios',
    array(
        'labels' => array(
            'name' => __( 'Portfolios' ),
            'singular_name' => __( 'Portfolio' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'Portfolios'),
    )
);
  }
function portfolios_custom_init() {

	$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);
  $labels = array(
    'name' => _x('Portfolios', 'post type general name'),
    'singular_name' => _x('Portfolio', 'post type singular name'),
    'add_new' => _x('Add New', 'Portfolio'),
    'add_new_item' => __('Add New Portfolio'),
    'edit_item' => __('Edit Portfolio'),
    'new_item' => __('New Portfolio'),
    'all_items' => __('All Portfolios'),
    'view_item' => __('View Portfolio'),
    'search_items' => __('Search Portfolios'),
    'not_found' =>  __('No Portfolios found'),
    'not_found_in_trash' => __('No Portfolios found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('Portfolios')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=>'portfolios'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 10,
    'supports' => array( 'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes')
  ); 
  register_post_type('portfolios',$args);
}

register_taxonomy('portfolio_category', 'portfolios', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'porfolio-category' )));

add_action( 'init', 'portfolios_custom_init' );


add_theme_support('post-thumbnails');
function setup_types() {
    register_post_type('mytype', array(
        'label' => __('My type'),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'show_ui' => true,
    ));
}
add_action('init', 'setup_types');
function add_ajax_scripts() {
    wp_enqueue_script( 'ajaxcalls', get_template_directory_uri() . '/js/ajax-calls.js', array(), '1.0.0', true );

    wp_localize_script( 'ajaxcalls', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'ajaxnonce' => wp_create_nonce( 'ajax_post_validation' )
    ) );
}

add_action( 'wp_enqueue_scripts', 'add_ajax_scripts' );

?>

