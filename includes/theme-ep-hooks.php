<?php

/**
 * Overrides Enfold Plus ALB Tab Name
 */
function enfold_child_tab_name(){
	return SITE_NAME;
}
add_filter( 'avf_ep_tab_name', 'enfold_child_tab_name', 1 );

/**
 * Button Styles
 * This hook will add/remove button color options on Buttons and Button Group
 */
function enfold_child_avf_button_colors( $options ) {
	$options = array(
		'Primary' => 'primary',
		'Secondary' => 'secondary',
		'Tertiary' => 'tertiary'
	);

	return $options;
}
add_filter( 'avf_ep_buttons_color_options', 'enfold_child_avf_button_colors', 10, 1 );

function enfold_child_avf_button_color_default( $option ) {
	$option = 'large';

	return $option;
}
add_filter( 'avf_ep_buttons_size_std', 'enfold_child_avf_button_color_default', 10, 1 );

function enfold_child_avf_button_size_options( $options ) {
	$options = array(
		'Small' => 'small',
		'Medium' => 'medium',
		'Large' => 'large'
	);

	return $options;
}
add_filter( 'avf_ep_buttons_size_options', 'enfold_child_avf_button_size_options', 10, 1 );

/**
 * Overrides Enfold Plus Post Grid Template inclusion
 */
function enfold_child_posts_template_override( $template, $post_type, $post_id, $meta ){
	/**
	 * Default template override
	 */
	$post_template = THEME_INCLUDES . "loop-content-" . $post_type . ".php";
	if( file_exists( $post_template ) ) $template = $post_template;

	/**
	 * Other Usages
	 */
	/* 
	if( $meta['ep_class'] == 'custom_style' ) {
		$template = THEME_INCLUDES . "loop-content-custom-style-" . $post_type . ".php";
	}
	*/

	/*
	if( in_array( $post_type, array( 'post', 'news' ) ) ) {
		$template = THEME_INCLUDES . "loop-content-common.php";
	} 
	*/

	return $template;
}
add_filter( 'avf_ep_post_grid_post_template', 'enfold_child_posts_template_override', 10, 4 );
add_filter( 'avf_ep_post_slider_post_template', 'enfold_child_posts_template_override', 10, 4 );

/**
 * Overrides Enfold Plus Content Slider Template inclusion
 */
function enfold_child_slider_slide_template_override( $template, $atts, $meta ){
	/*
	if( strpos( $meta['custom_class'], 'custom' ) !== false ){
		$template = THEME_INCLUDES . "content-slider-custom.php";
	}
	*/

	return $template;
}
add_filter( 'avf_ep_content_slider_slide_template', 'enfold_child_slider_slide_template_override', 10, 3 );

/**
 * Overrides Enfold Plus Item Grid Template inclusion
 */
function enfold_child_item_grid_item_override( $template, $atts, $meta ){

	/*
	if( strpos( $meta['custom_class'], 'custom' ) !== false ){
		$template = THEME_INCLUDES . "item-grid-custom.php";
	}
	*/

	return $template;
}
add_filter( 'avf_ep_item_grid_item_template', 'enfold_child_item_grid_item_override', 10, 3 );

/**
 * Tab Slider Overrides
 */
function enfold_child_tab_slider_options( $options ) {
	
	/*
	$options[] = array(
		"name" 	=> __( "New option", 'avia_framework' ),
		"desc" 	=> __( "new option", 'avia_framework' ),
		"id" 	=> "new_option",
		"std" 	=> "",
		"type" 	=> "input"
	);
	*/
	
	return $options;
}
add_filter( 'avf_ep_tab_slider_options', 'enfold_child_tab_slider_options' );

function enfold_child_ig_options( $options ) {
	
	/*
	$options[] = array(	
		'name' 	=> __( 'Is Card Grid', 'avia_framework' ),
		'desc' 	=> __( 'Check to only display icon on hover', 'avia_framework' ),
		'id' 	=> 'icon_hover',
		'type' 	=> 'checkbox',
		'std' 	=> '',
		'lockable' => true,
	);

	$options[] = array(
		"name" 	=> __( "New option", 'avia_framework' ),
		"desc" 	=> __( "new option", 'avia_framework' ),
		"id" 	=> "new_option",
		"std" 	=> "",
		"type" 	=> "input",
		'required'	=> array( 'icon_hover', 'not', '' )
	);
	*/
	
	return $options;
}
add_filter( 'avf_ep_item_grid_item_options', 'enfold_child_ig_options' );

function enfold_child_tab_slider_control_override( $template, $atts, $meta ){
	/*
	if( $meta['ep_class'] == 'tabslider--simple' ) {
		$template = THEME_INCLUDES . "avia-shortcodes/tab_slider/tabslider--custom-control.php";
	}
	*/

	return $template;
}
add_filter( 'avf_ep_tab_slider_control_template', 'enfold_child_tab_slider_control_override', 10, 3 );

function enfold_child_tab_slider_slide_override( $template, $atts, $meta ){
	/*
	if( $meta['ep_class'] == 'tabslider--simple' ) {
		$template = THEME_INCLUDES . "avia-shortcodes/tab_slider/tabslider--custom-slide.php";
	}
	*/

	return $template;
}
add_filter( 'avf_ep_tab_slider_slide_template', 'enfold_child_tab_slider_slide_override', 10, 3 );

/**
 * Removes default heading font size
 */
function enfold_child_subheading_default_size( $heading ) {
	return '';
}
add_filter( 'avf_ep_subheading_default_size', 'enfold_child_subheading_default_size' );