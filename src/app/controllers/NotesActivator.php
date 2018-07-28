<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\NotesBaseController;

/**
 * Class NotesActivator
 * @package DWNotes\App
 */
class NotesActivator extends NotesBaseController
{
    public function handle()
    {
        (new NotesPostType($this->registry))->init();
        flush_rewrite_rules();
    }
}
