<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
use function Site_Functionality\App\Blocks\render_book_quotes;

$post_id = $block->context['postId'];
$number = isset( $attributes['number'] ) ? (int) $attributes['number'] : 2;
?>
<div <?php echo get_block_wrapper_attributes( array( 'data-post-id' => $post_id ) ); ?>>
	<?php render_book_quotes( $post_id, $number ); ?>
</div>
<?php