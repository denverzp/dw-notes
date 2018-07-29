<?php

namespace DWNotes\App\Controller;

use DWNotes\App\Engine\BaseController;
use DWNotes\App\Engine\Registry;
use DWNotes\Admin\NotesAdmin;
use DWNotes\Admin\NotesAdminWidgetLatest;
use DWNotes\Frontend\NotesFrontend;
use DWNotes\Frontend\NotesFrontendShortcodes;
use DWNotes\Frontend\NotesFrontendPageTemplate;

/**
 * Class Notes.
 */
class Notes extends BaseController
{
    /**
     * Notes constructor.
     *
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
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
        $this->registry->set('notes_type', new NotesCustom($this->registry));

        $this->registry->set('loader', new NotesLoader($this->registry));

        $this->registry->set('plugin_i18n', new NotesI18n($this->registry));

        $this->registry->set('plugin_admin', new NotesAdmin($this->registry));

        $this->registry->set('plugin_admin_widget_lates', new NotesAdminWidgetLatest($this->registry));

        $this->registry->set('plugin_frontend', new NotesFrontend($this->registry));

        $this->registry->set('plugin_frontend_shortcodes', new NotesFrontendShortcodes($this->registry));

        $this->registry->set('plugin_frontend_page_template', new NotesFrontendPageTemplate($this->registry));
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

        $this->loader->add_action('wp_dashboard_setup', $this->plugin_admin_widget_lates, 'add_widget');
    }

    private function define_public_hooks()
    {
    	// shortcodes
        $this->loader->add_shortcode('notes', $this->plugin_frontend_shortcodes, 'notes_shortcode');

        // custom template
	    $this->loader->add_filter('template_include', $this->plugin_frontend_page_template, 'notes_page_template', 99);

        /*
		 * REST Basic Auth
		 * @source https://github.com/WP-API/Basic-Auth
		 */
        $this->loader->add_filter('determine_current_user', $this->plugin_frontend, 'json_basic_auth_handler');
        $this->loader->add_filter('rest_authentication_errors', $this->plugin_frontend, 'json_basic_auth_error');

        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_frontend, 'enqueue_scripts');
    }

    public function run()
    {
        $this->loader->run();
    }

    /**
     * @return string
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
     * @return string
     */
    public function get_version()
    {
        return $this->version;
    }
}
