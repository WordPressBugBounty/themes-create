<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Create
 */


/**
 * Returns the default options for create.
 *
 * @since Create 1.2.1
 */
function create_get_default_theme_options( $parameter = null ) {

	$default_theme_options = array(

		//Layout
		'homepage_layout'                  => 'no-sidebar-full-width',
		'theme_layout'                     => 'left-sidebar',
		'content_layout'                   => 'excerpt-featured-image',
		'single_post_image_layout'         => 'featured-image',

		//Custom CSS
		'custom_css'                       => '',

		//Scrollup Options
		'disable_scrollup'                 => 0,

		//Excerpt Options
		'excerpt_length'                   => '30',
		'excerpt_more_text'                => __( '[ . . . ]', 'create' ),

		//Pagination Options
		'pagination_type'                  => 'default',

		//Search Options
		'search_text'                      => __( 'Search...', 'create' ),

		//Homepage / Frontpage Settings
		'front_page_category'			   => '0',

		//Featured Slider Options
		'featured_slider_option'           => 'disabled',
		'featured_slider_image_loader'     => 'true',
		'featured_slide_transition_effect' => 'fadeout',
		'featured_slide_transition_delay'  => '4',
		'featured_slide_transition_length' => '1',
		'featured_slider_type'             => 'demo-featured-slider',
		'featured_slide_number'            => '4',

		//Reset all settings
		'reset_all_settings'               => 0,
	);

	if ( null == $parameter ) {
		return apply_filters( 'create_default_theme_options', $default_theme_options );
	}
	else {
		return $default_theme_options[ $parameter ];
	}
}

/**
 * Returns an array of slider layout options registered for create.
 *
 * @since Create 1.2.1
 */
function create_featured_slider_options() {
	$featured_slider_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'create' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'create' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'create' ),
		),
	);

	return apply_filters( 'create_featured_slider_options', $featured_slider_options );
}

/**
 * Returns an array of feature slider types registered for create.
 *
 * @since Create 1.2
 */
function create_featured_slider_types() {
	$featured_slider_types = array(
		'demo-featured-slider' => array(
			'value' => 'demo-featured-slider',
			'label' => __( 'Demo', 'create' ),
		),
		'featured-page-slider' => array(
			'value' => 'featured-page-slider',
			'label' => __( 'Page', 'create' ),
		),
	);

	return apply_filters( 'create_featured_slider_types', $featured_slider_types );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Create 1.2
 */
function create_featured_slide_transition_effects() {
	$featured_slide_transition_effects = array(
		'fade' 		=> array(
			'value'	=> 'fade',
			'label' => __( 'Fade', 'create' ),
		),
		'fadeout' 	=> array(
			'value'	=> 'fadeout',
			'label' => __( 'Fade Out', 'create' ),
		),
		'none' 		=> array(
			'value' => 'none',
			'label' => __( 'None', 'create' ),
		),
		'scrollHorz'=> array(
			'value' => 'scrollHorz',
			'label' => __( 'Scroll Horizontal', 'create' ),
		),
		'scrollVert'=> array(
			'value' => 'scrollVert',
			'label' => __( 'Scroll Vertical', 'create' ),
		),
		'flipHorz'	=> array(
			'value' => 'flipHorz',
			'label' => __( 'Flip Horizontal', 'create' ),
		),
		'flipVert'	=> array(
			'value' => 'flipVert',
			'label' => __( 'Flip Vertical', 'create' ),
		),
		'tileSlide'	=> array(
			'value' => 'tileSlide',
			'label' => __( 'Tile Slide', 'create' ),
		),
		'tileBlind'	=> array(
			'value' => 'tileBlind',
			'label' => __( 'Tile Blind', 'create' ),
		)
	);

	return apply_filters( 'create_featured_slide_transition_effects', $featured_slide_transition_effects );
}

/**
 * Returns an array of featured slider image loader options
 *
 * @since Create 1.4
 */
function create_featured_slider_image_loader() {
	$color_scheme_options = array(
		'true' => array(
			'value' 				=> 'true',
			'label' 				=> __( 'True', 'create' ),
		),
		'wait' => array(
			'value' 				=> 'wait',
			'label' 				=> __( 'Wait', 'create' ),
		),
		'false' => array(
			'value' 				=> 'false',
			'label' 				=> __( 'False', 'create' ),
		),
	);

	return apply_filters( 'create_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of layout options registered for create.
 *
 * @since Create 1.4
 */
function create_homepage_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}

/**
 * Returns an array of layout options registered for create.
 *
 * @since Create 1.4
 */
function create_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for create.
 *
 * @since Create 1.4
 */
function create_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-featured-image' => array(
			'value' => 'excerpt-featured-image',
			'label' => __( 'Show Excerpt', 'create' ),
		),
		'full-content' => array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content (No Featured Image)', 'create' ),
		),
	);

	return apply_filters( 'create_get_archive_content_layout', $layout_options );
}

/**
 * Returns an array of feature image size
 *
 * @since Create 1.4
 */
function create_featured_image_size_options() {
	$featured_image_size_options = array(
		'featured-image'		=> array(
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' ),
		),
		'full' 		=> array(
			'value'	=> 'full',
			'label' => __( 'Full Image', 'create' ),
		),
		'large' 	=> array(
			'value' => 'large',
			'label' => __( 'Large Image', 'create' ),
		),
	);

	return apply_filters( 'create_featured_image_size_options', $featured_image_size_options );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Create 1.4
 */
function create_single_post_image_layout_options() {
	$single_post_image_layout_options = array(
		'large' => array(
			'value' => 'large',
			'label' => __( 'Large', 'create' ),
		),
		'full-size' => array(
			'value' => 'full-size',
			'label' => __( 'Full size', 'create' ),
		),
		'featured-image ' => array(
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' ),
		),
		'disable' => array(
			'value' => 'disable',
			'label' => __( 'Disabled', 'create' ),
		),
	);
	return apply_filters( 'create_single_post_image_layout_options', $single_post_image_layout_options );
}


/**
 * Returns an array of pagination schemes registered for create.
 *
 * @since Create 1.4
 */
function create_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default(Older Posts/Newer Posts)', 'create' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => __( 'Numeric', 'create' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => __( 'Infinite Scroll (Scroll)', 'create' ),
		),
		'infinite-scroll-click' => array(
			'value' => 'infinite-scroll-click',
			'label' => __( 'Infinite Scroll (Click)', 'create' ),
		),
	);

	return apply_filters( 'create_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of metabox layout options registered for create.
 *
 * @since Create 1.4
 */
function create_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'create-layout-option',
			'value' => 'default',
			'label' => __( 'Default', 'create' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'create-layout-option',
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'id' 	=> 'create-layout-option',
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for create.
 *
 * @since Create 1.4
 */
function create_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'create' ),
		),
		'enable' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'enable',
			'label' 	=> __( 'Enable', 'create' ),
		),
		'disable' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'disable',
			'label' 	=> __( 'Disable', 'create' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}

/**
 * Returns an array of metabox featured image options registered for create.
 *
 * @since Create 1.4
 */
function create_metabox_featured_image_options() {
	$featured_image_options = array(
		'default' => array(
			'id'	=> 'create-featured-image',
			'value' => 'default',
			'label' => __( 'Default', 'create' ),
		),
		'large' => array(
			'id'	=> 'create-featured-image',
			'value' => 'large',
			'label' => __( 'Large', 'create' )
		),
		'full-size' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'full',
			'label' => __( 'Full Size', 'create' )
		),
		'featured-image' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' )
		),
		'disable' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'disable',
			'label' => __( 'Disable Image', 'create' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}
