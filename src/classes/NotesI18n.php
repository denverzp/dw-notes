<?php

namespace DW\Classes;

/**
 * Class NotesI18n
 * @package DW\Classes
 */
class NotesI18n extends NotesBaseController
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {
        \load_plugin_textdomain(
            'dw_notes',
            false,
            DW_NOTES_DIR.'/languages/'
        );
    }
}
