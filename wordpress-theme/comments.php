<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<!-- comments-section -->
<section class="simple-section gray-bg">
	<div class="container">
		<h2><?php printf( __( 'Comments <small>(%s)</small>', ALEXCODETH_TEXTDOMAIN ), mb_strtolower( get_comments_number_text() ) ); ?></h2>
		<div class="comments-outer">
			<div class="comments-content">

				<?php

					wp_list_comments( [
						'walker'            => null,
						'max_depth'         => '',
						'style'             => 'div',
						'callback'          => function ( $comment, $args, $depth ) {
							include get_theme_file_path( 'views/entry-comment.php' ); 
						},
						'end-callback'      => null,
						'type'              => 'all',
						'reply_text'        => sprintf( '<img src="%1$s" alt="%2$s"> %2$s', get_theme_file_uri( 'images/reply.svg' ), esc_attr__( 'Ответить', ALEXCODETH_TEXTDOMAIN ) ),
						'page'              => 1,
						'per_page'          => 0,
						'avatar_size'       => 32,
						'reverse_top_level' => null,
						'reverse_children'  => '',
						'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
						'short_ping'        => false,    // С версии 3.6,
						'echo'              => true, 
					] );

				?>

			</div>


			<?php

				comment_form( array(
					'title_reply'         => esc_html__( 'Leave a comment', ALEXCODETH_TEXTDOMAIN ),
					'title_reply_before'  => '<h3>',
					'title_reply_after'   => '</h3>',
					'class_form'          => 'simple-form',
					'fields'              => [
						'author'              => '<div class="input-block"><input type="text" id="author" name="author" placeholder="' . esc_attr__( 'Your name', ALEXCODETH_TEXTDOMAIN ) . '"></div>',
						'email'               => '<div class="input-block"><input type="text" id="email" name="email" placeholder="' . esc_attr__( 'Your email', ALEXCODETH_TEXTDOMAIN ) . '"></div>',
						// 'url'                 => '<div class="input-block"><input type="url" id="url" name="url" placeholder="' . esc_attr__( 'Ваш сайт', ALEXCODETH_TEXTDOMAIN ) . '"></div>',
					],
					'comment_field'       => '<div class="input-block"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Type anything...', ALEXCODETH_TEXTDOMAIN ) . '"></textarea></div>',
					'comment_notes_after' => '',
					'label_submit'        => esc_attr__( 'Post comment', ALEXCODETH_TEXTDOMAIN ),
					'submit_button'       => '<button name="%1$s id="%2$s" class="%3$s" type="submit">%4$s</button>',
					'class_submit'        => 'btn',
					'class_container'     => 'comments-form',
				) );

			?>


		</div>
	</div>
</section>