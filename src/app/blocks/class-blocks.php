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

/**
 * Get Book Quotes
 *
 * @param integer $post_id
 * @param integer $number
 * @return void
 */
function get_book_quotes( $post_id = null, $number = 2 ): ?string {
	return Blocks::get_blockquotes( $post_id, $number );
}

/**
 * Render Book Quotes
 *
 * @param integer $post_id
 * @param integer $number
 * @return void
 */
function render_book_quotes( $post_id = null, $number = null ): void {
	echo get_book_quotes( $post_id, $number );
}

/**
 * Get the Book Buttons
 *
 * @param int $post_id
 * @return string|null
 */
function get_book_buttons( $post_id = null ): ?string {
	return Blocks::get_book_buttons( $post_id );
}

/**
 * Render Book Buttons
 *
 * @param integer $post_id
 * @return void
 */
function render_book_buttons( $post_id = null ): void {
	echo get_book_buttons( $post_id );
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
		register_block_type_from_metadata( __DIR__ . '/build/edit-link' );
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
	public static function get_blockquotes( $post_id = null, $number = 99 ): ?string {
		global $post;
		$post_id    = ( $post_id ) ? $post_id : $post->ID;
		$block_name = 'core/quote';

		if ( 0 === $number || '0' === $number ) {
			return null;
		}

		if ( ! has_block( $block_name, $post_id ) ) {
			return null;
		}

		$blocks = parse_blocks( $post->post_content );
		$max    = ( null === $number || '' === $number ) ? PHP_INT_MAX : (int) $number;
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

	/**
	 * Get the buttons
	 *
	 * @param int $post_id
	 * @return string|null
	 */
	public static function get_book_buttons( $post_id = null ): ?string {
		global $post;
		$post_id    = ( $post_id ) ? $post_id : $post->ID;
		$block_name = 'site-functionality/buy-buttons';

		if ( ! has_block( $block_name, $post_id ) ) {
			return null;
		}

		$blocks = parse_blocks( $post->post_content );

		$output = '';

		foreach ( $blocks as $block ) {

			if ( 'site-functionality/buy-buttons' === $block['blockName'] ) {
				$output .= apply_filters( 'the_content', render_block( $block ) );
				break;
			}
		}

		return $output;
	}
}
