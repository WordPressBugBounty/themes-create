<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Catch Themes
 * @subpackage Create Pro
 * @since Create 2.1
 */

if ( ! function_exists( 'create_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Create 2.1
	 *
	 */
	function create_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'create_doctype', 'create_doctype', 10 );


if ( ! function_exists( 'create_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Create 2.1
	 *
	 */
	function create_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
endif;
add_action( 'create_before_wp_head', 'create_head', 10 );

if ( ! function_exists( 'create_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Create 2.1
	 *
	 */
	function create_page_start() {
		?>
		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'create' ); ?></a>
		<?php
	}
endif;
add_action( 'create_before_header', 'create_page_start', 10 );


if ( ! function_exists( 'create_header_start' ) ) :
	/**
	 * Start Header id #masthead
	 *
	 * @since Create 2.1
	 *
	 */
	function create_header_start() {
		echo "\n";
		?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'create_header', 'create_header_start', 10 );


if ( ! function_exists( 'create_site_banner_start' ) ) :
	/**
	 * Start in header class .site-banner
	 *
	 * @since Create 2.1
	 *
	 */
	function create_site_banner_start() {
		?>
		<div class="site-banner">
		<?php
	}
endif;
add_action( 'create_header', 'create_site_banner_start', 20 );


if ( ! function_exists( 'create_site_branding_start' ) ) :
	/**
	 * Start in header class .site-branding
	 *
	 * @since Create 2.1
	 *
	 */
	function create_site_branding_start() {
		?>
		<div class="site-branding">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'create_header', 'create_site_branding_start', 30 );

if ( ! function_exists( 'create_primary_menu' ) ) :
	/**
	 * Display Primary menu
	 *
	 * @since Create 2.1
	 *
	 */
	function create_primary_menu() {
		?>
		<div id="site-header-menu">
		    <button id="menu-toggle-primary" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'create' ); ?></button>
		    <div id="primary-menu-wrapper">
			    <?php if ( has_nav_menu( 'primary' ) ) : ?>
			    	<nav id="site-navigation" class="main-navigation create-menu custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'create' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							 ) );
						?>
					</nav><!-- #site-navigation -->
				<?php else : ?>
					<nav id="site-navigation" class="main-navigation create-menu default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'create' ); ?>">
						<?php wp_page_menu(
							array(
								'menu_class' => 'primary-menu-container',
								'before'     => '<ul id="menu-primary-items" class="primary-menu">',
								'after'      => '</ul>'
							)
						); ?>
					</nav><!-- #site-navigation -->
				<?php endif; ?>
			</div><!-- #primary-menu-wrapper -->
		</div><!-- #site-header-menu -->
		<?php
	}
endif;
add_action( 'create_header', 'create_primary_menu', 40 );

if ( ! function_exists( 'create_logo' ) ) :
	/**
	 * Get logo output and display with jetpack logo in priority
	 *
	 * @get logo output
	 * @since Create 2.1
	 *
	 */
	function create_logo() {
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				echo '<div class="site-logo">'. get_custom_logo() . '</div><!-- Site Logo div -->';
			}
		}
		if ( function_exists( 'jetpack_the_site_logo' ) ) {
			jetpack_the_site_logo();
		}
	}
endif;
add_action( 'create_header', 'create_logo', 50 );


if ( ! function_exists( 'create_site_title_description' ) ) :
	/**
	 * Display Site Title and Description
	 *
	 * @get logo output
	 * @since Create 2.1
	 *
	 */
	function create_site_title_description() {
		?>
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>

		<p class="site-description">
			<?php bloginfo( 'description' ); ?>
		</p>
		<?php
	}
endif;
add_action( 'create_header', 'create_site_title_description', 60 );


if ( ! function_exists( 'create_site_branding_end' ) ) :
	/**
	 * End in header class .site-branding
	 *
	 * @since Create 2.1
	 *
	 */
	function create_site_branding_end() {
		?>
			</div><!-- .wrapper -->
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'create_header', 'create_site_branding_end', 70 );


if ( ! function_exists( 'create_header_featured_image' ) ) :
	/**
	 * End in header class .site-branding
	 *
	 * @since Create 2.3
	 *
	 */
	function create_header_featured_image() {
		create_featured_image();
	}
endif;
add_action( 'create_header', 'create_header_featured_image', 80 );


if ( ! function_exists( 'create_social_menu' ) ) :
	/**
	 * Display Primary menu
	 *
	 * @since Create 2.1
	 *
	 */
	function create_social_menu() {
		if ( has_nav_menu( 'social' ) ) { ?>
            <div class="social-menu">
		        <?php
		        	wp_nav_menu(
		        		array(
				    		'theme_location' 	=> 'social',
				    		'container_class'	=> 'social-menu-container wrapper',
				    		'depth'          	=> '1',
				    		'link_before'    	=> '<span class="screen-reader-text">',
				    		'link_after'     	=> '</span>'
				    	)
				    );
                ?>
            </div><!-- .social-menu -->
        <?php
    	}
	}
endif;
add_action( 'create_header', 'create_social_menu', 90 );

if ( ! function_exists( 'create_site_banner_end' ) ) :
	/**
	 * Start in header class .site-banner
	 *
	 * @since Create 2.1
	 *
	 */
	function create_site_banner_end() {
		?>
		</div><!-- .site-banner -->
		<?php
	}
endif;
add_action( 'create_header', 'create_site_banner_end', 110 );

if ( ! function_exists( 'create_header_end' ) ) :
	/**
	 * End in header class .site-banner and class .wrapper
	 *
	 * @since Create 2.1
	 *
	 */
	function create_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'create_header', 'create_header_end', 200 );


