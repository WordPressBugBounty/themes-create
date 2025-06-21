<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Create
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function create_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'create_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function create_body_classes( $classes ) {
	global $post;

	$layout = create_get_theme_layout();

	$classes[] = $layout;

	//Masonry and default layout for all pages other than singular
    if ( 'no-sidebar-full-width' == $layout && ! is_singular() && ! is_404() ) {
		$classes[] = 'create-masonry';
    }

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'create_body_classes' );


if ( ! function_exists( 'create_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Create 1.0
	 */
	function create_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$length	= get_theme_mod( 'excerpt_length', create_get_default_theme_options( 'excerpt_length' ) );
		return $length;
	}
endif; //create_excerpt_length
add_filter( 'excerpt_length', 'create_excerpt_length', 999 );


if ( ! function_exists( 'create_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Create 1.0
	 */
	function create_continue_reading() {
		// Getting data from Customizer Options
		$more_tag_text	= get_theme_mod( 'excerpt_more_text', create_get_default_theme_options( 'excerpt_more_text' ) );

		return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' .  $more_tag_text . '</a>';
	}
endif; //create_continue_reading
add_filter( 'excerpt_more', 'create_continue_reading' );

if ( ! function_exists( 'create_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function create_page_post_meta() {
		$create_page_post_meta = '<span class="post-time">' . __( 'Posted on', 'create' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
		$create_page_post_meta .= '<span class="post-author">' . __( 'By', 'create' ) . ' <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="View all posts by ' . esc_attr( get_the_author() ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span>';

		return $create_page_post_meta;
	} //create_page_post_meta
endif;

if ( ! function_exists( 'create_seperator' ) ) :
	/**
	 * Return the first image in a post. Works inside a loop.
	 * @param [integer] $post_id [Post or page id]
	 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
	 * @param [string/array] $attr Query string or array of attributes.
	 * @return [string] image html
	 *
	 * @since Create 1.2
	 */
	function create_get_first_image( $postID, $size, $attr ) {
		ob_start();

		ob_end_clean();

		$image 	= '';

		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

		if( isset( $matches [1] [0] ) ) {
			//Get first image
			$first_img = $matches [1] [0];

			return '<img class="pngfix wp-post-image" src="'. $first_img .'">';
		}

		return false;
	} //create_get_first_image
endif;

if ( ! function_exists( 'create_custom_css' ) ) :
	/**
	 * Enqueue Custom CSS
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Create 1.4
	 */
	function create_custom_css() {
		if( $create_custom_css = get_theme_mod( 'custom_css' ) ) {
			echo '<!-- refreshing cache -->' . "\n";

			echo '<!-- '.get_bloginfo('name').' inline CSS Styles from Studio Custom CSS option-->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $create_custom_css;

			echo '</style>' . "\n";
		}
	}
endif; //create_custom_css
add_action( 'wp_head', 'create_custom_css', 101 );


if ( ! function_exists( 'create_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Create 1.4
	 */
	function create_get_theme_layout() {
		global $post, $wp_query;

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page setting in Reading Settings
		if ( $page_id == $page_for_posts ) {
			$layout 		= get_post_meta( $page_for_posts, 'create-layout-option', true );
		}

		// Settings for page/post/attachment
		if ( is_singular() ) {

			if ( is_attachment() ) {
				$parent 		= $post->post_parent;
				$layout 		= get_post_meta( $parent, 'create-layout-option', true );
			}
			else {
				$layout 		= get_post_meta( $post->ID, 'create-layout-option', true );
			}
		}

		if ( empty( $layout ) || ( !is_page() && !is_single() ) ) {
			$layout = 'default';
		}

		if ( is_home() && is_front_page() ) {
			$layout 	= get_theme_mod( 'homepage_layout', create_get_default_theme_options( 'homepage_layout' ) );
		}

		// Check empty and load default.
		if ( empty( $layout ) || 'default' === $layout ) {
				$layout = get_theme_mod( 'theme_layout', create_get_default_theme_options( 'theme_layout' ) );
		}

	    return $layout;
	}
endif; //create_get_theme_layout

if ( ! function_exists( 'create_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own create_archive_content_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_archive_content_image() {
		$featured_image = get_theme_mod( 'content_layout', create_get_default_theme_options( 'content_layout' ) );

		if ( has_post_thumbnail() && 'full-content' != $featured_image ) {
		?>
			<div class="entry-thumbnail">
				<a rel="bookmark" href="<?php the_permalink(); ?>">
	                <?php
						the_post_thumbnail( 'create-featured' );
					?>
				</a>
	        </div>
	   	<?php
		}
	}
endif; //create_archive_content_image

if ( ! function_exists( 'create_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own create_single_content_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_single_content_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$individual_featured_image = get_post_meta( $parent,'create-featured-image', true );
			} else {
				$individual_featured_image = get_post_meta( $page_id,'create-featured-image', true );
			}
		}

		if( empty( $individual_featured_image ) || ( !is_page() && !is_single() ) ) {
			$individual_featured_image = 'default';
		}

		$featured_image = get_theme_mod( 'single_post_image_layout', create_get_default_theme_options( 'single_post_image_layout' ) );

		if ( ( 'disable' == $individual_featured_image  || '' == get_the_post_thumbnail() || ( $individual_featured_image=='default' && 'disable' == $featured_image ) ) ) {
			return false;
		}
		else {
			if ( 'default' == $individual_featured_image ) {
				$image_class = $featured_image;
			}
			else {
				$image_class = $individual_featured_image;
			}
			?>
			<div class="entry-thumbnail <?php echo $image_class; ?>">
                <?php
				if ( 'featured-image' == $individual_featured_image  || ( $individual_featured_image=='default' && 'featured-image' == $featured_image  ) ) {
					the_post_thumbnail( 'create-single' );
				}
                elseif ( 'large' == $individual_featured_image  || ( $individual_featured_image=='default' && 'large' == $featured_image  ) ) {
                     the_post_thumbnail( 'large' );
                }
				else {
					the_post_thumbnail( 'full' );
				} ?>
	        </div><!-- .entry-thumbnail -->
	   	<?php
		}
	}
endif; //create_single_content_image


if ( ! function_exists( 'create_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action create_footer action
	 */
	function create_scrollup() {
		$disable_scrollup = get_theme_mod( 'disable_scrollup', create_get_default_theme_options( 'disable_scrollup' ) );
		if ( '1' != $disable_scrollup ) {
			echo '<a href="#masthead" id="scrollup" class="fa"><span class="screen-reader-text">' . __( 'Scroll Up', 'create' ) . '</span></a>' ;
		}
	}
}
add_action( 'create_footer', 'create_scrollup', 110 );

/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Create 1.4
 */
function create_alter_home( $query ){
	if( $query->is_main_query() && $query->is_home() ) {
		$cats = get_theme_mod( 'front_page_category', create_get_default_theme_options( 'front_page_category' ) );

		if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','create_alter_home' );
