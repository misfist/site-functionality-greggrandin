<?php
/**
 * Site Functionality
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
abstract class Post_Type extends Base {

	/**
	 * Post_Type data
	 */
	public static $post_type;

	/**
	 * Post Type fields
	 */
	public static $fields;

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
		\add_action( 'init', array( $this, 'register' ) );
		\add_filter( 'query_vars', array( $this, 'register_query_vars' ) );

	}

	/**
	 * Register post type
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() : void {
		$labels  = array(
			'name'                  => _x( $this::$post_type['title'], 'Post Type General Name', 'site-functionality' ),
			'singular_name'         => _x( $this::$post_type['singular'], 'Post Type Singular Name', 'site-functionality' ),
			'menu_name'             => __( $this::$post_type['menu'], 'site-functionality' ),
			'name_admin_bar'        => __( $this::$post_type['singular'], 'site-functionality' ),

			'add_new'               => sprintf( /* translators: %s: post type singular title */ __( 'New %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'add_new_item'          => sprintf( /* translators: %s: post type singular title */ __( 'Add New %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'new_item'              => sprintf( /* translators: %s: post type singular title */ __( 'New %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'edit_item'             => sprintf( /* translators: %s: post type singular title */ __( 'Edit %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'view_item'             => sprintf( /* translators: %s: post type singular title */ __( 'View %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'view_items'            => sprintf( /* translators: %s: post type title */ __( 'View %s', 'site-functionality' ), $this::$post_type['title'] ),
			'all_items'             => sprintf( /* translators: %s: post type title */ __( 'All %s', 'site-functionality' ), $this::$post_type['title'] ),
			'search_items'          => sprintf( /* translators: %s: post type title */ __( 'Search %s', 'site-functionality' ), $this::$post_type['title'] ),

			'archives'              => sprintf( /* translators: %s: post type title */ __( '%s Archives', 'site-functionality' ), $this::$post_type['singular'] ),
			'attributes'            => sprintf( /* translators: %s: post type title */ __( '%s Attributes', 'site-functionality' ), $this::$post_type['singular'] ),
			'parent_item_colon'     => sprintf( /* translators: %s: post type title */ __( 'Parent %s:', 'site-functionality' ), $this::$post_type['singular'] ),
			'update_item'           => sprintf( /* translators: %s: post type title */ __( 'Update %s', 'site-functionality' ), $this::$post_type['singular'] ),
			'items_list'            => sprintf( /* translators: %s: post type singular title */ __( '%s List', 'site-functionality' ), $this::$post_type['title'] ),
			'items_list_navigation' => sprintf( /* translators: %s: post type singular title */ __( '%s list navigation', 'site-functionality' ), $this::$post_type['title'] ),

			'insert_into_item'      => sprintf( /* translators: %s: post type title */ __( 'Insert into %s', 'site-functionality' ), strtolower( $this::$post_type['singular'] ) ),
			'uploaded_to_this_item' => sprintf( /* translators: %s: post type title */ __( 'Uploaded to this %s', 'site-functionality' ), strtolower( $this::$post_type['singular'] ) ),
			'filter_items_list'     => sprintf( /* translators: %s: post type title */ __( 'Filter %s list', 'site-functionality' ), strtolower( $this::$post_type['title'] ) ),
			'featured_image'        => __( 'Featured Image', 'site-functionality' ),
		);
		$rewrite = array(
			'slug'       => array_key_exists( 'slug', $this::$post_type ) ? $this::$post_type['slug'] : $this::$post_type['id'],
			'with_front' => array_key_exists( 'with_front', $this::$post_type ) ? $this::$post_type['with_front'] : false,
		);
		$args    = array(
			'label'               => $this::$post_type['title'],
			'labels'              => $labels,
			'supports'            => array_key_exists( 'supports', $this::$post_type ) ? $this::$post_type['supports'] : array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'page-attributes' ),
			'taxonomies'          => array_key_exists( 'taxonomies', $this::$post_type ) ? $this::$post_type['taxonomies'] : array(),
			'hierarchical'        => array_key_exists( 'hierarchical', $this::$post_type ) ? $this::$post_type['hierarchical'] : false,
			'public'              => array_key_exists( 'public', $this::$post_type ) ? $this::$post_type['public'] : true,
			'show_ui'             => array_key_exists( 'show_ui', $this::$post_type ) ? $this::$post_type['show_ui'] : true,
			'show_in_menu'        => array_key_exists( 'show_in_menu', $this::$post_type ) ? $this::$post_type['show_in_menu'] : true,
			'menu_icon'           => array_key_exists( 'icon', $this::$post_type ) ? $this::$post_type['icon'] : 'dashicons-admin-post',
			'menu_position'       => array_key_exists( 'menu_position', $this::$post_type ) ? $this::$post_type['menu_position'] : 4,
			'show_in_admin_bar'   => array_key_exists( 'show_in_admin_bar', $this::$post_type ) ? $this::$post_type['show_in_admin_bar'] : true,
			'show_in_nav_menus'   => array_key_exists( 'show_in_nav_menus', $this::$post_type ) ? $this::$post_type['show_in_nav_menus'] : true,
			'can_export'          => array_key_exists( 'can_export', $this::$post_type ) ? $this::$post_type['can_export'] : true,
			'has_archive'         => array_key_exists( 'has_archive', $this::$post_type ) ? $this::$post_type['has_archive'] : true,
			'rewrite'             => $rewrite,
			'exclude_from_search' => array_key_exists( 'exclude_from_search', $this::$post_type ) ? $this::$post_type['exclude_from_search'] : false,
			'publicly_queryable'  => array_key_exists( 'publicly_queryable', $this::$post_type ) ? $this::$post_type['publicly_queryable'] : true,
			'capability_type'     => array_key_exists( 'capability', $this::$post_type ) ? $this::$post_type['capability'] : 'post',
			'show_in_rest'        => array_key_exists( 'show_in_rest', $this::$post_type ) ? $this::$post_type['show_in_rest'] : true,
			'rest_base'           => array_key_exists( 'rest_base', $this::$post_type ) ? $this::$post_type['rest_base'] : $this::$post_type['archive'],
			'template_lock'       => array_key_exists( 'template_lock', $this::$post_type ) ? $this::$post_type['template_lock'] : false,
		);
		if ( array_key_exists( 'template', $this::$post_type ) && ! empty( $this::$post_type['template'] ) ) {
			$args['template'] = $this::$post_type['template'];
		}

		\register_post_type(
			$this::$post_type['id'],
			\apply_filters( \get_class( $this ) . '\Args', $args )
		);

	}

	/**
	 * Register custom query vars
	 *
	 * @link https://developer.wordpress.org/reference/hooks/query_vars/
	 *
	 * @param array $vars The array of available query variables
	 * @return array $vars The array of available query variables
	 */
	abstract public function register_query_vars( $vars ) : array;

}
