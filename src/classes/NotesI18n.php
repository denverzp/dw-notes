<?php

namespace DW\Classes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @see       ditsweb.com
 * @since      1.0.0
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @author     ditsweb <dits.web.2017@gmail.com>
 */
class NotesI18n
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            'dw-notes',
            false,
            DW_NOTES_DIR.'/languages/'
        );
    }
}
