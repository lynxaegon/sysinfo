<?php
class ControllerModuleNetworkStatus extends Controller
{

	public function index()
	{
		$this->script = exec('scripts/netspeed.sh venet0');
		$this->getStats();
		$this->id='network_status';
		$this->render();
	}

	private function getStats()
	{
		$pos=strpos($this->script,"|");
		$this->data['upload']=substr($this->script,0,$pos);
		$this->script=substr($this->script,$pos+1);

		$pos=strpos($this->script,"|");
		$this->data['download']=substr($this->script,0,$pos);
		$this->script=substr($this->script,$pos+1);

		$pos=strpos($this->script,"|");
		$this->data['totalUpload']=substr($this->script,0,$pos);
		$this->script=substr($this->script,$pos+1);

		$this->data['totalDownload']=substr($this->script,0);
	}
}
?>
