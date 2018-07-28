<?php

/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @see              ditsweb.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Notes
 * Plugin URI:        //ditsweb.com/dw_notes
 * Description:       This plugin allow create notes and organize it.
 * Version:           1.0.0
 * Author:            ditsweb
 * Author URI:        ditsweb.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dw_notes
 * Domain Path:       /src/languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// autoload
require __DIR__.'/vendor/autoload.php';

define('DW_NOTES_VERSION', '1.0.0');
define('DW_NOTES_APP', __FILE__);
define('DW_NOTES_DIR', __DIR__.'/src/');
define('DW_NOTES_URL', plugin_dir_url(__FILE__).'/src/');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-NotesActivator.php.
 */
function activate_dw_notes()
{
    \DW\Classes\NotesActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-NotesDeactivator.php.
 */
function deactivate_dw_notes()
{
    require_once DW_NOTES_DIR.'classes/NotesDeactivator.php';
    \DW\Classes\NotesDeactivator::deactivate();
}

\register_activation_hook(DW_NOTES_APP, 'activate_dw_notes');
\register_deactivation_hook(DW_NOTES_APP, 'deactivate_dw_notes');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dw_notes()
{
	// NotesRegistry
	$registry = new \DW\Classes\NotesRegistry();

    $plugin = new \DW\Classes\Notes($registry);
    $plugin->run();
}

run_dw_notes();
