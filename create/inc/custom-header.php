<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Create
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses create_header_style()
 * @uses create_admin_header_style()
 * @uses create_admin_header_image()
 */
function create_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'create_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'cfa205',
		'width'                  => 1024,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'create_header_style',
		'admin-head-callback'    => 'create_admin_header_style',
		'admin-preview-callback' => 'create_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'create_custom_header_setup' );

if ( ! function_exists( 'create_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see create_custom_header_setup().
 */
function create_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: get_theme_support( 'custom-header', 'default-text-color' ) is default, hide text (returns 'blank') or any hex value
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // create_header_style

if ( ! function_exists( 'create_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see create_custom_header_setup().
 */
function create_admin_header_style() {
?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == get_header_textcolor() ) :
		?>
			.site-title,
			.site-description {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo get_header_textcolor(); ?>;
			}
		<?php endif; ?>

		.appearance_page_custom-header #headimg {
			border: none;
		}
	</style>
<?php
}
endif; // create_admin_header_style

if ( ! function_exists( 'create_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see create_custom_header_setup().
 */
function create_admin_header_image() {
?>
	<div class="site-branding">
		<h1 class="site-title"><a id="name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<p class="site-description" id="desc"><?php bloginfo( 'description' ); ?></p>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // create_admin_header_image


if ( ! function_exists( 'create_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own create_featured_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_featured_image() {
		$header_image 	= 	get_header_image();
		$title 			=	get_bloginfo( 'name', 'display' );	
		
		if ( '' != $header_image ) {				
	
			$feat_image = '<img class="wp-post-image" alt="' . esc_attr( $title ) . '" src="' . esc_url(  $header_image ) . '" />';
			
			$create_featured_image	=	'<div id="header-featured-image">';
			$create_featured_image	.=	'<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . $feat_image . '</a>'; 	
			$create_featured_image	.=	'</div><!-- #header-featured-image -->';
		
			echo $create_featured_image;
		}
	}
endif; // create_featured_image