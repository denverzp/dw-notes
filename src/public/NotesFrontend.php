<?php

namespace DWNotes\Frontend;

use DWNotes\App\Engine\BaseController;

/**
 * Class NotesFrontend.
 */
class NotesFrontend extends BaseController
{
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        \wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/dw-notes-public.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        \wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/dw-notes-public.js', ['jquery'], $this->version, false);
    }
}
