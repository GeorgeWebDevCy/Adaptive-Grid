<?php
/**
 * Check for updates using the plugin-update-checker library.
 */
function gm_adapive_grid_check_for_updates() {
    // Include the plugin-update-checker library
    require_once plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php';

    // Create a new instance of the update checker for GitHub
    $m$myUpdateChecker = PucFactory::buildUpdateChecker(
        'https://github.com/GeorgeWebDevCy/Adaptive-Grid',
        __FILE__,
        'adaptive-css-grid-columns'
    );
    
    //Set the branch that contains the stable release.
    $myUpdateChecker->setBranch('main');

    // Get the current version of the plugin
    $current_version = get_option( 'adaptivecs_version' );

    // Get the latest version of the plugin from GitHub
    $latest_version = $myUpdateChecker->getLatestVersion();

    // Compare the current version with the latest version
    if ( version_compare( $current_version, $latest_version, '>=' ) ) {
        // The latest version is already installed
        add_filter( 'install_plugin_complete_actions', function( $actions, $plugin ) {
            // Modify the "Install Now" button text to say "Latest Version Already Installed"
            $actions['activate'] = '<b>Latest Version Already Installed</b>';
            return $actions;
        }, 10, 2 );
    } else {
        // An update is available, store the latest version in the options table
        update_option( 'adaptivecs_version', $latest_version );
    }
}

// Call the update checker function on plugin load
add_action( 'plugins_loaded', 'gm_adapive_grid_check_for_updates' );




