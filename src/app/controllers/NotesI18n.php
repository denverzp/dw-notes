<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\BaseController;

/**
 * Class NotesI18n
 * @package DWNotes\App
 */
class NotesI18n extends BaseController
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
