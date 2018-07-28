<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\NotesBaseController;

/**
 * Class NotesI18n
 * @package DWNotes\App
 */
class NotesI18n extends NotesBaseController
{
	/**
	 *
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
