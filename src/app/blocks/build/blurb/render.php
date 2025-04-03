<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$blurb = get_post_meta( $block->context['postId'], 'blurb', true );
if ( ! empty( $blurb ) ) :
	?>
	<h3 <?php echo get_block_wrapper_attributes(
		array(
			'class' => 'wp-block-heading is-style-text-blurb',
		)
	); ?>>
		<?php echo wp_kses_post( $blurb ); ?>
	</h3>
	<?php
endif;
