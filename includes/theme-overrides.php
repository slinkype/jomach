<?php


/**
 * Enable ALB for All Post Types
 */
function enfold_child_enable_alb_for_cpts() {
	return array( 'portfolio', 'page', 'product', 'template_part', 'tribe_events', 'post' );
}
add_filter( 'avf_alb_supported_post_types', 'enfold_child_enable_alb_for_cpts' );

/**
 * Enable Gutenberg per post type
 */
function enfold_child_gutenberg( $new_use_block_editor, $use_block_editor, $post_type ) {
	$gutenberg_post_types = array( 'post' );

	return in_array( $post_type, $gutenberg_post_types ) ? true : false;
}
add_filter( 'avf_can_use_block_editor_for_post_type', 'enfold_child_gutenberg', 100, 3 );

/**
 * Default Icons Hook
 */
function enfold_child_default_icons( $icons ) {
	$icons['next'] = array( 'font' => 'fa-fontello', 'icon' => 'ue800' );
    $icons['prev'] = array( 'font' => 'fa-fontello', 'icon' => 'ue800' );
    $icons['next_big'] = array( 'font' => 'fa-fontello', 'icon' => 'ue800' );
    $icons['prev_big'] = array( 'font' => 'fa-fontello', 'icon' => 'ue800' );
	$icons['close'] = array( 'font' => 'fa-fontello', 'icon' => 'ue801' );

	return $icons;
}
add_filter( 'avf_default_icons', 'enfold_child_default_icons', 10, 1 );

/**
 * Disables Enfold Burger addition to nav
 */
if( !function_exists( 'avia_append_burger_menu' ) ) {
	add_filter( 'wp_nav_menu_items', 'avia_append_burger_menu', 9998, 2 );
	add_filter( 'avf_fallback_menu_items', 'avia_append_burger_menu', 9998, 2 );
	function avia_append_burger_menu ( $items , $args ) {
		return $items;
	}
}

/**
 * Disables Enfold Search addition to nav
 */
if( !function_exists( 'avia_append_search_nav' ) ) {
	add_filter( 'wp_nav_menu_items', 'avia_append_search_nav', 9997, 2 );
	add_filter( 'avf_fallback_menu_items', 'avia_append_search_nav', 9997, 2 );
	function avia_append_search_nav ( $items, $args ) {
	    return $items;
	}
}

/**
 * Disables Enfold Avia Title + Breadcrumbs
 */
if( !function_exists( 'avia_title' ) ) {
	function avia_title() {}
}

/**
 * Disables Enfold Post Navigation
 */
if( !function_exists( 'avia_post_nav' ) ) {
	function avia_post_nav() {}
}

/**
 * Disable Hide Featured Image Meta
 */
if( !function_exists( 'avia_add_hide_featured_image_select' ) ) {
	function avia_add_hide_featured_image_select() {}
}

/**
 * Disable enfold query overrides on archive view
 */
if( ! function_exists( 'avia_fix_tag_archive_page' ) ) {
	function avia_fix_tag_archive_page() {}
}

/**
 * Disable Image Sizes
 * This hook will disable Enfold image sizes
 */
function enfold_child_disable_image_sizes() {
	remove_image_size( '1536x1536' );	
	remove_image_size( '2048x2048' );
}
add_action( 'init', 'enfold_child_disable_image_sizes', 11 );