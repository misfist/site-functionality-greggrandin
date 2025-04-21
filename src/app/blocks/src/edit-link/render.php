<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * $attributes: An array containing all of the block attributes
 * $content: An inner block content.
 * $block: A reference the block instances
 */
$post_type = get_post_type();
$post_id = get_the_ID();
if ( current_user_can( 'edit_post', $post_id ) ) :
	$text = sprintf(
		wp_kses(
			/* translators: %s: Post title. Only visible to screen readers. */
			__( 'Edit <span class="screen-reader-text">%s</span>', 'site-functionality' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title( $post_id )
	);
	?>
	<p class="edit-link has-small-font-size"><a href="<?php echo esc_url( get_edit_post_link() ); ?>">[
		<?php echo $text; ?>
		]</a>
	</p>
	<?php
endif;

