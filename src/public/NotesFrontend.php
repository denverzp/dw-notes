<?php

namespace DW\Frontend;

use DW\Classes\NotesBaseController;

/**
 * Class NotesFrontend.
 */
class NotesFrontend extends NotesBaseController
{
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Dw_Notes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Dw_Notes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        \wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/dw-notes-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Dw_Notes_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Dw_Notes_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        \wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/dw-notes-public.js', array('jquery'), $this->version, false);
    }
}
