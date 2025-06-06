<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$publisher = get_post_meta( $block->context['postId'], 'publisher', true );
if ( ! empty( $publisher ) ) :
	?>
	<p <?php echo get_block_wrapper_attributes(); ?>>
		<?php echo wp_kses_post( $publisher ); ?>
	</p>
	<?php
endif;
