<?php

namespace DWNotes\Classes;

/**
 * Class NotesBaseController.
 *
 * @property $version
 * @property $plugin_name
 * @property \wpdb $db
 * @property \DWNotes\Classes\NotesLoader   $loader
 * @property \DWNotes\Classes\NotesRegistry $registry
 */
class NotesBaseController
{
    /**
     * @var \DWNotes\Classes\NotesRegistry
     */
    protected $registry;

    public function __construct($registry)
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
