<?php

/**
 * Content Post_Types
 *
 * @since   1.0.0
 * @package Site_Functionality
 */

namespace Site_Functionality\App\Post_Types;

use Site_Functionality\Common\Abstracts\Post_Type;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Book extends Post_Type {

	/**
	 * Post_Type data
	 */
	public static $post_type = array(
		'id'          => 'book',
		'slug'        => 'book',
		'menu'        => 'Books',
		'title'       => 'Books',
		'singular'    => 'Book',
		'icon'        => 'dashicons-book-alt',
		'taxonomies'  => array(
			'genre',
			'category',
		),
		'has_archive' => false,
		'with_front'  => false,
		'rest_base'   => 'books',
		'supports'    => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'custom-fields',
			'external-links',
		),
	);

	/**
	 * Custom fields
	 *
	 * @var array
	 */
	public $fields = array();

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init(): void {
		parent::init();

		$this->fields = array(
			'subtitle'         => array(
				'label'             => __( 'Subtitle', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The subtitle of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'publication_date' => array(
				'label'             => __( 'Publication Date', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The publication date of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'publisher'        => array(
				'label'             => __( 'Publisher', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The publisher of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'isbn'             => array(
				'label'             => __( 'ISBN', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The ISBN of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'pages'            => array(
				'label'             => __( 'Pages', 'site-functionality' ),
				'type'              => 'number',
				'description'       => __( 'The number of pages in the book.', 'site-functionality' ),
				'sanitize_callback' => 'absint',
			),
			'language'         => array(
				'label'             => __( 'Language', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The language of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'format'           => array(
				'label'             => __( 'Format', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The format of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'price'            => array(
				'label'             => __( 'Price', 'site-functionality' ),
				'type'              => 'number',
				'sanitize_callback' => 'floatval',
				'description'       => __( 'The price of the book.', 'site-functionality' ),
			),
			'rating'           => array(
				'label'             => __( 'Rating', 'site-functionality' ),
				'type'              => 'number',
				'description'       => __( 'The rating of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
		);

		\add_action( 'init', array( $this, 'register_meta' ) );
		// \add_action( 'acf/init', array( $this, 'register_fields' ) );
	}

	/**
	 * Register Custom Fields
	 *
	 * @return void
	 */
	public function register_fields(): void {}

	/**
	 * Register Meta
	 *
	 * @return void
	 */
	public function register_meta(): void {

		foreach ( $this->fields as $key => $field ) {
			\register_post_meta(
				self::$post_type['id'],
				$key,
				array(
					'show_in_rest'      => ( isset( $field['show_in_rest'] ) ) ? $field['show_in_rest'] : true,
					'single'            => ( isset( $field['single'] ) ) ? $field['single'] : true,
					'type'              => $field['type'],
					'label'             => $field['label'],
					'description'       => $field['description'],
					'sanitize_callback' => $field['sanitize_callback'],
				)
			);
		}
	}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordbook.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 */
	public function register_query_vars( $vars ): array {
		return $vars;
	}
}
