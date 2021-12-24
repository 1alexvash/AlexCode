<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<!DOCTYPE HTML>

<html <?php language_attributes(); ?> >

<?php get_template_part( 'parts/head' ); ?>

	<body <?php body_class(); ?>>
		
		<div class="wrapper">
			
			<!--header-->
			<header id="header" class="header">
				<div class="container">

					<div class="header-content-mobile">
						<?php the_custom_logo(); ?>
						<div id="header-buter" class="header-buter">
							<img width="34" height="22" class="buter" src="<?php echo get_theme_file_uri( 'images/buter.svg' ); ?>" alt="<?php esc_attr_e( 'Buter icon', ALEXCODETH_TEXTDOMAIN ); ?>">
						</div>
					</div>

					<div class="header-content">
						<div class="tob-block">
							<?php the_custom_logo(); ?>
							<div id="header-close" class="header-close">
								<img class="close" src="<?php echo get_theme_file_uri( 'images/close.svg' ); ?>" alt="<?php esc_attr_e( 'Close icon', ALEXCODETH_TEXTDOMAIN ); ?>">
							</div>
						</div>
						<?php
							get_search_form( true );
							wp_nav_menu( [
								'theme_location'  => 'main',
								'menu'            => 'main',
								'container'       => false,
								'menu_id'         => 'header-menu',
								'menu_class'      => 'header-menu',
								'echo'            => true,
								'depth'           => 1,
								'fallback_cb'     => '',
							] );
							get_theme_mod( 'headersocialsusedby' ) && get_template_part( 'parts/socials' );
						?>
						<?php if ( ! wp_is_mobile() ) : ?>
							<button id="search-toggle" class="search-toggle"><span class="sr-only">Поиск</span></button>
							<div id="search-modal" class="search-modal">
								<div class="container">
									<?php get_search_form( true ); ?>
									<ul id="search-list" class="search-list hide"></ul>
								</div>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</header>
			<!--//header-->

			<!--main-content-->
			<div class="main-content">