<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$excerpt = get_the_excerpt( $block->context['postId'] );
if ( ! empty( $excerpt ) ) :
	?>
	<p <?php echo get_block_wrapper_attributes(
		array(
			'class' => 'wp-block-post-excerpt',
		)
	); ?>>
		<?php echo wp_kses_post( $excerpt ); ?>
	</p>
	<?php
endif;
