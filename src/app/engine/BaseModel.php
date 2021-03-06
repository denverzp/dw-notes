<?php

namespace DWNotes\App\Engine;

/**
 * Class BaseModel.
 *
 * @property string                              $version
 * @property string                              $plugin_name
 * @property \DWNotes\App\Engine\Registry        $registry
 * @property \wpdb                               $db
 * @property \DWNotes\App\Controller\NotesLoader $loader
 * @property \DWNotes\App\Controller\NotesCustom $custom
 * @property \DWNotes\App\Controller\NotesI18N   $plugin_i18n
 * @property \DWNotes\Admin\NotesAdmin           $plugin_admin
 * @property \DWNotes\Admin\NotesAdminWidgetLatest  $plugin_admin_widget_lates
 * @property \DWNotes\Frontend\NotesFrontend     $plugin_frontend
 */
class BaseModel
{
    /**
     * @var \DWNotes\App\Engine\Registry
     */
    protected $registry;

    public function __construct(Registry $registry)
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
