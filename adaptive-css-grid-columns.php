<?php
/**
 * Adaptive CSS Grid Columns
 *
 * @package       ADAPTIVECS
 * @author        George Nicolaou & Michael Kellersmann
 * @license       gplv2
 * @version       1.0.5.2
 *
 * @wordpress-plugin
 * Plugin Name:   GM Adaptive CSS Grid Columns
 * Plugin URI:    https://www.georgenicolaou.me/plugins/adaptive-css-grid-columns
 * Description:   GM Adaptive CSS Grid Columns is a plugin that allows you to create Adaptive CSS Grid Columns
 * Version:       1.0.5.2
 * Author:        George Nicolaou & Michael Kellersmann
 * Author URI:    https://www.georgenicolaou.me/
 * Text Domain:   adaptive-css-grid-columns
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with GM Adaptive CSS Grid Columns. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if (!defined('ABSPATH'))
	exit;

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
define('ADAPTIVECS_NAME', 'GM Adaptive CSS Grid Columns');

// Plugin version
define('ADAPTIVECS_VERSION', '1.0.5.2');

// Plugin Root File
define('ADAPTIVECS_PLUGIN_FILE', __FILE__);

// Plugin base
define('ADAPTIVECS_PLUGIN_BASE', plugin_basename(ADAPTIVECS_PLUGIN_FILE));

// Plugin Folder Path
define('ADAPTIVECS_PLUGIN_DIR', plugin_dir_path(ADAPTIVECS_PLUGIN_FILE));

// Plugin Folder URL
define('ADAPTIVECS_PLUGIN_URL', plugin_dir_url(ADAPTIVECS_PLUGIN_FILE));

/**
 * Load the main class for the core functionality
 */
//Load Composer's autoloader


require_once ADAPTIVECS_PLUGIN_DIR . 'core/class-adaptive-css-grid-columns.php';
require_once ADAPTIVECS_PLUGIN_DIR . 'vendor/autoload.php';
require_once ADAPTIVECS_PLUGIN_DIR . 'vendor/scssphp/scssphp/scss.inc.php';

require ADAPTIVECS_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

use ScssPhp\ScssPhp\Compiler;

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'adaptivecs_activate' );
register_deactivation_hook( __FILE__, 'adaptivecs_deactivate' );

// Define activation function
function adaptivecs_activate() {
    // Add default options upon activation
    $options = array(
        'bp_md' => 45,
        'bp_lg' => 65,
        'max_column_count_md' => 2,
        'max_column_count_lg' => 4,
        'gap' => 1.5,
        'auto_min_column' => 20
        
    );
    add_option( 'adaptivecs_options', $options );
}

// Define deactivation function
function adaptivecs_deactivate() {
    // Remove options when plugin is deactivated
    delete_option( 'adaptivecs_options' );
}

// Register a custom menu page to add the options
function adaptivecs_options_page()
{
    add_menu_page(
        __('GM Adaptive CSS Grid Columns', 'adaptive-css-grid-columns'),
        // Page title
        __('GM Grid', 'adaptive-css-grid-columns'),
        // Menu title
        'manage_options',
        // Capability required to access the menu
        'adaptivecs_options',
        // Menu slug
        'adaptivecs_options_page_content',
        // Callback function to render the page content
        'dashicons-layout' // Icon for the menu
    );
}
add_action('admin_menu', 'adaptivecs_options_page');

