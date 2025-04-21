<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$post_id = $block->context['postId'];
$post = get_post( $post_id );
$blocks = parse_blocks( $post->post_content );

foreach ( $blocks as $block ) {

    if ( 'site-functionality/buy-buttons' === $block['blockName'] ) {

        echo apply_filters( 'the_content', render_block( $block ) );

        break;

    }
}