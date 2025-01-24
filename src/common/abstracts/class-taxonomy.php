<?php
/**
 * Taxonomy
 *
 * @package   Site_Functionality
 */
namespace Site_Functionality\Common\Abstracts;

use Site_Functionality\Common\Abstracts\Base;

/**
 * Class Taxonomies
 *
 * @package Site_Functionality\Common\Abstracts
 * @since 1.0.0
 */
abstract class Taxonomy extends Base {

	/**
	 * Taxonomy data
	 */
	public static $taxonomy;

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
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init(): void {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 */

		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register taxonomy
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() : void {

		$labels = array(
			'name'                       => _x( $this::$taxonomy['title'], 'Taxonomy General Name', 'site-functionality' ),
			'singular_name'              => _x( $this::$taxonomy['singular'], 'Taxonomy Singular Name', 'site-functionality' ),
			'menu_name'                  => __( $this::$taxonomy['menu'], 'site-functionality' ),
			'all_items'                  => sprintf( /* translators: %s: post type title */ __( 'All %s', 'site-functionality' ), $this::$taxonomy['title'] ),
			'parent_item'                => sprintf( /* translators: %s: post type title */ __( 'Parent %s', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'parent_item_colon'          => sprintf( /* translators: %s: post type title */ __( 'Parent %s:', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'new_item_name'              => sprintf( /* translators: %s: post type singular title */ __( 'New %s Name', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'add_new_item'               => sprintf( /* translators: %s: post type singular title */ __( 'Add New %s', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'edit_item'                  => sprintf( /* translators: %s: post type singular title */ __( 'Edit %s', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'update_item'                => sprintf( /* translators: %s: post type title */ __( 'Update %s', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'view_item'                  => sprintf( /* translators: %s: post type singular title */ __( 'View %s', 'site-functionality' ), $this::$taxonomy['singular'] ),
			'search_items'               => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::$taxonomy['title'] ),

			'separate_items_with_commas' => sprintf( /* translators: %s: post type title */ __( 'Separate %s with commas', 'site-functionality' ), strtolower( $this::$taxonomy['title'] ) ),
			'add_or_remove_items'        => sprintf( /* translators: %s: post type title */ __( 'Add or remove %s', 'site-functionality' ), strtolower( $this::$taxonomy['title'] ) ),
			'popular_items'              => sprintf( /* translators: %s: post type title */ __( 'Popular %s', 'site-functionality' ), $this::$taxonomy['title'] ),
			'search_items'               => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::$taxonomy['title'] ),
			'no_terms'                   => sprintf( /* translators: %s: post type title */ __( 'No %s', 'site-functionality' ), strtolower( $this::$taxonomy['title'] ) ),
			'items_list'                 => sprintf( /* translators: %s: post type title */ __( '%s list', 'site-functionality' ), $this::$taxonomy['title'] ),
			'items_list_navigation'      => sprintf( /* translators: %s: post type title */ __( '%s list navigation', 'site-functionality' ), $this::$taxonomy['title'] ),
		);

		$rewrite = array(
			'slug'       => $this::$taxonomy['archive'],
			'with_front' => $this::$taxonomy['with_front'],
		);

		$args = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
			'show_in_rest'      => true,
			'rest_base'         => $this::$taxonomy['rest'],
		);
		\register_taxonomy(
			$this::$taxonomy['id'],
			$this::$taxonomy['post_types'],
			\apply_filters( \get_class( $this ) . '\Args', $args )
		);
	}
}
