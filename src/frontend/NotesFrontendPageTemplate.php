<?php

namespace DWNotes\Frontend;

use DWNotes\App\Engine\BaseController;

/**
 * Class NotesFrontendPageTemplate
 * @package DWNotes\Frontend
 */
class NotesFrontendPageTemplate extends BaseController
{
    public function notes_page_template($page_template)
    {
	    if ( is_page( 'notes' ) ) {
		    $page_template = DW_NOTES_DIR. 'frontend/templates/notes-page-template.php';

		    if ( true === file_exists( $page_template ) ) {
			    return $page_template;
		    }
	    }
	    return $page_template;
    }
}
