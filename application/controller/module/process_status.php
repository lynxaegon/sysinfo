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
		$ret = array();
		$i=0;
		foreach($process as $key => $value)
		{
			$ret[$i]['name'] = $key;
			$ret[$i]['status'] = exec("scripts/checkprocess.sh '".$value."'");
			if($ret[$i]['status'] == "online")
			{
				$ret[$i]['ramUsage'] = exec("scripts/ramusage.sh '".$value."'")/1024;
				$ret[$i]['ramUsage'] = ceil($ret[$i]['ramUsage'])." MB";
			}
			else
				$ret[$i]['ramUsage'] = "";
			$i++;
			//$process[$key]=exec("scripts/checkprocess.sh '".$value."'");
		}
		return $ret;
		//return $process;
	}
}
?>

