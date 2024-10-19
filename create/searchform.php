<?php
/**
 * The template for displaying search form
 *
 * @package Catch Themes
 * @subpackage Create
 * @since Create 1.4
 */
?>

<?php $search_text 	= get_theme_mod( 'search_text', create_get_default_theme_options( 'search_text' ) ); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'create' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'create' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'create' ); ?>">
</form>
