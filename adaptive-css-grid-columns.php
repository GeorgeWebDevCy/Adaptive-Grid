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
define('ADAPTIVECS_NAME', 'Adaptive CSS Grid Columns');

// Plugin version
define('ADAPTIVECS_VERSION', '1.0.0');

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

use ScssPhp\ScssPhp\Compiler;



// Register a custom menu page to add the options
function adaptivecs_options_page()
{
	add_menu_page(
		'Adaptive CSS Grid Columns Options',
		// Page title
		'ACGC Options',
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
	<div class="wrap">
		<h1>Adaptive CSS Grid Columns Options</h1>
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
		'Max Column Counts',
		// Section title
		'adaptivecs_section_callback',
		// Callback function to render the section
		'adaptivecs_options' // Page slug
	);

	add_settings_field(
		'max_column_count_md',
		// Field ID
		'Max Column Count (medium)',
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
		'Max Column Count (large)',
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
		'Gap (in rem)',
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
		'Medium Breakpoint (in rem)',
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
		'Large Breakpoint (in rem)',
		// Field label
		'adaptivecs_bp_lg_callback',
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

	return $sanitized_options;
}

// Render the section description
function adaptivecs_section_callback()
{
	echo '<p>Enter the max column counts for different screen sizes.</p>';
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

function enqueue_my_styles()
{
	wp_enqueue_style('my-styles', plugin_dir_url(__FILE__) . 'assets/stylesheets/style.css');
}

add_action('wp_enqueue_scripts', 'enqueue_my_styles');

function grid_container_shortcode($atts, $content = null)
{
	$atts = shortcode_atts(
		array(
			'columns' => '1',
			'rows' => '1',
		),
		$atts,
		'grid_container'
	);

	$grid_items = explode(',', $content);
	$grid_items_html = '';

	foreach ($grid_items as $grid_item) {
		$grid_items_html .= '<div class="grid-item">' . trim($grid_item) . '</div>';
	}

	$grid_container_html = '<div class="grid-container">';
	$grid_container_html .= $grid_items_html;
	$grid_container_html .= '</div>';

	return $grid_container_html;
}
add_shortcode('grid_container', 'grid_container_shortcode');


function is_scss_working()
{
	$scss = new Compiler(); // Initialize the scssphp compiler
	$scss->setImportPaths(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/');
	$scss->compileString('@import "style.scss";')->getCss();


	$scss_code = 'body { color: red; }'; // Define a sample SCSS code to compile

	try {
		$css_code = $scss->compileString($scss_code); // Compile the SCSS code into CSS
	} catch (\Exception $e) {
		return false; // If an error occurred, return false
	}

	if (empty($css_code)) {
		return false; // If the compiled CSS code is empty, return false
	}

	return true; // If the SCSS code was successfully compiled, return true
}
function writeToFile($filename, $content) {
	if (!file_exists($filename)) {
	  echo "<script>console.error('File not found: " . $filename . "')</script>";
	  return false;
	}
	
	if (!is_writable($filename)) {
	  echo "<script>console.error('File is not writable: " . $filename . "')</script>";
	  return false;
	}
  
	$file = fopen($filename, "a");
	if ($file === false) {
	  echo "<script>console.error('Unable to open file for writing: " . $filename . "')</script>";
	  return false;
	}
  
	if (fwrite($file, $content) === false) {
	  echo "<script>console.error('Unable to write to file: " . $filename . "')</script>";
	  fclose($file);
	  return false;
	}
  
	fclose($file);
	echo "<script>console.log('Content written successfully to file: " . $filename . "')</script>";
	return true;
  }
  
  
function copyFileContents($sourceFile, $destFile) {
	$sourceHandle = fopen($sourceFile, "r");
	$destHandle = fopen($destFile, "w");
  
	if ($sourceHandle && $destHandle) {
	  while (!feof($sourceHandle)) {
		$buffer = fread($sourceHandle, 4096);
		fwrite($destHandle, $buffer);
	  }
  
	  fclose($sourceHandle);
	  fclose($destHandle);
	  return true;
	} else {
	  return false;
	}
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
	if (is_scss_working()) {
		// SCSS is working, do something
		$message = "SCSS Compiler is initialized";
		echo "<script>console.log('$message');</script>";
		//get scss file

		$scss = new Compiler(); // Initialize the scssphp compiler
		$scss->setImportPaths(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/');
		//$scss->compileString('@import "style.scss";')->getCss();

		// Write the CSS to the file
		$cssfile = fopen(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.css', 'w');
		$scssfile = fopen(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.scss', 'w');
		$scssfile = fopen(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/mike-style.scss', 'r');


		//$result = file_put_contents(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.css', $scss);

		// Check the result
		if ($scssfile === false || $cssfile === false ) {
			// There was an error writing the file

			echo "<script>console.log('$message');</script>";
			$message = 'Error writing CSS file';
			echo "<script>console.log('$message');</script>";
		} else {
			// The file was written successfully
			//get options 
			$options = get_option('adaptivecs_options');
			$scss = new Compiler(); // Initialize the scssphp compiler
			$scss->setImportPaths(ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/');
			/* write vars to file based on db values*/
		    $bp_md = $options['bp_md'];
			$bp_lg = $options['bp_lg'];
			$max_column_count_md = $options['max_column_count_md'];
			$max_column_count_lg = $options['max_column_count_lg'];
			$gap = $options['gap'];
			
			//fwrite($scssfile, $scss->compileString('@import "style.scss";')->getCss());
			$s1 = sprintf('$bp-md: %sem;', $bp_md);
			$s2 = sprintf('$bp-lg: %sem;', $bp_lg);
		    $s3 = sprintf('$max-column-count-md: %s;', $max_column_count_md);
			$s4 = sprintf('$max-column-count-lg: %s;', $max_column_count_lg);
			$s5 = sprintf('$gap: %srem;', $gap);
/* write vars to file based on db values*/
$scssfilename = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/style.scss';
$sourcefilename = ADAPTIVECS_PLUGIN_DIR . 'assets/stylesheets/mike-style.scss';			
writeToFile($scssfilename, $s1);
writeToFile($scssfilename, "\n");
writeToFile($scssfilename, $s2);
writeToFile($scssfilename, "\n");
writeToFile($scssfilename, $s3);
writeToFile($scssfilename, "\n");
writeToFile($scssfilename, $s4);
writeToFile($scssfilename, "\n");
writeToFile($scssfilename, $s5);
writeToFile($scssfilename, "\n");
copyFileContents($sourcefilename,$scssfilename);
//echo fwrite($cssfile, $scss->compileString('@import "mike-style.scss";')->getCss());
			fclose($scssfile);
			fclose($cssfile);
			$message = 'CSS file written successfully';
			echo "<script>console.log('$message');</script>";
			echo "<script>console.log('$s1');</script>";
			echo "<script>console.log('$s2');</script>";
			echo "<script>console.log('$s3');</script>";
			echo "<script>console.log('$s4');</script>";
			echo "<script>console.log('$s5');</script>";

		}



	} else {
		// SCSS is not working, do something else
		$message = "SCSS is NOT working";
		//echo "<script>console.log('$message');</script>";
	}
	return Adaptive_Css_Grid_Columns::instance();
}

ADAPTIVECS();