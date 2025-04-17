<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package site-functionality
 */
namespace Site_Functionality\App\Blocks;

use Site_Functionality\Common\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function get_book_quotes( $post_id = null, $number = 2 ) {
	return Blocks::get_blockquotes( $post_id, $number );
}

function render_book_quotes( $post_id = null, $number = 2  ) {
	echo get_book_quotes( $post_id, $number );
}

class Blocks extends Base {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->init();
	}

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'init', array( $this, 'register_block_patterns' ) );

		add_action( 'init', array( $this, 'set_script_translations' ) );

		add_action( 'init', array( $this, 'register_blocks' ) );

		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_blocks_scripts' ) );

		add_filter( 'block_categories_all', array( $this, 'register_block_category' ), 10, 2 );
	}

	/**
	 * Registers blocks using metadata from `block.json`.
	 *
	 * @return void
	 */
	public function register_blocks(): void {
		// register_block_type_from_metadata( __DIR__ . '/build/subtitle' );
		// register_block_type_from_metadata( __DIR__ . '/build/publication-date' );
		// register_block_type_from_metadata( __DIR__ . '/build/publisher' );
		register_block_type_from_metadata( __DIR__ . '/build/buy-buttons' );
		register_block_type_from_metadata( __DIR__ . '/build/book-details' );
		register_block_type_from_metadata( __DIR__ . '/build/post-details' );
		register_block_type_from_metadata( __DIR__ . '/build/quotes' );
		// register_block_type_from_metadata( __DIR__ . '/build/excerpt' );
	}

	/**
	 * Register block patterns
	 *
	 * @return void
	 */
	public function register_block_patterns(): void {}

	/**
	 * Set script translations
	 *
	 * @return void
	 */
	public function set_script_translations(): void {
		wp_set_script_translations( 'site-functionality', 'site-functionality' );
	}

	/**
	 * Register block category
	 *
	 * @param array  $block_categories
	 * @param object $block_editor_context instance of WP_Block_Editor_Context
	 * @return array $block_categories
	 */
	public function register_block_category( $block_categories, $block_editor_context ) {
		return $block_categories;
	}

	/**
	 * Enqueue blocks scripts
	 *
	 * @return void
	 */
	public function enqueue_blocks_scripts(): void {}

	/**
	 * Get book quotes
	 *
	 * @return string
	 */
	public static function get_blockquotes( $post_id = null, $number = 2 ): ?string {
		global $post;
		$post_id    = ( $post_id ) ? $post_id : $post->ID;
		$block_name = 'core/quote';

		if ( ! has_block( $block_name, $post_id ) ) {
			return null;
		}

		$blocks = parse_blocks( $post->post_content );
		$max    = $number;
		$count  = 1;

		$output = '';

		foreach ( $blocks as $block ) {
			if ( 'core/quote' === $block['blockName'] ) {
				if ( $max < $count ) {
					break;
				}
				// error_log( $block['blockName'] . '' . $count );
				$output .= render_block( $block );
				++$count;
			}
		}
		return $output;
	}
}
