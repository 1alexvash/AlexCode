<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<li id="post-<?php the_ID(); ?>" class="search-entry">
	<a class="thumbnail" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'thumbnail', '' ); ?>
	</a>
	<div class="inner">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
		<?php the_tags( '<div class="tags">', PHP_EOL, '</div>' ); ?>
	</div>
</li>