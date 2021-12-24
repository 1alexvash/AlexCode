<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<li id="post-<?php the_ID(); ?>" <?php post_class( '', null ); ?> >
	<div class="posts-list-block">
		<div class="content">
			<a href="<?php the_permalink(); ?>" class="post-img">
				<?php the_post_thumbnail( 'post-img', '' ); ?>
			</a>
			<?php the_tags( '<div class="tags">', PHP_EOL, '</div>' ); ?>
			<a href="<?php the_permalink(); ?>" class="link"><?php the_title( '', '', true ); ?></a>
		</div>
	</div>
</li>