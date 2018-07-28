<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\BaseController;

/**
 * Class NotesActivator
 * @package DWNotes\App\Controller
 */
class NotesActivator extends BaseController
{
    public function handle()
    {
        (new NotesCustom($this->registry))->init();
        flush_rewrite_rules();
    }
}
