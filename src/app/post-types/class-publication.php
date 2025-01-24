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

class Publication extends Post_Type {

	/**
	 * Post_Type data
	 */
	public static $post_type = array(
		'id'          => 'publication',
		'slug'        => 'publication',
		'menu'        => 'Publication',
		'title'       => 'Publications',
		'singular'    => 'Publication',
		'icon'        => 'dashicons-book-alt',
		'taxonomies'  => array(
			'publication_type'
		),
		'has_archive' => false,
		'with_front'  => false,
		'rest_base'   => 'publications',
		'supports'    => array( 
			'title', 
			'editor', 
			'author', 
			'thumbnail', 
			'custom-fields', 
			'external-links'
		),
	);

	/**
	 * Post Type fields
	 */
	public static $field = array(
		'_links_to',
		'_links_to_target',
	);

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init(): void {
		parent::init();
		// \add_action( 'init', array( $this, 'register_meta' ) );
		\add_action( 'acf/init', array( $this, 'register_fields' ) );
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
	public function register_meta(): void {}

	/**
	 * Modify Post Content
	 *
	 * @link https://developer.wordpublication.org/reference/hooks/the_content/
	 *
	 * @param string $content
	 * @return string $content
	 */
	public function modify_post_content( $content ): string {
		return $content;
	}

	/**
	 * Modify Post Title
	 *
	 * @link https://developer.wordpublication.org/reference/hooks/the_title/
	 *
	 * @param string $content
	 * @return string $content
	 */
	public function modify_post_title( $title ): string {
		return $title;
	}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordpublication.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 */
	public function register_query_vars( $vars ): array {
		return $vars;
	}

}
