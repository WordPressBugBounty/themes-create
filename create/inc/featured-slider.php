<?php
/**
 * The template for displaying the Slider
 *
 * @package Catch Themes
 * @subpackage Create Pro
 * @since Create 1.2
 */

if( !function_exists( 'create_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook create_before_content.
 *
 * @since Create 1.2
 */
function create_featured_slider() {
	global $post, $wp_query;
	//create_flush_transients();

	// get data value from options
	$enableslider	= get_theme_mod( 'featured_slider_option', create_get_default_theme_options( 'featured_slider_option' ) );
	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	if ( 'entire-site' == $enableslider  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enableslider  ) ) {
		echo '<!-- refreshing cache -->';
		$sliderselect                     = get_theme_mod( 'featured_slider_type', create_get_default_theme_options( 'featured_slider_type' ) );
		$imageloader                      = get_theme_mod( 'featured_slider_image_loader', create_get_default_theme_options( 'featured_slider_image_loader' ) );
		$featured_slide_transition_effect = get_theme_mod( 'featured_slide_transition_effect', create_get_default_theme_options( 'featured_slide_transition_effect' ) );
		$featured_slide_transition_length = get_theme_mod( 'featured_slide_transition_length', create_get_default_theme_options( 'featured_slide_transition_length' ) );
		$featured_slide_transition_delay  = get_theme_mod( 'featured_slide_transition_delay', create_get_default_theme_options( 'featured_slide_transition_delay' ) );
		$create_featured_slider = '
			<div id="feature-slider">
				<div class="wrapper">
					<div class="cycle-slideshow"
					    data-cycle-log="false"
					    data-cycle-pause-on-hover="true"
					    data-cycle-swipe="true"
					    data-cycle-auto-height=container
					    data-cycle-fx="'. esc_attr( $featured_slide_transition_effect ) .'"
						data-cycle-speed="'. esc_attr( $featured_slide_transition_length ) * 1000 .'"
						data-cycle-timeout="'. esc_attr( $featured_slide_transition_delay ) * 1000 .'"
						data-cycle-loader="'. esc_attr( $imageloader ) .'"
						data-cycle-slides="> article"
						>

					    <!-- prev/next links -->
					    <div class="cycle-prev"></div>
					    <div class="cycle-next"></div>

					    <!-- empty element for pager links -->
    					<div class="cycle-pager"></div>';

						// Select Slider
						if ( 'demo-featured-slider' == $sliderselect  && function_exists( 'create_demo_slider' ) ) {
							$create_featured_slider .=  create_demo_slider();
						}
						elseif ( 'featured-page-slider' == $sliderselect  && function_exists( 'create_page_slider' ) ) {
							$create_featured_slider .=  create_page_slider();
						}

		$create_featured_slider .= '
					</div><!-- .cycle-slideshow -->
				</div><!-- .wrapper -->
			</div><!-- #feature-slider -->';
		echo $create_featured_slider;
	}
}
endif;
add_action( 'create_after_header', 'create_featured_slider', 10 );


if ( ! function_exists( 'create_demo_slider' ) ) :
/**
 * This function to display featured posts slider
 *
 * @get the data value from customizer options
 *
 * @since Create 1.2
 *
 */
function create_demo_slider() {
	$create_demo_slider ='
						<article class="post demo-image-1 hentry slides displayblock">
							<figure class="slider-image">
								<a title="Slider Image 1" href="'. esc_url( home_url( '/' ) ) .'">
									<img src="'.esc_url( get_template_directory_uri() ). '/images/gallery/no-featured-image-1200x514.jpg" class="wp-post-image" alt="Slider Image 1" title="Slider Image 1">
								</a>
							</figure>
							<div class="entry-container">
								<header class="entry-header">
									<h2 class="entry-title">
										<a title="Slider Image 1" href="#"><span>Slider Image 1</span></a>
									</h2>
									<div class="screen-reader-text"><span class="post-time">Posted on <time pubdate="" datetime="2014-08-16T10:56:23+00:00" class="entry-date updated">16 August, 2014</time></span><span class="post-author">By <span class="author vcard"><a rel="author" title="View all posts by Catch Themes" href="https://catchthemes.com/blog/" class="url fn n">Catch Themes</a></span></span></div>
								</header>
								<div class="entry-content">
									<p>Slider Image 1 Content</p>
								</div>
							</div>
						</article><!-- .slides -->

						<article class="post demo-image-2 hentry slides displaynone">
							<figure class="Slider Image 2">
								<a title="Slider Image 2" href="'. esc_url( home_url( '/' ) ) .'">
									<img src="'. trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'images/gallery/no-featured-image-1200x514.jpg" class="wp-post-image" alt="Slider Image 2" title="Slider Image 2">
								</a>
							</figure>
							<div class="entry-container">
								<header class="entry-header">
									<h2 class="entry-title">
										<a title="Slider Image 2" href="#"><span>Slider Image 2</span></a>
									</h2>
									<div class="screen-reader-text"><span class="post-time">Posted on <time pubdate="" datetime="2014-08-16T10:56:23+00:00" class="entry-date updated">16 August, 2014</time></span><span class="post-author">By <span class="author vcard"><a rel="author" title="View all posts by Catch Themes" href="https://catchthemes.com/blog/" class="url fn n">Catch Themes</a></span></span></div>
								</header>
								<div class="entry-content">
									<p>Slider Image 2 Content</p>
								</div>
							</div>
						</article><!-- .slides --> ';
	return $create_demo_slider;
}
endif; // create_demo_slider

if ( ! function_exists( 'create_page_slider' ) ) :
/**
 * This function to display featured page slider
 *
 * @since Create 1.2
 */
function create_page_slider() {
	$quantity	= get_theme_mod( 'featured_slide_number', create_get_default_theme_options( 'featured_slide_number' ) );

    global $post;

    $create_page_slider = '';
    $number_of_page 	= 0; 		// for number of pages
	$page_list			= array();	// list of valid page ids

	//Get number of valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( get_theme_mod( 'featured_slider_page_' . $i ) && get_theme_mod( 'featured_slider_page_' . $i ) > 0 ){
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( get_theme_mod( 'featured_slider_page_' . $i ) ) );
		}

	}

	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$loop = new WP_Query( array(
			'posts_per_page'	=> $quantity,
			'post_type'			=> 'page',
			'post__in'			=> $page_list,
			'orderby' 			=> 'post__in'
		));
		$i=0;

		while ( $loop->have_posts()) : $loop->the_post(); $i++;
			$title_attribute = the_title_attribute( 'echo=0' );
			$excerpt = get_the_excerpt();
			if ( $i == 1 ) { $classes = 'page post-'.$post->ID.' hentry slides displayblock'; } else { $classes = 'page post-'.$post->ID.' hentry slides displaynone'; }
			$create_page_slider .= '
			<article class="'.$classes.'">
				<figure class="slider-image">';
				if ( has_post_thumbnail() ) {
					$create_page_slider .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. get_the_post_thumbnail( $post->ID, 'create_slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-page-image', 'loading' => false ) ).'
					</a>';
				}
				else {
					//Default value if there is no first image
					$create_image = '<img class="pngfix wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/gallery/no-featured-image-1200x514.jpg" >';

					//Get the first image in page, returns false if there is no image
					$create_first_image = create_get_first_image( $post->ID, 'medium', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-page-image' ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $create_first_image ) {
						$create_image =	$create_first_image;
					}

					$create_page_slider .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. $create_image .'
					</a>';
				}

				$create_page_slider .= '
				</figure><!-- .slider-image -->
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
						</h2>
						<div class="screen-reader-text">'.create_page_post_meta().'</div>
					</header>';
					if( $excerpt !='') {
						$create_page_slider .= '<div class="entry-content">'. $excerpt.'</div>';
					}
					$create_page_slider .= '
				</div><!-- .entry-container -->
			</article><!-- .slides -->';
		endwhile;

		wp_reset_postdata();
  	}
	return $create_page_slider;
}
endif; // create_page_slider
