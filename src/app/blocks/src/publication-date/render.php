<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$publication_date = get_post_meta( $block->context['postId'], 'publication_date', true );
if ( ! empty( $publication_date ) ) :
	?>
	<p <?php echo get_block_wrapper_attributes(); ?>>
		<?php echo date( get_option( 'date_format' ), strtotime( $publication_date ) ); ?>
	</p>
	<?php
endif;
