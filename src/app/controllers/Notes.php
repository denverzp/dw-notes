<?php

namespace DWNotes\App\Controller;


use DWNotes\App\Engine\NotesBaseController;
use DWNotes\App\Engine\NotesRegistry;
use DWNotes\Admin\NotesAdmin;
use DWNotes\Frontend\NotesFrontend;

/**
 * Class Notes.
 */
class Notes extends NotesBaseController
{
	/**
	 * Notes constructor.
	 * @param NotesRegistry $registry
	 */
    public function __construct(NotesRegistry $registry)
    {
        parent::__construct($registry);

        if (defined('DW_NOTES_VERSION')) {
            $version = DW_NOTES_VERSION;
        } else {
            $version = '1.0.0';
        }

        $this->registry->set('version', $version);
        $this->registry->set('plugin_name', 'dw_notes');

        $this->load_dependencies();
        $this->custom_types();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies()
    {
        $this->registry->set('notes_type', new NotesPostType($this->registry));

        $this->registry->set('plugin_i18n', new NotesI18n($this->registry));

        $this->registry->set('plugin_admin', new NotesAdmin($this->registry));

        $this->registry->set('plugin_frontend', new NotesFrontend($this->registry));

        $this->registry->set('loader', new NotesLoader($this->registry));
    }

    private function custom_types()
    {
        $this->loader->add_action('init', $this->notes_type, 'init');
    }

    private function set_locale()
    {
        $this->loader->add_action('plugins_loaded', $this->plugin_i18n, 'load_plugin_textdomain');
    }

    private function define_admin_hooks()
    {
        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_scripts');
    }

    private function define_public_hooks()
    {
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_scripts');
    }

    public function run()
    {
        $this->loader->run();
    }

	/**
	 * @return mixed
	 */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

	/**
	 * @return NotesLoader
	 */
    public function get_loader()
    {
        return $this->loader;
    }

	/**
	 * @return mixed
	 */
    public function get_version()
    {
        return $this->version;
    }
}
