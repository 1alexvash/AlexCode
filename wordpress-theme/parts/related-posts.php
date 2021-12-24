<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


global $post;

$posts = get_posts( [
	'post_type'   => 'post',
	'numberposts' => 13,
	'exclude'     => [ get_the_ID() ],
] )


?>


<?php if ( is_array( $posts ) && ! empty( $posts ) ) : ?>
	<div class="related-posts">
		<h2><?php _e( 'Related posts', ALEXCODETH_TEXTDOMAIN ); ?></h2>

		<?php foreach ( $posts as $post ) : setup_postdata( $post ); include get_theme_file_path( 'views/entry-related.php' ); endforeach; ?>

		<?php wp_reset_postdata(); ?>

		<a href="<?php echo home_url( '/' ); ?>" class="btn"><?php _e( 'See all posts', ALEXCODETH_TEXTDOMAIN ); ?></a>

	</div>
<?php endif; ?>