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

// use
use DWNotes\App\Engine\Registry;
use DWNotes\App\Controller\NotesActivator;
use DWNotes\App\Controller\NotesDeactivator;
use DWNotes\App\Controller\Notes;

if (!function_exists('init_dw_notes')) {
    function init_dw_notes()
    {
        global $wpdb, $registry;

        // NotesRegistry
        $registry = new Registry();

        $registry->set('db', $wpdb);
    }
}

/*
 * The code that runs during plugin activation.
 * This action is documented in includes/class-NotesActivator.php.
 */
if (!function_exists('activate_dw_notes')) {
    function activate_dw_notes()
    {
        global $registry;

        (new NotesActivator($registry))->handle();
    }
}

/*
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-NotesDeactivator.php.
 */
if (!function_exists('deactivate_dw_notes')) {
    function deactivate_dw_notes()
    {
        global $registry;

        (new NotesDeactivator($registry))->handle();
    }
}

\register_activation_hook(DW_NOTES_APP, 'activate_dw_notes');
\register_deactivation_hook(DW_NOTES_APP, 'deactivate_dw_notes');

/*
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
if (!function_exists('run_dw_notes')) {
    function run_dw_notes()
    {
        global $registry;

        $plugin = new Notes($registry);
        $plugin->run();
    }
}

init_dw_notes();

run_dw_notes();
