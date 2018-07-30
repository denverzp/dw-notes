<?php

namespace DWNotes\Frontend;

use DWNotes\App\Engine\BaseController;
use DWNotes\App\Models\User;
use function DWNotes\App\Engine\view;

/**
 * Class NotesFrontend
 * @package DWNotes\Frontend
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
		\wp_enqueue_style($this->plugin_name, DW_NOTES_URL . 'frontend/css/dw-notes-frontend.css', [], $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		\wp_enqueue_script('dw_notes_jsrender', DW_NOTES_URL . 'frontend/js/jsrender.min.js', ['jquery'], $this->version, true);
		\wp_enqueue_script($this->plugin_name, DW_NOTES_URL . 'frontend/js/dw-notes-frontend.js', ['jquery'], $this->version, true);

		$ajax_data = [
			'is_auth'   => 0,
			'auth_form' => $this->auth_form()
		];

		if (\is_user_logged_in()) {

			$current_user = wp_get_current_user();

			// get custom basic auth password
			$user = new User($this->registry);
			$user_hash = $user->get_hash($current_user);

			$ajax_data = [
				'is_auth'       => 1,
				'rest_route'    => 'wp-json',
				'rest_endpoint' => 'wp/v2/dw-notes',
				'security'      => wp_create_nonce($this->plugin_name),
				'user_id'       => null !== $current_user ? $current_user->ID : null,
				'username'      => null !== $current_user ? $current_user->user_login : null,
				'password'      => null !== $current_user ? $user_hash : null,
				'text'          => [
					'search' => __('Search', 'dw_notes'),
					'pad'    => __('Pad', 'dw_notes'),
				]
			];
		}

		\wp_localize_script($this->plugin_name, 'ajax_data', $ajax_data);
	}

	private function auth_form()
	{
		$data = [
			'auth_url'      => esc_url(site_url('wp-login.php', 'login_post')),
			'redirect_url'  => esc_url(get_page_link(get_option('dw_notes_page_id'))),
			'text_login'    => __('Username or Email Address', 'dw_notes'),
			'text_password' => __('Password', 'dw_notes'),
			'text_remember' => __(' Remember Me', 'dw_notes'),
			'text_log_in'   => __('Log In', 'dw_notes'),
			'text_alert'   => __('To use this page you need to login!', 'dw_notes'),
		];

		return view('frontend/templates/dw-notes-auth.tmpl', $data);
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
		// check custom basic auth
		$is_user = $user->auth($username, $password);

		if (!$is_user) {
			$wp_json_basic_auth_error = 'Unauthorized';

			return null;
		}

		$wp_json_basic_auth_error = true;

		return $is_user->ID;
	}

	/**
	 * @source https://github.com/WP-API/Basic-Auth
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
