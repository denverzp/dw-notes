<?php

namespace DWNotes\Classes;

use DWNotes\Admin\NotesAdmin;
use DWNotes\Frontend\NotesFrontend;

/**
 * Class Notes.
 */
class Notes extends NotesBaseController
{
    /**
     * Notes constructor.
     *
     * @param $registry
     */
    public function __construct($registry)
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

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Dw_Notes_Loader. Orchestrates the hooks of the plugin.
     * - Dw_Notes_i18n. Defines internationalization functionality.
     * - Dw_Notes_Admin. Defines all hooks for the admin area.
     * - Dw_Notes_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function load_dependencies()
    {
        $this->registry->set('notes_type', new NotesPostType());

        $this->registry->set('plugin_i18n', new NotesI18n($this->registry));

        $this->registry->set('plugin_admin', new NotesAdmin($this->registry));

        $this->registry->set('plugin_frontend', new NotesFrontend($this->registry));

        $this->registry->set('loader', new NotesLoader($this->registry));
    }

	/**
	 * Add custom types
	 */
    private function custom_types()
    {
        $this->loader->add_action('init', $this->notes_type, 'init');
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Dw_Notes_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function set_locale()
    {
        $this->loader->add_action('plugins_loaded', $this->plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_admin_hooks()
    {
        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_public_hooks()
    {
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     *
     * @return string the name of the plugin
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     *
     * @return \DWNotes\Classes\NotesLoader orchestrates the hooks of the plugin
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     *
     * @return string the version number of the plugin
     */
    public function get_version()
    {
        return $this->version;
    }
}
