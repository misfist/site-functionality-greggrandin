<?php
/**
 * Content Post_Types
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\App\Post_Types;

use Site_Functionality\Common\Abstracts\Base;
use Site_Functionality\App\Post_Types\Book;
use Site_Functionality\App\Post_Types\Post;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post_Types extends Base {

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
		new Book( $this->settings );
		new Post( $this->settings );

		add_filter( 'page-links-to-post-types', array( $this, 'page_links_to_support' ), 11 );
	}

	/**
	 * Determine Posts that Support plugin
	 *
	 * @param array $supported_post_types
	 * @return void
	 */
	public function page_links_to_support( $supported_post_types ) {
		$hook = 'page-links-to-types';
		// $support              = get_post_types_by_support( 'page_link_to' );
		$support              = array( 'post' );
		$supported_post_types = apply_filters( $hook, $support );
		return $supported_post_types;
	}
}