if ( ! function_exists( 'create_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Create 2.1
	 *
	 */
	function create_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action( 'create_content', 'create_content_start', 10 );


if ( ! function_exists( 'create_intro_sidebar' ) ) :
	/**
	 * Displat Intro Sidebar
	 *
	 * @since Create 2.1
	 *
	 */
	function create_intro_sidebar() {
		get_sidebar( 'intro' );
	}
endif;
add_action('create_content', 'create_intro_sidebar', 20 );



if ( ! function_exists( 'create_sidebar' ) ) :
	/**
	 * End Content wrap
	 *
	 * @since Create 0.2
	 */
	function create_sidebar() {
		get_sidebar();
	}
endif; //create_sidebar
add_action( 'create_before_footer', 'create_sidebar', 10 );


if ( ! function_exists( 'create_content_end' ) ) :
	/**
	 * End Content wrap
	 *
	 * @since Create 0.2
 	*/
	function create_content_end() { ?>
			</div><!-- .wrapper -->
		</div><!-- #content -->
	<?php
	}
	endif; //create_content_end
add_action( 'create_before_footer', 'create_content_end', 10 );

if ( ! function_exists( 'create_footer_start' ) ) :
	/**
	 * Start Footer wrap
	 *
	 * @since Create 0.2
	 */
	function create_footer_start() { ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
	<?php
	}
endif; //create_footer_start
add_action( 'create_footer', 'create_footer_start', 10 );

if ( ! function_exists( 'create_footer_end' ) ) :
	/**
	 * End Footer wrap
	 *
	 * @since Create 0.2
	 */
	function create_footer_end() { ?>
		</footer><!-- #colophon -->
	<?php
	}
endif; //create_footer_end
add_action( 'create_footer', 'create_footer_end', 50 );

if ( ! function_exists( 'create_page_end' ) ) :
	/**
	 * End Page wrap
	 *
	 * @since Create 0.2
	 */
	function create_page_end() { ?>
		</div><!-- #page -->
	<?php
	}
endif; //create_page_end
add_action( 'create_footer', 'create_page_end', 100 );

if ( ! function_exists( 'create_copyright' ) ) :
	/**
	* Powered by Text
	*
	* @since Create 0.2
	*/
	function create_copyright() { ?>
		<span class="site-copyright">
			<?php
			printf( _x( '&copy; %1$s %2$s' , '1: Year, 2: Site Title with home URL', 'create' ), esc_attr( date_i18n( __( 'Y', 'create' ) ) ), '<a href="' . esc_url( home_url( '/' ) ) . '"> ' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
			?>
		</span>
	<?php
	}
endif; //create_copyright


if ( ! function_exists( 'create_seperator' ) ) :
	/**
	 * Seperator
	 *
	 * @since Create 0.2
	 */
	function create_seperator() { ?>
		<span class="sep"><?php echo esc_html( '&nbsp;&bull;&nbsp;' ); ?></span>
	<?php
	}
endif; //create_seperator

/**
 * Profile
 *
 * @since Create 0.2
 */
function create_profile() { ?>
	<span class="theme-name">
		<?php echo esc_attr( 'Create' ); ?>
	</span>
	<span class="theme-by">
		<?php _ex( 'by', 'attribution', 'create' ); ?>
	</span>
	<span class="theme-author">
		<a href="<?php echo esc_url( 'https://catchthemes.com/' ); ?>" target="_blank">
			<?php echo esc_attr( 'Catch Themes' ); ?>
		</a>
	</span>
<?php
}

/**
 * Footer Information
 *
 * @since Create 0.2
 */
function create_footer_info() { ?>
	<div class="site-info">
		<div class="wrapper">
			<?php create_copyright(); ?>
			<?php create_seperator(); ?>
			<?php create_profile(); ?>
		</div><!-- .wrapper -->
	</div><!-- .site-info -->
	<?php
}
// Load footer content in  create_footer hook
add_action( 'create_footer', 'create_footer_info', 20 );
