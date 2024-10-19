<?php
/**
 * Create functions and definitions
 *
 * @package Create
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 650; /* pixels */
}

if ( ! function_exists( 'create_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function create_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Create, use a find and replace
	 * to change 'create' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'create', get_template_directory() . '/languages' );

	// Create styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', create_fonts_url() ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Set default size.
	set_post_thumbnail_size( 650, 488, true );

	// Add default size for single pages.
	add_image_size( 'create-single', '650', '9999', false );

	// Add default size for homepage.
	add_image_size( 'create-home', '261', '196', true );

	// Add default size for homepage.
	add_image_size( 'create-header', '1024', '350', true );

	// Add default size for featured content
	add_image_size( 'create-featured', '540', '406', true );

	// Add default size for testimonial
	add_image_size( 'create-testimonial', '100', '100', true );

	// Add default logo size for Jetpack.
	add_image_size( 'create-site-logo', '300', '9999', false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'create' ),
		'social'  => __( 'Social Menu', 'create' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'create_custom_background_args', array(
		'default-color'       => 'f5f5f5',
		'default-attachment'  => 'cover',
		'default-repeat'      => 'no-repeat',
	) ) );

	/**
	 * Setup title support for theme
	 * Supported from WordPress version 4.1 onwards
	 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 */
	add_theme_support( 'title-tag' );

	//@remove Remove check when WordPress 4.8 is released
	if ( function_exists( 'has_custom_logo' ) ) {
		/**
		* Setup Custom Logo Support for theme
		* Supported from WordPress version 4.5 onwards
		* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		*/
		add_theme_support( 'custom-logo', array(
			'height'      => 150,
			'width'       => 520,
			'flex-height' => true,
			'flex-width'  => true
		) );
	}
}
endif; // create_setup
add_action( 'after_setup_theme', 'create_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function create_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'create' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'create' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Intro Widget', 'create' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional widget that appears only on your default homepage.', 'create' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-intro %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'create_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function create_scripts() {

	// Enqueue masonry
	wp_enqueue_script( 'masonry');

	// Localize script (only few lines in helpers.js)
    wp_localize_script( 'create-helpers', 'create-vars', array(
 	    'author'   => __( 'Your Name', 'create' ),
 	    'email'    => __( 'E-mail', 'create' ),
		'url'      => __( 'Website', 'create' ),
		'comment'  => __( 'Your Comment', 'create' )
 	) );

	// Enqueue default style
	wp_enqueue_style( 'create-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Google fonts
	wp_enqueue_style( 'create-fonts', create_fonts_url(), array(), '1.0.0' );

	//For genericons
	wp_enqueue_style( 'genericons', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/genericons/genericons.css', false, '3.4.1' );

    // JS helpers (This is also the place where we call the jQuery in array)
	wp_enqueue_script( 'create-helpers', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/helpers.js', array( 'jquery' ), '1.0.0', true );

	// Mobile navigation
	wp_enqueue_script( 'create-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/navigation.js', array(), '1.0.0', true );

	wp_localize_script( 'create-navigation', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'create' ),
		'collapse' => esc_html__( 'collapse child menu', 'create' ),
	) );

	// Skip link fix
	wp_enqueue_script( 'create-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Loads up Cycle JS
	 */
	$featured_slider_option = get_theme_mod( 'featured_slider_option', create_get_default_theme_options( 'featured_slider_option' ) );

	if( 'disabled' != $featured_slider_option  ) {
		wp_register_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		/**
		 * Condition checks for additional slider transition plugins
		 */
		$featured_slide_transition_effect = get_theme_mod( 'featured_slide_transition_effect', create_get_default_theme_options( 'featured_slide_transition_effect' ) );

		// Scroll Vertical transition plugin addition
		if ( 'scrollVert' ==  $featured_slide_transition_effect ){
			wp_enqueue_script( 'jquery-cycle2-scrollVert', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}
		// Flip transition plugin addition
		else if ( 'flipHorz' ==  $featured_slide_transition_effect || 'flipVert' ==  $featured_slide_transition_effect ){
			wp_enqueue_script( 'jquery-cycle2-flip', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}
		// Shuffle transition plugin addition
		else if ( 'tileSlide' ==  $featured_slide_transition_effect || 'tileBlind' ==  $featured_slide_transition_effect ){
			wp_enqueue_script( 'jquery-cycle2-tile', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}
		else {
			wp_enqueue_script( 'jquery-cycle2' );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */
	$disable_scrollup = get_theme_mod( 'disable_scrollup', create_get_default_theme_options( 'disable_scrollup' ) );

	if ( '1' != $disable_scrollup ) {
		wp_enqueue_script( 'create-scrollup', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/scrollup.js', array( 'jquery' ), '20141223	', true  );
	}
}
add_action( 'wp_enqueue_scripts', 'create_scripts' );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Create 1.4
 */
/**
 * Register Google fonts.
 *
 */
function create_fonts_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'create' ) ) {

		// Load google font locally.
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

		return esc_url_raw( wptt_get_webfont_url( add_query_arg( 'family', urlencode( 'Bitter:400,700,400italic|Josefin Sans:400,400italic|Varela:400' ), "https://fonts.googleapis.com/css" ) ) );
	}

	return $font_url;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function create_admin_fonts() {
	wp_enqueue_style( 'create-font', create_fonts_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'create_admin_fonts' );

/**
 * Include Default Options for Create
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Implement the Custom Header feature.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Include featured slider
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';

/**
 * Include Metaboxes
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';


/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function create_custom_css_migrate(){
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}

	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.

	    /**
		 * Get Theme Options Values
		 */
		$defaults 				= create_get_default_theme_options();

		$options['custom_css'] 	= get_theme_mod( 'custom_css', $defaults['custom_css'] );

	    if ( '' != $options['custom_css'] ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $options['custom_css'] );
	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            remove_theme_mod( 'custom_css' );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'create_custom_css_migrate' );

if ( ! function_exists( 'create_blocks_support' ) ) :
	/**
	 * Create add default blocks support
	 */
	function create_blocks_support() {
		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'create' ),
					'shortName' => esc_html__( 'S', 'create' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'create' ),
					'shortName' => esc_html__( 'M', 'create' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'create' ),
					'shortName' => esc_html__( 'L', 'create' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'create' ),
					'shortName' => esc_html__( 'XL', 'create' ),
					'size'      => 54,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'create' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'create' ),
				'slug'  => 'black',
				'color' => '#111111',
			),
			array(
				'name'  => esc_html__( 'Gray', 'create' ),
				'slug'  => 'gray',
				'color' => '#f4f4f4',
			),
			array(
				'name'  => esc_html__( 'Blue', 'create' ),
				'slug'  => 'blue',
				'color' => '1b8be0',
			),
			array(
				'name'  => esc_html__( 'Orange', 'create' ),
				'slug'  => 'orange',
				'color' => '#e7b507',
			),
		) );
	}
	add_action( 'after_setup_theme', 'create_blocks_support', 20 );
endif; //create_blocks_support

if ( ! function_exists( 'create_add_blocks_style' ) ) :
	/**
	 * Add Blocks Style
	 */
	function create_add_blocks_style() {
		// Theme block stylesheet.
		wp_enqueue_style( 'create-block-style', get_theme_file_uri( '/css/blocks.css' ), array( 'create-style' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/css/blocks.css' ) ) );
	}
	add_action( 'wp_enqueue_scripts', 'create_add_blocks_style' );
endif; //create_add_blocks_style

if ( ! function_exists( 'create_block_editor_styles' ) ) :
	/**
	 * Enqueue editor styles for Blocks
	 */
	function create_block_editor_styles() {
		// Block styles.
		wp_enqueue_style( 'create-block-editor-style', get_theme_file_uri( '/css/editor-blocks.css' ), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/css/editor-blocks.css' ) ) );

		// Add custom fonts.
		wp_enqueue_style( 'create-fonts', create_fonts_url(), array(), null );
	}
	add_action( 'enqueue_block_editor_assets', 'create_block_editor_styles' );
endif; //create_block_editor_styles
