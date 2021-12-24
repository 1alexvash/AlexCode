<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


get_header();

get_theme_mod( 'sectionintrousedby' ) && get_template_part( 'parts/section', 'intro' );

$tags_ids = wp_parse_id_list( get_theme_mod( 'archivetags' ) );

$tags = empty( $tags_ids ) ? false : get_terms( [
	'include' => $tags_ids,
	'taxonomy'   => 'post_tag',
	'hide_empty' => true,
	'fields'     => 'id=>name',
] );

$queried_object = get_queried_object();
$current_tag_id = isset( $queried_object->term_id ) ? $queried_object->term_id : 0;

?>

<!-- posts-list -->
<section class="simple-section">

	<h2 class="sr-only"><?php the_archive_title( '', '' ); ?></h2>

	<div class="container">

		<?php if ( is_array( $tags ) && ! empty( $tags ) ) : ?>
			<ul class="filter-tags-list">
				<li>
					<a
						href="<?php echo home_url( '/', null ) ?>"
						<?php if ( 0 == $current_tag_id ) : ?> class="active" <?php endif; ?>
					>
						<?php _e( 'Все', ALEXCODETH_TEXTDOMAIN ); ?>
					</a>
				</li>
				<?php foreach ( $tags as $tag_id => $name ) : ?>
					<li>
						<a
							<?php if ( $tag_id == $current_tag_id ) : ?> class="active" <?php endif; ?>
							href="<?php echo get_term_link( $tag_id, 'post_tag' ); ?>"
						>
							<?php echo $name; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<ul class="posts-list">
				
				<?php while ( have_posts() ) : the_post(); include get_theme_file_path( 'views/entry-archive.php' ); endwhile; ?>
				
			</ul>

			<?php
				the_posts_pagination( [
					'prev_next' => false,
					'prev_text' => '',
					'next_text' => '',
					'show_all'  => false,
					'end_size'  => 0,
					'mid_size'  => 2,
				] );
			?>

		<?php else : echo wpautop( get_theme_mod( 'archivenoposts' ) ); endif; ?>

	</div>
</section>

<?php

get_footer();