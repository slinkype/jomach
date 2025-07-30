<?php

/**
 * Debug mode
 */
function enfold_child_debug_mode(){
	return THEME_ENV == "dev" ? "debug" : "";
}
add_action( 'avia_builder_mode', 'enfold_child_debug_mode' );

/**
 * BE Media from production hook, needed for local dev
 */
function enfold_child_prefix_production_url( $url ) {
	return REMOTE_URL;
}
add_filter( 'be_media_from_production_url', 'enfold_child_prefix_production_url' );

/**
 * Google Fonts Hook
 */
function enfold_child_custom_google_fonts( $fonts ){
	// $fonts["Roboto"] = "Roboto:300,400,700";
	return $fonts;  
}
add_filter( 'avf_google_heading_font', 'enfold_child_custom_google_fonts', 10, 2 );
add_filter( 'avf_google_content_font', 'enfold_child_custom_google_fonts', 10, 2 );

/**
 * Avia Shortcodes Hook
 */
function enfold_child_shortcodes( $paths ) {
	/* Note: if using a table.php replacement, you may want to run this at 20 priority so it loads before Enfold plus */
	$child_path = THEME_INCLUDES . "avia-shortcodes/";
	array_unshift( $paths, $child_path );

	return $paths;
}
add_filter( 'avia_load_shortcodes', 'enfold_child_shortcodes', 21, 1 );

/**
 * Hook into Sidebar options for custom header options
 */
function enfold_child_layout_elements( array $elements ) {
	foreach( $elements as $key => $element ) {

		switch($element['id']){
			case 'layout':
			case 'sidebar':
			case 'header_title_bar':
			case 'header_transparency':
			unset( $elements[$key] );
			break;
		}

	}

	$elements[] = array(
		"slug"  => "layout",
		"name"  => __( "Header Coloring",'avia_framework' ),
		"id"    => "header_color",
		"desc"  => "Set header style for this Page",
		"type"  => "select",
		"std"   => "",
		"class" => "avia-style",
		"subtype" => array( 
							__( "Default", 'avia_framework' ) => '',
							__( "Alternate", 'avia_framework' ) => 'is-alternate',

				)
		);

	return $elements;
}
add_filter( 'avf_builder_elements', 'enfold_child_layout_elements', 10001, 1 );


/** 
 * Replaces href value on Menu items linking to # in with javascript:void(0)
 */
function enfold_child_menu_items_replace_hash( $item_output, $menu_item ) {
	// Ignore non-link items
	if ( strpos( $item_output, '<a ') === false ) {
		return $item_output;
	}

	$item_output = str_replace( '<a', '<a class="menu-item-inner"', $item_output );

	if ( strpos( $item_output, 'href="' ) === false || strpos( $item_output, 'href="#"' ) !== false ) {
		$item_output = str_replace( '<a class="menu-item-inner"', '<span class="menu-item-inner"', $item_output );
		$item_output = str_replace( 'href="#"', '', $item_output );
		$item_output = str_replace( '</a', '</span', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'enfold_child_menu_items_replace_hash', 999, 2 );

function enfold_child_theme_opts_colors_ouput(){
	global $avia_config;
	$avia_config['backend_colors'];

	echo '<style>';
	foreach( $avia_config['backend_colors']['color_set'] as $parent_key => $value ){

		if( $parent_key == 'socket_color' ){ 
			continue;
		}

		$final_key = "";

		switch( $parent_key ){
			case 'main_color':
				$final_key = ":root";
				$wanted_keys = array( 'bg', 'bg2', 'primary', 'secondary', 'color', 'meta', 'heading', 'border' );
				break;
			case 'alternate_color':
				$final_key = ".alternate_color";
				$wanted_keys = array( 'bg', 'bg2', 'primary', 'secondary', 'color', 'meta' );
				break;
			case 'header_color':
				$final_key = ".header";
				$wanted_keys = array( 'bg', 'bg2', 'primary', 'secondary', 'color', 'meta' );
				break;
			case 'footer_color':
				$final_key = ".footer-section";
				$wanted_keys = array( 'bg', 'bg2', 'primary', 'secondary', 'color', 'meta' );
				break;
			default:
				$final_key = '';
				$wanted_keys = array( 'bg', 'bg2', 'primary', 'secondary', 'color', 'meta' );
				break;
		}

		echo $final_key .'{';
		foreach( $value as $key => $value ){
			if( in_array( $key, $wanted_keys ) ){
				$final_key = '';
				$color_number = null;
				
				switch( $key ){
					case 'bg':
						$final_key = 'primaryBgColor';
						$color_number = '1';
						break;
					case 'bg2':
						$final_key = 'altBgColor';
						break;
					case 'primary':
						$final_key = 'primaryColor';
						$color_number = '2';
						break;
					case 'secondary':
						$final_key = 'altColor';
						$color_number = '3';
						break;
					case 'color':
						$final_key = 'textColor';
						$color_number = '4';
						break;
					case 'meta':
						$final_key = 'altTextColor';
						break;
					case 'heading':
						$final_key = 'headingColor';
						break;
					case 'border':
						$final_key = 'altHeadingColor';
						break;
				}

				echo '
					--'. $final_key . ': '. $value .';';
				
				// Add generic numbered colors only for main_color and only for basic colors
				if($parent_key === 'main_color' && $color_number !== null) {
					echo '
					--color'. $color_number . ': '. $value .';';
				}
			}
		}

		echo '}';
	}
	echo '</style>';
}
add_action( 'wp_head', 'enfold_child_theme_opts_colors_ouput', 100 );

/**
 * Misc Hooks
 */
function enfold_child_upload_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['json'] = 'application/json';
	return $mimes;
}
add_filter( 'upload_mimes', 'enfold_child_upload_mimes' );

function enfold_child_wp_responsive_images() {
	return 1;
}
add_filter( 'max_srcset_image_width', 'enfold_child_wp_responsive_images' );


add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );