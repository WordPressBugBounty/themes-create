<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Create Pro
 */

/**
 * create_doctype hook
 *
 * @hooked create_doctype -  10
 *
 */
do_action( 'create_doctype' );
?>

<head>
<?php
/**
 * create_before_wp_head hook
 *
 * @hooked create_head -  10
 *
 */
do_action( 'create_before_wp_head' );

wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' );  ?>

	<?php
	/**
	 * create_before_header hook
	 *
	 * @hooked create_page_start -  10
	 *
	 */
	do_action( 'create_before_header' );

	/**
	 * create_header hook
	 *
	 * @hooked create_header_start -  10
	 * @hooked create_site_banner_start -  20
	 * @hooked create_site_branding_start -  30
	 * @hooked create_primary_menu -  40
	 * @hooked create_logo -  50
	 * @hooked create_site_title_description -  60
	 * @hooked create_site_branding_end -  70
	 * @hooked create_header_featured_image - 80
	 * @hooked create_social_menu - 90
	 * @hooked create_site_banner_end - 110
	 * @hooked create_header_end -  200
	 *
	 */
	do_action( 'create_header' );


	/**
	 * create_after_header hook
	 *
	 * @hooked create_slider - 10
	 */
	do_action( 'create_after_header' );

	/**
	 * create_content hook
	 *
	 * @hooked create_content_start -  10
	 * @hooked create_intro_sidebar -  20
	 */
	do_action( 'create_content' );
