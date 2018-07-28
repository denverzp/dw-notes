<?php

namespace DWNotes\Admin;

use DWNotes\Classes\NotesBaseController;

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
        \wp_enqueue_style($this->plugin_name, DW_NOTES_URL.'admin/css/dw-notes-admin.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        \wp_enqueue_script($this->plugin_name, DW_NOTES_URL.'admin/js/dw-notes-admin.js', ['jquery'], $this->version, false);
    }
}
