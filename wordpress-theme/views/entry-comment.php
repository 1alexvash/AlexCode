<?php


namespace alexcodeth;


use WP_Comment;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<div class="comments-block" id="comment-<?php comment_ID() ?>">
	<div class="inner">
		<div class="top">
			<div class="name"><?php comment_author(); ?></div>
			<div class="date"><?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ); ?></div>
		</div>
		<div class="text">
			<?php comment_text(); ?>
		</div>
		<div class="bottom">
			<?php comment_reply_link( [], null, null ); ?>
		</div>
	</div>