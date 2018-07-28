<?php

namespace DW\Classes;

/**
 * Class NotesBaseController
 * @package DW\Classes
 *
 * @property $version
 * @property $plugin_name
 * @property \DW\Classes\NotesLoader $loader
 * @property \DW\Classes\NotesRegistry $registry
 */
class NotesBaseController {

	/**
	 * @var \DW\Classes\NotesRegistry
	 */
	protected $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}

	public function __isset($key) {
		return $this->registry->has($key);
	}
}