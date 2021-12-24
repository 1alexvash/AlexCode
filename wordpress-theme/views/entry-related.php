<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<div id="post-<?php the_ID(); ?>" <?php post_class( 'related-posts-block' ); ?> >
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="image">
			<?php the_post_thumbnail( 'post-img', '' ); ?>
		</a>
	<?php endif; ?>
	<div class="inner">
		<a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a>
		<?php the_tags( '<div class="tags">', '', $after = '</div>' ) ?>
	</div>
</div>