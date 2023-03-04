<?php
/**
 * Adaptive CSS Grid Columns
 *
 * @package       ADAPTIVECS
 * @author        George Nicolaou & Michael Kellersmann
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Adaptive CSS Grid Columns
 * Plugin URI:    https://www.georgenicolaou.me/plugins/adaptive-css-grid-columns
 * Description:   Allows you to create Adaptive CSS Grid Columns
 * Version:       1.0.0
 * Author:        George Nicolaou & Michael Kellersmann
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   adaptive-css-grid-columns
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Adaptive CSS Grid Columns. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function ADAPTIVECS() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'ADAPTIVECS_NAME',			'Adaptive CSS Grid Columns' );

// Plugin version
define( 'ADAPTIVECS_VERSION',		'1.0.0' );

// Plugin Root File
define( 'ADAPTIVECS_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'ADAPTIVECS_PLUGIN_BASE',	plugin_basename( ADAPTIVECS_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'ADAPTIVECS_PLUGIN_DIR',	plugin_dir_path( ADAPTIVECS_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'ADAPTIVECS_PLUGIN_URL',	plugin_dir_url( ADAPTIVECS_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once ADAPTIVECS_PLUGIN_DIR . 'core/class-adaptive-css-grid-columns.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou & Michael Kellersmann
 * @since   1.0.0
 * @return  object|Adaptive_Css_Grid_Columns
 */
function ADAPTIVECS() {
	return Adaptive_Css_Grid_Columns::instance();
}

ADAPTIVECS();
