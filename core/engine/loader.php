<?php
final class Loader {
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

	public function view($view) {
		echo $view;
	}

	public function config($config) {
		$this->config->load($config);
	}

	public function library($library) {
		$file = DIR_SYSTEM . '/library/' . $library . '.php';

		if (file_exists($file)) {
			include_once($file);
		} else {
			exit('Error: Could not load library ' . $library . '!');
		}
	}
}
?>