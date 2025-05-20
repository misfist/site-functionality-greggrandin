<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/misfist/site-functionality
 * @since      1.0.0
 *
 * @package    site-functionality
 */

namespace Site_Functionality\App\Admin;

use Site_Functionality\Settings;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Site_Settings {

	/**
	 * The plugin settings.
	 *
	 * @uses Settings::get_plugin_version() for caching.
	 * @uses Settings::get_plugin_basename() for determining the plugin URL.
	 *
	 * @var Settings
	 */
	protected Settings $settings;

	/**
	 * Key for setting
	 *
	 * @var string
	 */
	public static $setting_key = 'hero_review_count';

	/**
	 * Constructor
	 *
	 * @param Settings $settings The plugin settings.
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
		$this->init();
	}

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'admin_init', array( $this, 'register_setting' ) );
	}

	/**
	 * Register the setting and add the field to Reading Settings
	 *
	 * @return void
	 */
	public function register_setting(): void {
		register_setting(
			'reading',
			self::$setting_key,
			array(
				'type'              => 'integer',
				'sanitize_callback' => array( $this, 'sanitize_setting' ),
				'default'           => '',
			)
		);

		add_settings_field(
			self::$setting_key,
			__( 'Reviews on Homepage', 'site-functionality' ),
			array( $this, 'render_field' ),
			'reading'
		);
	}

	/**
	 * Render the input field
	 *
	 * @return void
	 */
	public function render_field(): void {
		$value = get_option( self::$setting_key, 0 );
		?>
		<input type="number"
			name="<?php echo self::$setting_key; ?>"
			id="<?php echo self::$setting_key; ?>"
			value="<?php echo esc_attr( $value ); ?>"
			class="small-text"
			min="0" 
		/>
		<p class="description">
			<?php esc_html_e( 'Enter the number of book reviews to display in the homepage hero. Leave empty to show all.', 'site-functionality' ); ?>
		</p>
		<?php
	}

	/**
	 * Sanitize the review count input
	 *
	 * @param mixed $value
	 * @return int|string
	 */
	public function sanitize_setting( $value ) {
		if ( $value === '' ) {
			return '';
		}
		return absint( $value );
	}

	/**
	 * Get the setting
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public static function get_setting( $key = '' ) {
		$key = $key ?: self::$setting_key;
		return get_option( $key );
	}
}
