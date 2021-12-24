<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


get_header();


get_template_part( 'parts/breadcrumbs' );


?>


<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- blogpost-section -->
		<section class="blogpost-section">
			<div class="container">
				<div class="blogpost-outer">

					<?php get_template_part( 'parts/related-posts' ); ?>

					<article class="blogpost-content">

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="blogpost-image">
								<?php the_post_thumbnail( 'blogpost-image', '' ); ?>
							</div>
						<?php endif; ?>
						
						<div class="blogpost-date">
							<time datetime="<?php the_time( 'c' ); ?>">
								<?php the_time( get_option( 'date_format', 'j F Y' ) ); ?>
								<?php the_time( get_option( 'time_format', 'j F Y' ) ); ?>
							</time>
						</div>
						
						<h1><?php the_title(); ?></h1>
						
						<?php the_tags( '<div class="tags">', '', '</div>' ); ?>
						
						<?php the_content(); ?>

						<?php wp_link_pages(); ?>

						<?php get_template_part( 'parts/blogpost-options' ); ?>

					</article>

				</div>
			</div>
		</section>

		<?php if ( is_single() ) : comments_template(); endif; ?>

	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer();