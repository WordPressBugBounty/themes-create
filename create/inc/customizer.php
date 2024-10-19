<?php
/**
 * Create Theme Customizer
 *
 * @package Create
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function create_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$defaults = create_get_default_theme_options();

	//Theme Options
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer-theme-options.php';

	//Featured Slider
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer-featured-slider-options.php';

    // Reset all settings to default
	$wp_customize->add_section( 'create_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'create' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'create' ),
	) );

	$wp_customize->add_setting( 'reset_all_settings', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'create_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'reset_all_settings', array(
		'label'    => __( 'Check to reset all settings to default', 'create' ),
		'section'  => 'create_reset_all_settings',
		'settings' => 'reset_all_settings',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end

	class CreateImportantLinks extends WP_Customize_Control {
        public $type = 'important-links';

        public function render_content() {
        	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
            $important_links = array(
							'theme_instructions' => array(
								'link'	=> esc_url( 'https://catchthemes.com/theme-instructions/create/' ),
								'text' 	=> __( 'Theme Instructions', 'create' ),
								),
							'support' => array(
								'link'	=> esc_url( 'https://catchthemes.com/support/' ),
								'text' 	=> __( 'Support', 'create' ),
								),
							'changelog' => array(
								'link'	=> esc_url( 'https://catchthemes.com/changelogs/create-theme/' ),
								'text' 	=> __( 'Changelog', 'create' ),
								),
							'donate' => array(
								'link'	=> esc_url( 'https://catchthemes.com/donate/' ),
								'text' 	=> __( 'Donate Now', 'create' ),
								),
							'review' => array(
								'link'	=> esc_url( 'https://wordpress.org/support/view/theme-reviews/create' ),
								'text' 	=> __( 'Review', 'create' ),
								),
							'facebook' => array(
								'link'	=> esc_url( 'https://www.facebook.com/catchthemes/' ),
								'text' 	=> __( 'Facebook', 'create' ),
								),
							'twitter' => array(
								'link'	=> esc_url( 'https://twitter.com/catchthemes/' ),
								'text' 	=> __( 'Twitter', 'create' ),
								),
							'gplus' => array(
								'link'	=> esc_url( 'https://plus.google.com/+Catchthemes/' ),
								'text' 	=> __( 'Google+', 'create' ),
								),
							'pinterest' => array(
								'link'	=> esc_url( 'http://www.pinterest.com/catchthemes/' ),
								'text' 	=> __( 'Pinterest', 'create' ),
								),
							);
			foreach ( $important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . $important_link['text'] .' </a></p>'; // WPCS: XSS OK.
			}
        }
    }

    //Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' 		=> 999,
		'title'   	 	=> __( 'Important Links', 'create' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( new CreateImportantLinks( $wp_customize, 'important_links', array(
        'label'   	=> __( 'Important Links', 'create' ),
         'section'  	=> 'important_links',
        'settings' 	=> 'important_links',
        'type'     	=> 'important_links',
    ) ) );
    //Important Links End

}
add_action( 'customize_register', 'create_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function create_customize_preview_js() {
	wp_enqueue_script( 'create_customizer', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'create_customize_preview_js' );


/**
 * Custom scripts and styles on customize.php for create.
 *
 * @since Create 1.2
 */
function create_customize_scripts() {
	wp_enqueue_script( 'create_customizer_custom', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer-custom-scripts.js', array( 'jquery' ), '20131028', true );

	$create_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'create' )
	);

	wp_localize_script( 'create_customizer_custom', 'create_misc_links', $create_data );
}
add_action( 'customize_controls_print_footer_scripts', 'create_customize_scripts' );

/**
 * Function to reset date with respect to condition
 */
function create_reset_data() {
	if ( get_theme_mod( 'reset_all_settings' ) ) {
    	remove_theme_mods();

        return;
    }
}
add_action( 'customize_save_after', 'create_reset_data' );

//Sanitize callback functions for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer-sanitize-functions.php';

//Active callbacks for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer-active-callbacks.php';

// Add Upgrade to Pro Button.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';
