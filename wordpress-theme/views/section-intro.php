<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


?>


<section class="intro-section">
	<div class="container">
		<div class="intro-content">

			<?php if ( isset( $foto_id ) && $foto_id ) : ?>
				<div id="intro-foto" class="intro-avatar">
					
					<div class="image"><?php echo wp_get_attachment_image( $foto_id, 'medium', false, '' ); ?></div>

					<?php if ( isset( $name ) && ! empty( $name ) ) : ?>
						<div id="intro-name" class="name"><?php echo $name; ?></div>
					<?php endif; ?>

					<?php if ( isset( $job ) && ! empty( $job ) ) : ?>
						<div id="intro-job" class="job"><?php echo $job; ?></div>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<div class="intro-text">
				
				<?php if ( isset( $title ) && ! empty( $title ) ) : ?>
					<h1 id="intro-title"><?php echo $title; ?></h1>
				<?php endif; ?>
				
				<?php if ( $description && ! empty( $description ) ) : ?>
					<div id="intro-description"><?php echo $description; ?></div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>