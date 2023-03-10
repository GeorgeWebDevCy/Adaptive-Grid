<?php
/**
 * GM Adaptive CSS Grid Columns
 *
 * @package       GMADAPTIVE
 * @author        George Nicolaou & Michael Kellersmann
 * @license       gplv2
 * @version       1.0.5.6
 *
 * @wordpress-plugin
 * Plugin Name:   GM Adaptive CSS Grid Columns
 * Plugin URI:    https://www.georgenicolaou.me/plugins/gm-adaptive-css-grid-columns
 * Description:   GM Adaptive CSS Grid Columns is a plugin that allows you to create Adaptive CSS Grid Columns
 * Version:       1.0.5.6
 * Author:        George Nicolaou & Michael Kellersmann
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   gm-adaptive-css-grid-columns
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with GM Adaptive CSS Grid Columns. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
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
 * The function GMADAPTIVE() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'GMADAPTIVE_NAME',			'GM Adaptive CSS Grid Columns' );

// Plugin version
define( 'GMADAPTIVE_VERSION',		'1.0.5.6' );

// Plugin Root File
define( 'GMADAPTIVE_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'GMADAPTIVE_PLUGIN_BASE',	plugin_basename( GMADAPTIVE_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'GMADAPTIVE_PLUGIN_DIR',	plugin_dir_path( GMADAPTIVE_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'GMADAPTIVE_PLUGIN_URL',	plugin_dir_url( GMADAPTIVE_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once GMADAPTIVE_PLUGIN_DIR . 'core/class-gm-adaptive-css-grid-columns.php';
require GMADAPTIVE_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

use ScssPhp\ScssPhp\Compiler;

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'gmadaptive_activate' );
register_deactivation_hook( __FILE__, 'gmadaptive_deactivate' );

// Define activation function
function gmadaptive_activate() {
    // Add default options upon activation

    $default_options = array(
        'bp_md' => 45,
        'bp_lg' => 65,
        'max_column_count_md' => 2,
        'max_column_count_lg' => 4,
        'gap' => 1.5,
        'max_width' => 87.5,
        'hspace' => 2,
		'scss_output_style' => 'Yes'
    );

    // Get the existing options from the database
    $existing_options = get_option( 'gmadaptive_options' );

    // Merge the existing options with the default options
    $options = is_array( $existing_options ) ? array_merge( $default_options, $existing_options ) : $default_options;

    // Update the options in the database
    update_option( 'gmadaptive_options', $options );
}

// Define deactivation function
function gmadaptive_deactivate() {
    // Remove options when plugin is deactivated
    delete_option( 'gmadaptive_options' );
}

// Register a custom menu page to add the options
function gmadaptive_options_page() {
    // Load the options from the database
    $options = get_option( 'gmadaptive_options' );

    // Define the default values for each option
    $default_options = array(
        'bp_md' => 45,
        'bp_lg' => 65,
        'max_column_count_md' => 2,
        'max_column_count_lg' => 4,
        'gap' => 1.5,
        'max_width' => 87.5,
        'hspace' => 2,
		'scss_output_style' => 'Yes'
    );

    // Loop through the default options and set any unset values to their defaults
    foreach ( $default_options as $key => $value ) {
        if ( ! isset( $options[ $key ] ) ) {
            $options[ $key ] = $value;
        }
    }

    // Save the updated options to the database
    update_option( 'gmadaptive_options', $options );


    // Display the options page
    add_menu_page(
        __('GM Adaptive CSS Grid Columns', 'gm-adaptive-css-grid-columns'),
        // Page title
        __('GM Grid', 'gm-adaptive-css-grid-columns'),
        // Menu title
        'manage_options',
        // Capability required to access the menu
        'gmadaptive_options',
        // Menu slug
        'gmadaptive_options_page_content',
        // Callback function to render the page content
        'dashicons-layout' // Icon for the menu
    );
}
add_action('admin_menu', 'gmadaptive_options_page');

// Render the options page content
function gmadaptive_options_page_content()
{
    ?>
    <div class ="wrap">
    <div>
    <h2><strong><?php _e('Important Notice:', 'gm-adaptive-css-grid-columns'); ?></strong></h2>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <?php _e('The plugin only works if you correctly identify and target the parent and its direct child elements.', 'gm-adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <?php _e('Recommended page builders are Bricks, Oxygen, and Breakdance.', 'gm-adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <h2><strong><?php _e('How to use:', 'gm-adaptive-css-grid-columns'); ?></strong></h2>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <?php _e('The setup is quite simple. Basically, you just add two CSS classes to your elements and the plugin does the magic for you. Make sure to add the following classes to the container and direct child elements.', 'gm-adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <strong><?php _e('Parent Element class:', 'gm-adaptive-css-grid-columns'); ?></strong>
    grid-container
    </div>
    <div>
    <strong><?php _e('Child Element class:', 'gm-adaptive-css-grid-columns'); ?></strong>
    grid-item
    </div>
    <div>
    1. <?php _e('Define the maximum column count for your medium and large screen size.', 'gm-adaptive-css-grid-columns'); ?><br />
    2. <?php _e('Add the desired gap size (in rem).', 'gm-adaptive-css-grid-columns'); ?><br />
    3. <?php _e('Define the medium and large breakpoint (in em).', 'gm-adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <br/>
    </div>
    </div>
    <div class="wrap">
        <h1><?php _e('GM Adaptive CSS Grid Columns', 'gm-adaptive-css-grid-columns'); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields('gmadaptive_options_group'); ?>
			<?php do_settings_sections('gmadaptive_options'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

// Register the options and settings
function gmadaptive_register_options()
{
    register_setting(
        'gmadaptive_options_group',
        // Option group
        'gmadaptive_options',
        // Option name
        'gmadaptivegm_options_sanitize' // Sanitization callback function
    );

    add_settings_section(
        'gmadaptive_section',
        // Section ID
        __('Max Column Counts', 'gm-adaptive-css-grid-columns'),
        // Section title
        'gmadaptive_section_callback',
        // Callback function to render the section
        'gmadaptive_options' // Page slug
    );

    add_settings_field(
        'max_column_count_md',
        // Field ID
        __('Max Column Count (medium)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_max_column_count_md_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

    add_settings_field(
        'max_column_count_lg',
        // Field ID
        __('Max Column Count (large)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_max_column_count_lg_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

    add_settings_field(
        'gap',
        // Field ID
        __('Gap (in rem)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_gap_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

    add_settings_field(
        'bp_md',
        // Field ID
        __('Medium Breakpoint (in rem)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_bp_md_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );


    add_settings_field(
        'bp_lg',
        // Field ID
        __('Large Breakpoint (in rem)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_bp_lg_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

    add_settings_field(
        'scss_output_style',
        // Field ID
        __('Minify CSS Output  (Default=Yes)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'scss_output_style_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

	add_settings_field(
        'max_width',
        // Field ID
        __('Maximum width for centered grid (in rem)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_max_width_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );

    add_settings_field(
        'hspace',
        // Field ID
        __('Horizontal left and right spacing (in rem)', 'gm-adaptive-css-grid-columns'),
        // Field label
        'gmadaptive_hspace_callback',
        // Callback function to render the field
        'gmadaptive_options',
        // Page slug
        'gmadaptive_section' // Section ID
    );


}
add_action('admin_init', 'gmadaptive_register_options');

// Sanitize the options before saving
function gmadaptive_options_sanitize($options)
{
    $sanitized_options = array();
    $sanitized_options['max_column_count_md'] = absint($options['max_column_count_md']);
    $sanitized_options['max_column_count_lg'] = absint($options['max_column_count_lg']);
    $sanitized_options['gap'] = ($options['gap']);
    $sanitized_options['bp_md'] = ($options['bp_md']);
    $sanitized_options['bp_lg'] = ($options['bp_lg']);
    $sanitized_options['scss_output_style'] = ($options['scss_output_style']);
    $sanitized_options['max_width'] = ($options['max_width']);
    $sanitized_options['hspace'] = ($options['hspace']);


    return $sanitized_options;
}

// Render the section description
function gmadaptive_section_callback()
{
	echo '<p>' . __('Enter the max column counts for different screen sizes.', 'gm-adaptive-css-grid-columns') . '</p>';
}

// Render the max_column_count_md field
function gmadaptive_max_column_count_md_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[max_column_count_md]" value="' . $options['max_column_count_md'] . '" />';
}

// Render the max_column_count_lg field
function gmadaptive_max_column_count_lg_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[max_column_count_lg]" value="' . $options['max_column_count_lg'] . '" />';
}

// Render the gap field
function gmadaptive_gap_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[gap]" step="0.1" value="' . $options['gap'] . '" />';
}

function gmadaptive_bp_md_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[bp_md]" step="0.1" value="' . $options['bp_md'] . '" />';
}

function gmadaptive_bp_lg_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[bp_lg]" step="0.1" value="' . $options['bp_lg'] . '" />';
}

function gmadaptive_max_width_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[max_width]" step="0.1" value="' . $options['max_width'] . '" />';
}

function gmadaptive_hspace_callback()
{
	$options = get_option('gmadaptive_options');
	echo '<input type="number" name="gmadaptive_options[hspace]" step="0.1" value="' . $options['hspace'] . '" />';
}



// Render the scss_output_style field
function scss_output_style_callback() {
    $options = get_option('gmadaptive_options');
	

    $checked = isset($options['scss_output_style']) && $options['scss_output_style'] === 'Yes' ? 'checked="checked"' : '';
	$status = $options['scss_output_style'];
    echo "<script>console.log('$status');</script>";
    if(isset($options['scss_output_style']) && $options['scss_output_style'] === 'No') {
        $checked = '';
		$status = $options['scss_output_style'];
    echo "<script>console.log('$status');</script>";
    }

    echo '<input type="checkbox" name="gmadaptive_options[scss_output_style]" value="Yes" ' . $checked . '/>';
    
    if(empty($options['scss_output_style'])) {
        echo '<input type="hidden" name="gmadaptive_options[scss_output_style]" value="No" />';
		$status = $options['scss_output_style'];
    echo "<script>console.log('$status');</script>";
    }
}
function enqueue_my_styles() {
	wp_enqueue_style( 'my-styles', plugin_dir_url( __FILE__ ) . 'assets/stylesheets/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );

function grid_container_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'columns' => __( '1', 'gmadaptive-css-grid-columns' ),
			'rows' => __( '1', 'gmadaptive-css-grid-columns' ),
		),
		$atts,
		'grid_container'
	);

	$grid_items = explode( ',', $content );
	$grid_items_html = '';

	foreach ( $grid_items as $grid_item ) {
		$grid_items_html .= '<div class="grid-item">' . trim( $grid_item ) . '</div>';
	}

	$grid_container_html = '<div class="grid-container">';
	$grid_container_html .= $grid_items_html;
	$grid_container_html .= '</div>';

	return $grid_container_html;
}
add_shortcode( 'grid_container', 'grid_container_shortcode' );

function is_scss_working() {
	$scss = new Compiler(); // Initialize the scssphp compiler
	$scss->setImportPaths( GMADAPTIVE_PLUGIN_DIR . 'assets/stylesheets/' );
	$scss->compileString( '@import "style.scss";' )->getCss();

	$scss_code = 'body { color: red; }'; // Define a sample SCSS code to compile

	try {
		$css_code = $scss->compileString( $scss_code ); // Compile the SCSS code into CSS
	} catch ( \Exception $e ) {
		return false; // If an error occurred, return false
	}

	if ( empty( $css_code ) ) {
		return false; // If the compiled CSS code is empty, return false
	}

	return true; // If the SCSS code was successfully compiled, return true
}


/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  George Nicolaou & Michael Kellersmann
 * @since   1.0.0
 * @return  object|Gm_Adaptive_Css_Grid_Columns
 */
function GMADAPTIVE() {
	return Gm_Adaptive_Css_Grid_Columns::instance();
}

//plugin updater start
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/GeorgeWebDevCy/adaptive-css-grid-columns',
	__FILE__,
	'adaptive-css-grid-columns'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('your-token-here');
//plugin updater end 


//version check start

//version check end


GMADAPTIVE();
