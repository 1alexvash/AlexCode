<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


$footer_logo_src = get_theme_mod( 'footerlogosrc' );
$footer_logo_id = is_url( $footer_logo_src ) ? attachment_url_to_postid( removing_image_size_from_url( $footer_logo_src ) ) : 0;


?>


			</div>
			<!--//main-content-->

			<footer class="footer">
				<div class="container">
					<div class="footer-content">

						<?php if ( $footer_logo_id ) : ?>
							<div id="footer-logo" class="footer-logo">
								<?php echo wp_get_attachment_image( $footer_logo_id, 'medium', false, '' ); ?>
							</div>
						<?php endif; ?>
						
						<?php get_theme_mod( 'footersocialsusedby' ) && get_template_part( 'parts/socials' ); ?>
						
						<div class="copyright">
							<span id="copyright-name"><?php printf( get_theme_mod( 'footercopyname' ), date( 'Y' ) ); ?></span>
							<span class="divider">|</span>
							<span id="copyright-desc"><?php echo get_theme_mod( 'footercopydesc' ); ?></span>
						</div>

					</div>
				</div>
			</footer>

		</div>
		
		<?php wp_footer(); ?>

	</body>
</html>