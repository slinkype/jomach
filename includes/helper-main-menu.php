<?php
$header_class = is_singular() && get_post_meta( get_the_ID(), "header_color", true ) ? get_post_meta( get_the_ID(), "header_color", true ) : ""; 
$header_class = apply_filters( 'avf_header_class_filter', $header_class );
?>

<div class="header <?php echo $header_class; ?>">
	<div class="top-menu">
		<div class="top-menu-inner">
            <div class="location">
            <i class="av-icon-char" 
               style="font-family: 'jomach-icons-v1';">
               &#xe813;
            </i>   
            Av. Domingo Cueto Mz A5 Lt5 (Asociación AES), Punta Hermosa, Lima</div>
			
			<div class="header-contact-info">
			   <div class="phone">
                  <i class="av-icon-char" 
                  style="font-family: 'jomach-icons-v1';">
                  &#xe814;
               </i>   
					  <?php echo avia_get_option( 'phone' ); ?>
				  </div>
			   <a class="email" href="mailto:ventas@jomach.pe">
               <i class="av-icon-char" 
               style="font-family: 'jomach-icons-v1';">
               &#xe812;
            </i>   
               ventas@jomach.pe</a>
			</div>
		</div>
	</div>
	<div class="header-inner">
		<div class="header-logo">
			<?php echo enfold_child_logo( true ); ?>
		</div>
		<div class="header-menu">
			<?php
				$args = array(
					'items_wrap'        => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
					'theme_location'	=> 'avia',
					'menu_id' 			=> '',
					'menu_class'		=> 'main-menu',
					'container_class'	=> '',
					'fallback_cb' 		=> 'avia_fallback_menu',
					'walker' 			=> new avia_responsive_mega_menu()
				);
				wp_nav_menu( $args );
			?>
         	<div class="header-search-container">
					<a class="header-search-button" href="=?s"></a>
					<button class="header-search-toggle"></button>
					<div class="header-search-form">
						<?php get_search_form(); ?>
					</div>
				</div>
		</div>
		<button class="hamburger-toggle" aria-label="Mobile Menu Toggle">
			<div class="burger-box"></div>
		</button>
	</div>
	<div class="hamburger-overlay"></div>
	<div class="hamburger-content">
		<div class="hamburger-content-inner">
			<?php
				$args = array(
					'items_wrap'        => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
					'theme_location'	=> 'avia',
					'menu_id' 			=> '',
					'menu_class'		=> 'main-menu',
					'container_class'	=> '',
					'fallback_cb' 		=> 'avia_fallback_menu',
					'walker' 			=> new avia_responsive_mega_menu()
				);
				wp_nav_menu( $args );
			?>
		</div>
	</div>
</div>