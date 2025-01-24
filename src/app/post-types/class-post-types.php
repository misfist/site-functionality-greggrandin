<?php
/**
 * Content Post_Types
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\App\Post_Types;

use Site_Functionality\Common\Abstracts\Base;
use Site_Functionality\App\Post_Types\Publication;
use Site_Functionality\App\Post_Types\Issue;
// use \TenUp\ContentConnect\Plugin;

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
		new Publication( $this->settings );

		\add_filter( 'page-links-to-post-types', array( $this, 'external_links' ) );
	}

	/**
	 * Modify Post Types
	 * If post type supports $feature, enable Page Links To
	 * 
	 * @link https://wordpress.org/plugins/page-links-to/
	 * @link https://github.com/markjaquith/page-links-to/blob/master/classes/plugin.php#L517-L519
	 *
	 * @param array $post_types
	 * @return array
	 */
	public function external_links( $post_types ) : array {
		$feature = 'external-links';
		return \get_post_types_by_support( $feature );
	}

}
