<?php

/**
 * Content Post_Types
 *
 * @since   1.0.0
 * @package Site_Functionality
 */

namespace Site_Functionality\App\Post_Types;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post {

	/**
	 * Post_Type data
	 */
	public const POST_TYPE = array(
		'id' => 'post',
	);

	/**
	 * Custom fields
	 *
	 * @var array
	 */
	public $fields = array();

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $settings ) {
		$this->init();
	}

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init(): void {
		\add_filter( 'register_post_type_args', array( $this, 'modify_args' ), 100, 2 );
		\add_action( 'init', array( $this, 'add_post_support' ) );

		add_filter( 'page-links-to-post-types', array( $this, 'page_links_to_support' ), 11 );

		$this->fields = array(
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
			'_links_to'        => array(
				'label'             => __( 'Publication Link', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The publisher link.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'_links_to_target' => array(
				'label'             => __( 'Link Target', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'The link target.', 'site-functionality' ),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'blurb'            => array(
				'label'             => __( 'Blurb', 'site-functionality' ),
				'type'              => 'string',
				'description'       => __( 'Extra details to display (e.g. "Updated Edition").', 'site-functionality' ),
				'sanitize_callback' => 'wp_kses_post',
			),
		);

		\add_action( 'init', array( $this, 'register_meta' ) );
		// \add_action( 'acf/include_fields', array( $this, 'register_fields' ) );
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
				self::POST_TYPE['id'],
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
	 * Modify post type args
	 *
	 * @link https://developer.wordpress.org/reference/hooks/register_post_type_args/
	 *
	 * @param  array            $args
	 * @param  string POST_TYPE
	 * @return array $args - modified
	 */
	public function modify_args( array $args, string $post_type ): array {
		return $args;
	}

	/**
	 * Remove metaboxes
	 *
	 * @return void
	 */
	public function add_post_support(): void {
		\add_post_type_support( self::POST_TYPE['id'], 'page_links_to' );
	}

	/**
	 * Add Post Links To Support
	 *
	 * @param array $supported_post_types
	 * @return array
	 */
	public function page_links_to_support( array $supported_post_types ): array {
		$supported_post_types[] = self::POST_TYPE['id'];
		return $supported_post_types;
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
