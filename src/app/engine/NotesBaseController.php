<?php

namespace DWNotes\App\Engine;

use \DWNotes\App\Engine\NotesRegistry;

/**
 * Class NotesBaseController.
 *
 * @property $version
 * @property $plugin_name
 * @property \DWNotes\App\Engine\NotesRegistry $registry
 * @property \wpdb $db
 * @property \DWNotes\App\Controller\NotesLoader $loader
 * @property \DWNotes\App\Controller\NotesPostType $notes_type
 * @property \DWNotes\App\Controller\NotesI18n $plugin_i18n
 * @property \DWNotes\Admin\NotesAdmin $plugin_admin
 * @property \DWNotes\Frontend\NotesFrontend $plugin_frontend
 */
class NotesBaseController
{
    /**
     * @var \DWNotes\App\Engine\NotesRegistry
     */
    protected $registry;

    public function __construct(NotesRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function __get($key)
    {
        return $this->registry->get($key);
    }

    public function __set($key, $value)
    {
        $this->registry->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->registry->has($key);
    }
}
