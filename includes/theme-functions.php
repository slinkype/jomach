<?php 

function enfold_child_logo( $full = false ) {
	$logo_output = "";

	$logo_output = "<div class='logo-main'>" . wp_get_attachment_image( attachment_url_to_postid( avia_get_option( 'logo' ) ), 'full', false, '' ) . "</div>";
	if( $full ){
		$logo_output .= "<div class='logo-alternate'>" . wp_get_attachment_image( attachment_url_to_postid( avia_get_option( 'alternate_logo' ) ), 'full', false, '' ) . "</div>";
	}

	ob_start();
	?>
	<a href="<?php echo bloginfo( 'url' ); ?>" class="logo aria-label="<?php echo SITE_NAME; ?> Logo">
		<?php echo $logo_output; ?>
    </a>
	<?php
	return ob_get_clean();
}