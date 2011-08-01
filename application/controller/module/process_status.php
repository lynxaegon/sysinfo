<?php
class ControllerModuleProcessStatus extends Controller
{
	public function index()
	{
		$this->config->load("module/process_status");
		/*$process[] = array("name" => "Apache", "pid" => "apache2");
		$process[] = array("name" => "Mysql", "pid" => "mysqld");
		$process[] = array("name" => "Deluge", "pid" => "deluged");
		$process[] = array("name" => "Deluge Web", "pid" => "deluge-web");*/
		$this->data['process']=$this->checkProcess($this->config->process);
		$this->id='process_status';
		$this->render();
	}

 	private function checkProcess($process)
	{
		if(!$process)
			return false;
		foreach($process as $key => $value)
		{
			$process[$key]=exec("scripts/checkprocess.sh '".$value."'");
		}
		return $process;
	}
}
?>

