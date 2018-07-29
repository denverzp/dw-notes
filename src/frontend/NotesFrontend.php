<?php

namespace DWNotes\Frontend;

use DWNotes\App\Engine\BaseController;
use DWNotes\App\Models\User;

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
	    if('dw_notes' !== get_query_var('post_type')){
		    return;
	    }

        \wp_enqueue_style($this->plugin_name, DW_NOTES_URL.'frontend/css/dw-notes-public.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
    	if('dw_notes' !== get_query_var('post_type')){
    		return;
	    }

        \wp_enqueue_script($this->plugin_name, DW_NOTES_URL.'frontend/js/dw-notes-frontend.js', ['jquery'], $this->version, false);

        $current_user = null;
        if (\is_user_logged_in()) {
            $current_user = wp_get_current_user();

	        $user = new User($this->registry);
	        $user_hash = $user->get_hash($current_user);
        }

        \wp_localize_script($this->plugin_name, 'ajax_data',
            [
                'route' => 'wp-json',
                'endpoint' => 'wp/v2/dw-notes',
                'security' => wp_create_nonce($this->plugin_name),
                'user' => null !== $current_user ? $current_user->user_login : null,
	            'password' => null !== $current_user ? $user_hash : null
            ]
        );
    }

    /**
     * @source https://github.com/WP-API/Basic-Auth
     */
    public function json_basic_auth_handler($user)
    {
        global $wp_json_basic_auth_error;

        $wp_json_basic_auth_error = null;

        // Don't authenticate twice
        if (!empty($user)) {
            return $user;
        }

        // Check that we're trying to authenticate
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            return $user;
        }

        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        $user = new User($this->registry);
        $is_user = $user->auth($username, $password);

        if (!$is_user) {
            $wp_json_basic_auth_error = 'Unauthorized';

            return null;
        }

        $wp_json_basic_auth_error = true;

        return $is_user->ID;
    }

    /**
     *  @source https://github.com/WP-API/Basic-Auth
     */
    public function json_basic_auth_error($error)
    {
        // Passthrough other errors
        if (!empty($error)) {
            return $error;
        }

        global $wp_json_basic_auth_error;

        return $wp_json_basic_auth_error;
    }
}
