<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<div class="blogpost-options">
	<button id="share-toggle" class="share hide">
		<img width="17" height="17" src="<?php echo esc_attr( get_theme_file_uri( 'images/share.svg' ) ); ?>" alt="<?php esc_attr_e( 'Share', ALEXCODETH_TEXTDOMAIN ); ?>">
		<?php esc_html_e( 'Share', ALEXCODETH_TEXTDOMAIN ); ?>
	</button>
	<div class="viewed">
		<img width="22" height="22" src="<?php echo esc_attr( get_theme_file_uri( 'images/eye.svg' ) ); ?>" alt="<?php esc_attr_e( 'views', ALEXCODETH_TEXTDOMAIN ); ?>">
		<?php echo max( 1, intval( get_post_meta( get_the_ID(), 'viewed', true ) ) ); ?>
	</div>
	<div class="blogpost-liked">
		<button id="like" href="#" class="like">
			<img width="22" height="22" src="<?php echo esc_attr( get_theme_file_uri( 'images/like.svg' ) ); ?>" alt="<?php esc_attr_e( 'Like', ALEXCODETH_TEXTDOMAIN ); ?>">
			<span class="value"><?php echo intval( get_post_meta( get_the_ID(), 'like', true ) ); ?></span>
		</button>
		<button id="dislike" href="#" class="dislike">
			<img width="22" height="22" src="<?php echo esc_attr( get_theme_file_uri( 'images/dislike.svg' ) ); ?>" alt="<?php esc_attr_e( 'Dislike', ALEXCODETH_TEXTDOMAIN ); ?>">
			<span class="value"><?php echo intval( get_post_meta( get_the_ID(), 'dislike', true ) ); ?></span>
		</button>
	</div>
</div>