<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Chicago
 * @since Create 2.1
 */

if( ! function_exists( 'create_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Create 2.1
	*/
	function create_is_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'featured_slider_option' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if( ! function_exists( 'create_is_demo_slider_inactive' ) ) :
	/**
	* Return true if demo slider is inactive
	*
	* @since Create 2.1
	*/
	function create_is_demo_slider_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable	= $control->manager->get_setting( 'featured_slider_option' )->value();

		$type 	= $control->manager->get_setting( 'featured_slider_type' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-featured-slider' == $type ) );
	}
endif;
