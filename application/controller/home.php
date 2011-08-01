<?php
class ControllerHome extends Controller
{
	public function index()
	{
		$this->children = array(
			'common/header',
			'common/footer',
			);
		$this->children[]='module/server_details';
		$this->children[]='module/network_status';
		$this->children[]='module/memory_status';
		$this->children[]='module/disk_status';
		$this->children[]='module/process_status';

		$this->template = 'default/view/home.tpl';
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
}
?>
