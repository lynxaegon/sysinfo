<?php
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->id = 'footer';
		$this->data["version"] = $this->config->version;
		$this->render();
	}
}
?>
