<?php
abstract class Controller
{
	protected $registry;
	protected $id;
	protected $template;
	protected $children = array();
	protected $data = array();
	protected $output;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}

	protected function render($return = FALSE) {
		foreach ($this->children as $child) {
			$action = new Action($child);
			$file   = $action->getFile();
			$class  = $action->getClass();
			$method = $action->getMethod();
			$args   = $action->getArgs();

			if (file_exists($file)) {
				require_once($file);

				$file_path=str_replace(DIR_APPLICATION . 'controller/',"",$file);
				$pos = strrpos($file_path, ".php");
				$file_path = substr($file_path,0,$pos);

				$this->registry->set("child_location",$file_path);
				$controller = new $class($this->registry);

				$controller->index();

				$this->data[$controller->id] = $controller->output;
			} else {
				exit('Error: Could not load controller ' . $child . '!');
			}
		}
		if ($return) {
			return $this->fetch($this->parent_location);
		} else {
			$this->output = $this->fetch($this->child_location,true);
			$this->template_location="";
		}
	}

	protected function fetch($filename,$child=false) {
		if($this->error->route && !$child)
			$filename=$this->error->route;

		if($this->child_location=="" && $child)
			exit('Error: Direct access not allowed !');

		$file = DIR_TEMPLATE . $this->config->template . '/view/' . $filename . '.tpl';


		if (file_exists($file)) {
			extract($this->data);

      		ob_start();

	  		require($file);

	  		$content = ob_get_contents();

      		ob_end_clean();

      		return $content;
    	} else {
    		//exit('Error: Could not load template "' . $file . '" !');
      		exit('Error: Could not load template "' . $this->config->template . '" !');
    	}
	}
}
?>