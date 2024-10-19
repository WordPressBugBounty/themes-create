<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Create Pro
 */

$create_layout = create_get_theme_layout();

if ( 'left-sidebar' == $create_layout ) { ?>

	<div id="secondary" class="widget-area" role="complementary">
		<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) {
        	dynamic_sidebar( 'sidebar-1' );
   		}
		else { ?>
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'create' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

		<?php
		} // end sidebar widget area ?>
	</div><!-- #secondary .widget-area -->

	<?php
}
