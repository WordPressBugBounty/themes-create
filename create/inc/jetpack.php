<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Create
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function create_jetpack_setup() {
    $pagination_type    = get_theme_mod( 'pagination_type', create_get_default_theme_options( 'pagination_type' ) );

    if( 'infinite-scroll-click' == $pagination_type ) {
        add_theme_support( 'infinite-scroll', array(
            'type'      => 'click',
            'container' => 'main',
            'footer'    => 'colophon',
            'wrapper'   => false,
        ) );
    }
    else if ( 'infinite-scroll-scroll' == $pagination_type ) {
        //Override infinite scroll disable scroll option
        update_option('infinite_scroll', true);

        add_theme_support( 'infinite-scroll', array(
            'type'      => 'scroll',
            'container' => 'main',
            'footer'    => 'colophon',
            'wrapper'   => false,
        ) );
    }

    /**
     * Add theme support for site logos
     */
     add_theme_support( 'site-logo', array( 'size' => 'create-site-logo' ) );

    /**
     * Add theme support for responsive videos.
     */
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'create_jetpack_setup' );
