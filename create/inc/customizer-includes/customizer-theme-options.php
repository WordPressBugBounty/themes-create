<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Create Pro
 */

	//Theme Options
	$wp_customize->add_panel( 'create_theme_options', array(
	    'description'    => __( 'Basic theme Options', 'create' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => 200,
	    'title'    		 => __( 'Theme Options', 'create' ),
	) );

	/**
	 *  Remove Custom CSS option from WordPress 4.7 onwards
	 *  //@remove Remove if block and custom_css when WordPress 5.0 is released
	 */
	if ( !function_exists( 'wp_update_custom_css_post' ) ) {
	   	// Custom CSS Option
		$wp_customize->add_section( 'create_custom_css', array(
			'description'	=> __( 'Custom/Inline CSS', 'create'),
			'panel'  		=> 'create_theme_options',
			'priority' 		=> 203,
			'title'    		=> __( 'Custom CSS Options', 'create' ),
		) );

		$wp_customize->add_setting( 'custom_css', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['custom_css'],
			'sanitize_callback' => 'create_sanitize_custom_css',
		) );

		$wp_customize->add_control( 'custom_css', array(
				'label'		=> __( 'Enter Custom CSS', 'create' ),
		        'priority'	=> 1,
				'section'   => 'create_custom_css',
		        'settings'  => 'custom_css',
				'type'		=> 'textarea',
		) ) ;
	   	// Custom CSS End
	}

   	// Excerpt Options
	$wp_customize->add_section( 'create_excerpt_options', array(
		'panel'  	=> 'create_theme_options',
		'priority' 	=> 204,
		'title'    	=> __( 'Excerpt Options', 'create' ),
	) );

	$wp_customize->add_setting( 'excerpt_length', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_length'],
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'excerpt_length', array(
		'description' => __('Excerpt length. Default is 40 words', 'create'),
		'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
        'label'    => __( 'Excerpt Length (words)', 'create' ),
		'section'  => 'create_excerpt_options',
		'settings' => 'excerpt_length',
		'type'	   => 'number',
		)
	);

	$wp_customize->add_setting( 'excerpt_more_text', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_more_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'excerpt_more_text', array(
		'label'    => __( 'Read More Text', 'create' ),
		'section'  => 'create_excerpt_options',
		'settings' => 'excerpt_more_text',
		'type'	   => 'text',
	) );
	// Excerpt Options End

	//Custom control for dropdown category multiple select
	class Create_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public $name;

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->name,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'create' )
				)
			);

			$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',esc_html( $this->label ), $dropdown ); // WPCS: XSS OK.
			echo '<p class="description">'. __( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'create' ) . '</p>';
		}
	}

	//Homepage / Frontpage Options
	$wp_customize->add_section( 'create_homepage_options', array(
		'description'	=> __( 'Only posts that belong to the categories selected here will be displayed on the front page', 'create' ),
		'panel'			=> 'create_theme_options',
		'priority' 		=> 209,
		'title'   	 	=> __( 'Homepage / Frontpage Options', 'create' ),
	) );

	$wp_customize->add_setting( 'front_page_category', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_category'],
		'sanitize_callback'	=> 'create_sanitize_category_list',
	) );

	$wp_customize->add_control( new Create_Customize_Dropdown_Categories_Control( $wp_customize, 'front_page_category', array(
        'label'   	=> __( 'Select Categories', 'create' ),
        'name'	 	=> 'front_page_category',
		'priority'	=> '6',
        'section'  	=> 'create_homepage_options',
        'settings' 	=> 'front_page_category',
        'type'     	=> 'dropdown-categories',
    ) ) );
	//Homepage / Frontpage Settings End

	// Layout Options
	$wp_customize->add_section( 'create_layout', array(
		'capability'=> 'edit_theme_options',
		'panel'		=> 'create_theme_options',
		'priority'	=> 211,
		'title'		=> __( 'Layout Options', 'create' ),
	) );

	$wp_customize->add_setting( 'homepage_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['homepage_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$create_homepage_layouts = create_homepage_layouts();
	$choices = array();
	foreach ( $create_homepage_layouts as $create_homepage_layout ) {
		$choices[ $create_homepage_layout['value'] ] = $create_homepage_layout['label'];
	}

	$wp_customize->add_control( 'homepage_layout', array(
		'choices'	=> $choices,
		'label'		=> __( 'Frontpage Posts Layout', 'create' ),
		'section'	=> 'create_layout',
		'settings'  => 'homepage_layout',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'theme_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['theme_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = create_layouts();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'theme_layout', array(
		'choices'	=> $choices,
		'label'		=> __( 'Default Layout', 'create' ),
		'section'	=> 'create_layout',
		'settings'  => 'theme_layout',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'create_theme_options[content_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['content_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$wp_customize->add_setting( 'content_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['content_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = create_get_archive_content_layout();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'content_layout', array(
		'choices'   => $choices,
		'label'		=> __( 'Archive Content Layout', 'create' ),
		'section'   => 'create_layout',
		'settings'  => 'content_layout',
		'type'      => 'select',
	) );

	$wp_customize->add_setting( 'single_post_image_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['single_post_image_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );


	$single_post_image_layouts = create_single_post_image_layout_options();
	$choices = array();
	foreach ( $single_post_image_layouts as $single_post_image_layout ) {
		$choices[$single_post_image_layout['value']] = $single_post_image_layout['label'];
	}

	$wp_customize->add_control( 'single_post_image_layout', array(
			'label'		=> __( 'Single Page/Post Image Layout ', 'create' ),
			'section'   => 'create_layout',
	        'settings'  => 'single_post_image_layout',
	        'type'	  	=> 'select',
			'choices'  	=> $choices,
	) );
   	// Layout Options End

	// Pagination Options
	$pagination_type	= get_theme_mod( 'pagination_type' );

	$create_navigation_description = '';

	/**
	 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	 */
	if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
		if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			$create_navigation_description = sprintf( __( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'create' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );
		}
	}

	$wp_customize->add_section( 'create_pagination_options', array(
		'description'	=> $create_navigation_description,
		'panel'  		=> 'create_theme_options',
		'priority'		=> 212,
		'title'    		=> __( 'Pagination Options', 'create' ),
	) );

	$wp_customize->add_setting( 'pagination_type', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['pagination_type'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$pagination_types = create_get_pagination_types();
	$choices = array();
	foreach ( $pagination_types as $pagination_type ) {
		$choices[$pagination_type['value']] = $pagination_type['label'];
	}

	$wp_customize->add_control( 'pagination_options', array(
		'choices'  => $choices,
		'label'    => __( 'Pagination type', 'create' ),
		'section'  => 'create_pagination_options',
		'settings' => 'pagination_type',
		'type'	   => 'select',
	) );
	// Pagination Options End

	// Scrollup
	$wp_customize->add_section( 'create_scrollup', array(
		'panel'    => 'create_theme_options',
		'priority' => 215,
		'title'    => __( 'Scrollup Options', 'create' ),
	) );

	$wp_customize->add_setting( 'disable_scrollup', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['disable_scrollup'],
		'sanitize_callback' => 'create_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_scrollup', array(
		'label'		=> __( 'Check to disable Scroll Up', 'create' ),
		'section'   => 'create_scrollup',
        'settings'  => 'disable_scrollup',
		'type'		=> 'checkbox',
	) );
	// Scrollup End

	// Search Options
	$wp_customize->add_section( 'create_search_options', array(
		'description'=> __( 'Change default placeholder text in Search.', 'create'),
		'panel'  => 'create_theme_options',
		'priority' => 216,
		'title'    => __( 'Search Options', 'create' ),
	) );

	$wp_customize->add_setting( 'search_text', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['search_text'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'search_text', array(
		'label'		=> __( 'Default Display Text in Search', 'create' ),
		'section'   => 'create_search_options',
        'settings'  => 'search_text',
		'type'		=> 'text',
	) );
	// Search Options End
	//Theme Option End
