<?php
class ControllerModuleDiskStatus extends Controller
{
	public function index()
	{
		//$config->load("disk_status");
		$this->disk="/";
		$this->getStats();
		$this->id='disk_status';

		$this->render();
	}

	private function getStats()
	{
		$diskTotal = disk_total_space($this->disk);
		$diskFree = disk_free_space($this->disk);
		$diskUsed = $diskTotal - $diskFree;
		$diskPercent = round(($diskUsed / $diskTotal)*25,2);
		$diskFreePercent = round(($diskFree / $diskTotal)*25,2);
		$this->data['diskTotal']=$diskTotal;
		$this->data['diskFree']=$diskFree;
		$this->data['diskUsed']=$diskUsed;
		$this->data['diskPercent']=$diskPercent;
		$this->data['diskFreePercent']=$diskFreePercent;
	}
}
?>