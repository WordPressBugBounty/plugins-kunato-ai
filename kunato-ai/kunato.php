<?php
/**
 * @link              https://zzazz.com/
 * @package           ZZAZZ
 *
 * @wordpress-plugin
 * Plugin Name:       ZZAZZ
 * Description:       Instantly price your content with real-time, AI-driven market valuations. Unlock your content’s true worth.
 * Version:           2.0.0
 * Author:            ZZAZZ
 * Author URI:        https://zzazz.com/
 * License:           GPL2+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kunato-ai
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'KUNATO_VERSION', '1.0.0' );

/**
 * Plugin Text Domain
 */
define( 'KUNATO_TEXT_DOMAIN', 'kunatoplg' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kunato-activator.php
 */
function kunato_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kunato-activator.php';
	Kunato_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kunato-deactivator.php
 */
function kunato_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kunato-deactivator.php';
	Kunato_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'kunato_activate' );
register_deactivation_hook( __FILE__, 'kunato_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kunato.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function kunato_run() {

	$plugin = new Kunato();
	$plugin->run();

}
kunato_run();
