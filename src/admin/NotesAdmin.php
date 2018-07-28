<?php

namespace DW\Admin;

use DW\Classes\NotesBaseController;

/**
 * The admin-specific functionality of the plugin.
 *
 * @see       ditsweb.com
 * @since      1.0.0
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     ditsweb <dits.web.2017@gmail.com>
 */
class NotesAdmin extends NotesBaseController
{
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Dw_Notes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Dw_Notes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        \wp_enqueue_style($this->plugin_name, DW_NOTES_URL.'admin/css/dw-notes-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Dw_Notes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Dw_Notes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        \wp_enqueue_script($this->plugin_name, DW_NOTES_URL.'admin/js/dw-notes-admin.js', array('jquery'), $this->version, false);
    }
}
