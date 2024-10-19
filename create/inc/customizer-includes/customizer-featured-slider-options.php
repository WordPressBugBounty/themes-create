<?php
/**
 * The template for adding Featured Slider Options in Customizer
 *
 * @package Create
 * @subpackage Create Pro
 * @since Create 1.2.1
 */
	// Featured Slider
	$wp_customize->add_section( 'create_featured_slider', array(
		'priority'       => 500,
		'title'			=> __( 'Featured Slider', 'create' ),
	) );

	$wp_customize->add_setting( 'featured_slider_option', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_option'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$featured_slider_content_options = create_featured_slider_options();
	$choices = array();
	foreach ( $featured_slider_content_options as $featured_slider_content_option ) {
		$choices[$featured_slider_content_option['value']] = $featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'featured_slider_option', array(
		'choices'   => $choices,
		'label'    	=> __( 'Enable Slider on', 'create' ),
		'priority'	=> '1.1',
		'section'  	=> 'create_featured_slider',
		'settings' 	=> 'featured_slider_option',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'featured_slide_transition_effect', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_effect'],
		'sanitize_callback'	=> 'create_sanitize_select',
	) );

	$create_featured_slide_transition_effects = create_featured_slide_transition_effects();
	$choices = array();
	foreach ( $create_featured_slide_transition_effects as $create_featured_slide_transition_effect ) {
		$choices[$create_featured_slide_transition_effect['value']] = $create_featured_slide_transition_effect['label'];
	}

	$wp_customize->add_control( 'featured_slide_transition_effect' , array(
		'active_callback' => 'create_is_slider_active',
		'choices'         => $choices,
		'label'           => __( 'Transition Effect', 'create' ),
		'priority'        => '2',
		'section'         => 'create_featured_slider',
		'settings'        => 'featured_slide_transition_effect',
		'type'            => 'select',
		)
	);

	$wp_customize->add_setting( 'featured_slide_transition_delay', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_delay'],
		'sanitize_callback'	=> 'absint',
		'sanitize_callback'	=> 'create_sanitize_select',
	) );

	$wp_customize->add_control( 'featured_slide_transition_delay' , array(
		'active_callback'	=> 'create_is_slider_active',
		'description'	=> __( 'seconds(s)', 'create' ),
		'input_attrs' => array(
        	'style' => 'width: 40px;'
    	),
    	'label'    		=> __( 'Transition Delay', 'create' ),
		'priority'		=> '2.1.1',
		'section'  		=> 'create_featured_slider',
		'settings' 		=> 'featured_slide_transition_delay',
		)
	);

	$wp_customize->add_setting( 'featured_slide_transition_length', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_length'],
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_control( 'featured_slide_transition_length' , array(
		'active_callback' => 'create_is_slider_active',
		'description'     => __( 'seconds(s)', 'create' ),
		'input_attrs'     => array(
			'style'	=> 'width: 40px;'
		),
		'label'           => __( 'Transition Length', 'create' ),
		'priority'        => '2.1.2',
		'section'         => 'create_featured_slider',
		'settings'        => 'featured_slide_transition_length',
		)
	);

	$wp_customize->add_setting( 'featured_slider_image_loader', array(
		'capability'        => 'edit_theme_options',
		'default'			=> $defaults['featured_slider_image_loader'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$featured_slider_image_loader_options = create_featured_slider_image_loader();
	$choices = array();
	foreach ( $featured_slider_image_loader_options as $featured_slider_image_loader_option ) {
		$choices[$featured_slider_image_loader_option['value']] = $featured_slider_image_loader_option['label'];
	}

	$wp_customize->add_control( 'featured_slider_image_loader', array(
		'active_callback' => 'create_is_slider_active',
		'choices'         => $choices,
		'label'           => __( 'Image Loader', 'create' ),
		'priority'        => '2.1.3',
		'section'         => 'create_featured_slider',
		'settings'        => 'featured_slider_image_loader',
		'type'            => 'select',
	) );

	$wp_customize->add_setting( 'featured_slider_type', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_type'],
		'sanitize_callback'	=> 'sanitize_key',
	) );

	$featured_slider_types = create_featured_slider_types();
	$choices = array();
	foreach ( $featured_slider_types as $featured_slider_type ) {
		$choices[$featured_slider_type['value']] = $featured_slider_type['label'];
	}

	$wp_customize->add_control( 'featured_slider_type', array(
		'active_callback' => 'create_is_slider_active',
		'choices'         => $choices,
		'label'           => __( 'Select Slider Type', 'create' ),
		'priority'        => '2.1.3',
		'section'         => 'create_featured_slider',
		'settings'        => 'featured_slider_type',
		'type'            => 'select',
	) );

	$wp_customize->add_setting( 'featured_slide_number', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_number'],
		'sanitize_callback'	=> 'create_sanitize_number_range',
	) );

	$wp_customize->add_control( 'featured_slide_number' , array(
			'active_callback' => 'create_is_demo_slider_inactive',
			'description'     => __( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'create' ),
			'input_attrs' => array(
				'style'       => 'width: 45px;',
				'min'         => 0,
				'max'         => 20,
				'step'        => 1,
			),
			'label'           => __( 'No of Slides', 'create' ),
			'priority'        => '2.2.1',
			'section'         => 'create_featured_slider',
			'settings'        => 'featured_slide_number',
			'type'            => 'number',
		)
	);

	//Get featured slides humber from theme options
	$featured_slide_number	= get_theme_mod( 'featured_slide_number', create_get_default_theme_options( 'featured_slide_number' ) );

	//loop for featured post sliders
	for ( $i=1; $i <=  $featured_slide_number ; $i++ ) {
		$wp_customize->add_setting( 'featured_slider_page_'. $i, array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'create_sanitize_page',
		) );

		$wp_customize->add_control( 'featured_slider_page_'. $i .'', array(
			'active_callback' => 'create_is_demo_slider_inactive',
			'label'           => __( 'Featured Page', 'create' ) . ' # ' . $i ,
			'section'         => 'create_featured_slider',
			'settings'        => 'featured_slider_page_'. $i,
			'type'            => 'dropdown-pages',
		) );
	}
// Featured Slider End