// Render the options page content
function adaptivecs_options_page_content()
{
    ?>
    <div class ="wrap">
    <div>
    <h2><strong><?php _e('Important Notice:', 'adaptive-css-grid-columns'); ?></strong></h2>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <?php _e('The plugin only works if you correctly identify and target the parent and its direct child elements.', 'adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <?php _e('Recommended page builders are Bricks, Oxygen, and Breakdance.', 'adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <h2><strong><?php _e('How to use:', 'adaptive-css-grid-columns'); ?></strong></h2>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <?php _e('The setup is quite simple. Basically, you just add two CSS classes to your elements and the plugin does the magic for you. Make sure to add the following classes to the container and direct child elements.', 'adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <strong><?php _e('Parent Element class:', 'adaptive-css-grid-columns'); ?></strong>
    grid-container
    </div>
    <div>
    <strong><?php _e('Child Element class:', 'adaptive-css-grid-columns'); ?></strong>
    grid-item
    </div>
    <div>
    1. <?php _e('Define the maximum column count for your medium and large screen size.', 'adaptive-css-grid-columns'); ?><br />
    2. <?php _e('Add the desired gap size (in rem).', 'adaptive-css-grid-columns'); ?><br />
    3. <?php _e('Define the medium and large breakpoint (in em).', 'adaptive-css-grid-columns'); ?>
    </div>
    <div>
    <br/>
    </div>
    <div>
    <br/>
    </div>
    </div>
    <div class="wrap">
        <h1><?php _e('GM Adaptive CSS Grid Columns', 'adaptive-css-grid-columns'); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields('adaptivecs_options_group'); ?>
			<?php do_settings_sections('adaptivecs_options'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

// Register the options and settings
function adaptivecs_register_options()
{
    register_setting(
        'adaptivecs_options_group',
        // Option group
        'adaptivecs_options',
        // Option name
        'adaptivecs_options_sanitize' // Sanitization callback function
    );

    add_settings_section(
        'adaptivecs_section',
        // Section ID
        __('Max Column Counts', 'adaptive-css-grid-columns'),
        // Section title
        'adaptivecs_section_callback',
        // Callback function to render the section
        'adaptivecs_options' // Page slug
    );

    add_settings_field(
        'max_column_count_md',
        // Field ID
        __('Max Column Count (medium)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_max_column_count_md_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );

    add_settings_field(
        'max_column_count_lg',
        // Field ID
        __('Max Column Count (large)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_max_column_count_lg_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );

    add_settings_field(
        'gap',
        // Field ID
        __('Gap (in rem)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_gap_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );

    add_settings_field(
        'bp_md',
        // Field ID
        __('Medium Breakpoint (in rem)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_bp_md_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );


    add_settings_field(
        'bp_lg',
        // Field ID
        __('Large Breakpoint (in rem)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_bp_lg_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );

    add_settings_field(
        'scss_output_style',
        // Field ID
        __('Minify CSS Output  (Default=Yes)', 'adaptive-css-grid-columns'),
        // Field label
        'scss_output_style_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );

    add_settings_field(
        'auto_min_column',
        // Field ID
        __('Minimum width for auto-grid (in rem)', 'adaptive-css-grid-columns'),
        // Field label
        'adaptivecs_auto_min_column_callback',
        // Callback function to render the field
        'adaptivecs_options',
        // Page slug
        'adaptivecs_section' // Section ID
    );


}
add_action('admin_init', 'adaptivecs_register_options');

// Sanitize the options before saving
function adaptivecs_options_sanitize($options)
{
    $sanitized_options = array();
    $sanitized_options['max_column_count_md'] = absint($options['max_column_count_md']);
    $sanitized_options['max_column_count_lg'] = absint($options['max_column_count_lg']);
    $sanitized_options['gap'] = ($options['gap']);
    $sanitized_options['bp_md'] = ($options['bp_md']);
    $sanitized_options['bp_lg'] = ($options['bp_lg']);
    $sanitized_options['scss_output_style'] = ($options['scss_output_style']);
    $sanitized_options['auto_min_column'] = ($options['auto_min_column']);

    return $sanitized_options;
}

// Render the section description
function adaptivecs_section_callback()
{
	echo '<p>' . __('Enter the max column counts for different screen sizes.', 'adaptive-css-grid-columns') . '</p>';
}

// Render the max_column_count_md field
function adaptivecs_max_column_count_md_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[max_column_count_md]" value="' . $options['max_column_count_md'] . '" />';
}

// Render the max_column_count_lg field
function adaptivecs_max_column_count_lg_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[max_column_count_lg]" value="' . $options['max_column_count_lg'] . '" />';
}

// Render the gap field
function adaptivecs_gap_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[gap]" step="0.1" value="' . $options['gap'] . '" />';
}

function adaptivecs_bp_md_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[bp_md]" step="0.1" value="' . $options['bp_md'] . '" />';
}

function adaptivecs_bp_lg_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[bp_lg]" step="0.1" value="' . $options['bp_lg'] . '" />';
}

function adaptivecs_auto_min_column_callback()
{
	$options = get_option('adaptivecs_options');
	echo '<input type="number" name="adaptivecs_options[auto_min_column]" step="0.1" value="' . $options['auto_min_column'] . '" />';
}



// Render the scss_output_style field
function scss_output_style_callback()
{
	$options = get_option('adaptivecs_options');
	$checked = isset($options['scss_output_style']) && $options['scss_output_style'] === 'Yes' ? 'checked="checked"' : '';
	echo '<input type="checkbox" name="adaptivecs_options[scss_output_style]" value="Yes" ' . $checked . '/>';
}



function enqueue_my_styles() {
	wp_enqueue_style( 'my-styles', plugin_dir_url( __FILE__ ) . 'assets/stylesheets/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );

function grid_container_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'columns' => __( '1', 'adaptive-css-grid-columns' ),
			'rows' => __( '1', 'adaptive-css-grid-columns' ),
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
	$scss->setImportPaths( ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/' );
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
 * @return  object|Adaptive_Css_Grid_Columns
 */
function ADAPTIVECS()
{
    //add_action( 'plugins_loaded', 'load_plugin_textdomain' );
    if (is_scss_working()) {
        // SCSS is working, do something
        $message = __("SCSS Compiler is initialized", "adaptive-css-grid-columns");
        //echo "<script>console.log('$message');</script>";

        // Get SCSS file
        $scss = new Compiler(); // Initialize the scssphp compiler
        $scss->setImportPaths(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/');
        //$scss->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::COMPRESSED); //output css to as minified
        // Get the option value from the database for the scss output style


        // Write the SCSS variables to file based on DB values
        $options = get_option('adaptivecs_options', array(
            'bp_md' => 45,
            'bp_lg' => 65,
            'max_column_count_md' => 2,
            'max_column_count_lg' => 4,
            'gap' => 1.5,
            'scss_output_style' => 'Yes',
            'auto_min_column' => 20
        ));
        
        // Set default values if keys are not set
        $bp_md = isset($options['bp_md']) ? $options['bp_md'] : 45;
        $bp_lg = isset($options['bp_lg']) ? $options['bp_lg'] : 65;
        $max_column_count_md = isset($options['max_column_count_md']) ? $options['max_column_count_md'] : 2;
        $max_column_count_lg = isset($options['max_column_count_lg']) ? $options['max_column_count_lg'] : 4;
        $gap = isset($options['gap']) ? $options['gap'] : 1.5;
        $scss_output_style = isset($options['scss_output_style']) ? $options['scss_output_style'] : 'Yes';
        $auto_min_column = isset($options['auto_min_column']) ? $options['auto_min_column'] : 20;
         

        // Set the output style based on the option value
        if ($scss_output_style === 'Yes') {
            $scss->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::COMPRESSED);
        } else {
            $scss->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::EXPANDED);
        }
        $scss_variables = sprintf('$bp-md: %sem;' . PHP_EOL . '$bp-lg: %sem;' . PHP_EOL . '$max-column-count-md: %s;' . PHP_EOL . '$max-column-count-lg: %s;' . PHP_EOL . '$gap: %srem;' . PHP_EOL . '$auto-min-column: %srem;', $bp_md, $bp_lg, $max_column_count_md, $max_column_count_lg, $gap,$auto_min_column);

        $scss_variables_file = fopen(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/_variables.scss', 'w');
        fwrite($scss_variables_file, $scss_variables);
        fclose($scss_variables_file);

        // Combine SCSS files
        $variables_file = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/_variables.scss';
        $mike_style_file = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/mike-style.scss';
        $style_file = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.scss';
        $variables_content = file_get_contents($variables_file);
        $mike_style_content = file_get_contents($mike_style_file);
        $style_content = $variables_content . PHP_EOL . $mike_style_content;
        file_put_contents($style_file, $style_content);

        // Compile SCSS files to CSS
        $scssfile = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.scss';
        $cssfile = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.css';
        $output = $scss->compileString(file_get_contents($scssfile))->getCss();
        file_put_contents($cssfile, $output);

		// Check the result
		if (!file_exists($cssfile)) {
			// There was an error writing the file
			$message = __('Error writing CSS file', 'adaptive-css-grid-columns');
			//echo "<script>console.log('$message');</script>";
		} else {
			// The file was written successfully
			$message = __('CSS file written successfully', 'adaptive-css-grid-columns');
			//echo "<script>console.log('$message');</script>";
		}
	} else {
		// SCSS is not working, do something else
		$message = __("SCSS is NOT working", 'adaptive-css-grid-columns');
		//echo "<script>console.log('$message');</script>";
	}
	
	//plugin updater start
	$myUpdateChecker = PucFactory::buildUpdateChecker(
		'https://github.com/GeorgeWebDevCy/Adaptive-Grid',
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
	
		return Adaptive_Css_Grid_Columns::instance();
}

ADAPTIVECS();
