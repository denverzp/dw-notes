<?php

namespace DWNotes\Frontend;

use DWNotes\App\Engine\BaseController;
use function DWNotes\App\Engine\view;

/**
 * Class NotesFrontendShortcodes
 * @package DWNotes\Frontend
 */
class NotesFrontendShortcodes extends BaseController
{
    public function notes_shortcode()
    {
	    echo view('frontend/templates/dw-notes-shortcode.tmpl', []);
    }
}
