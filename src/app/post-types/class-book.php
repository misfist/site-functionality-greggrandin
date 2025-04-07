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
		'has_archive' => 'books',
		'with_front'  => false,
		'rest_base'   => 'books',
		'supports'    => array(
			'title',
			'editor',
			'excerpt',
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
			'blurb'            => array(
				'label'             => __( 'Blurb', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'Extra details to display (e.g. "Updated Edition").', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_post',
			),
			'awards'           => array(
				'label'             => __( 'Awards', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'Awards book won...', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_post',
			),
			'publication_date' => array(
				'label'             => __( 'Publication Date', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The date of publication.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'publisher'        => array(
				'label'             => __( 'Publisher', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The publisher\'s name.', 'site-functionality' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			// '_links_to' => array(
			// 	'label'             => __( 'Publisher Link', 'site-functionality' ),
			// 	'type'              => 'string',
			// 	'description'       => __( 'The publisher link.', 'site-functionality' ),
			// 	'sanitize_callback' => 'sanitize_text_field',
			// ),
			'isbn'             => array(
				'label'             => __( 'ISBN', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The ISBN of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'edition'          => array(
				'label'             => __( 'Edition', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The edition of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'pages'            => array(
				'label'             => __( 'Pages', 'site-functionality' ),
				'type'              => 'string',
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
			// 'price'            => array(
			// 'label'             => __( 'Price', 'site-functionality' ),
			// 'type'              => 'number',
			// 'sanitize_callback' => 'floatval',
			// 'description'       => __( 'The price of the book.', 'site-functionality' ),
			// ),
			'rating'           => array(
				'label'             => __( 'Rating', 'site-functionality' ),
				'type'              => 'number',
				'description'       => __( 'The rating of the book.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
		);

		\add_action( 'init', array( $this, 'register_meta' ) );
		// \add_action( 'acf/include_fields', array( $this, 'register_fields' ) );

		add_filter( 'relevanssi_index_custom_fields', array( $this, 'index_meta' ), 10, 2 );
	}

	/**
	 * Register Custom Fields
	 *
	 * @return void
	 */
	public function register_fields(): void {
		$fields = array(
			array(
				'key'               => 'field_subtitle',
				'label'             => __( 'Subtitle', 'site-functionality' ),
				'name'              => 'subtitle',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_publication_date',
				'label'             => __( 'Publication Date', 'site-functionality' ),
				'name'              => 'publication_date',
				'aria-label'        => '',
				'type'              => 'date_picker',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'display_format'    => 'm/d/Y',
				'return_format'     => 'm/d/Y',
				'first_day'         => 1,
				'allow_in_bindings' => 1,
			),
			array(
				'key'               => 'field_publisher',
				'label'             => __( 'Publisher', 'site-functionality' ),
				'name'              => 'publisher',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_isbn',
				'label'             => __( 'ISBN', 'site-functionality' ),
				'name'              => 'isbn',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_edition',
				'label'             => __( 'Edition', 'site-functionality' ),
				'name'              => 'edition',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_pages',
				'label'             => __( 'Pages', 'site-functionality' ),
				'name'              => 'pages',
				'aria-label'        => '',
				'type'              => 'number',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'min'               => 0,
				'max'               => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'step'              => 1,
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_language',
				'label'             => __( 'Language', 'site-functionality' ),
				'name'              => 'language',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_format',
				'label'             => __( 'Format', 'site-functionality' ),
				'name'              => 'format',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_price',
				'label'             => __( 'Price', 'site-functionality' ),
				'name'              => 'price',
				'aria-label'        => '',
				'type'              => 'number',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'min'               => 0,
				'max'               => '',
				'allow_in_bindings' => 1,
				'placeholder'       => '',
				'step'              => '.01',
				'prepend'           => '',
				'append'            => '',
			),
		);

		$args = array(
			'key'                   => 'group_book_details',
			'title'                 => __( 'Book Details', 'site-functionality' ),
			'fields'                => $fields,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => self::$post_type['id'],
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'side',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
			'show_in_rest'          => 1,
		);

		acf_add_local_field_group( $args );
	}

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
	 * Add custom fields to search index
	 * 
	 * @link https://www.relevanssi.com/user-manual/filter-hooks/relevanssi_index_custom_fields/
	 *
	 * @param array $custom_fields
	 * @param integer $post_id
	 * @return array
	 */
	public function index_meta( array $custom_fields, int $post_id ) : array {
		$custom_fields = array_keys( $this->fields );
		return $custom_fields;
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
