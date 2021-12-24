<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


get_header();

?>

<!-- posts-list -->
<section class="simple-section">

	<div class="container">

		<h1><?php _e( 'Результаты поиска', ALEXCODETH_TEXTDOMAIN ); ?></h1>

		<div class="result">
			<span class="label"><?php esc_html_e( 'Всего найдено:', ALEXCODETH_TEXTDOMAIN ); ?></span>
			<span class="value"><?php echo absint( $wp_query->post_count ); ?></span>
		</div>
		
		<?php if ( have_posts() ) : ?>

			<h2 class="sr-only"><?php _e( 'Список постов', ALEXCODETH_TEXTDOMAIN ); ?></h2>

			<ul class="search-list">
				
				<?php while ( have_posts() ) : the_post(); include get_theme_file_path( 'views/entry-search.php' ); endwhile; ?>
				
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