<?php
class ControllerModuleServerDetails extends Controller
{
	public function index()
	{
		$this->data['uptime']=$this->getUptime();
		$this->data['temperature']=$this->getTemperature();
		$this->data['cpuModel']=$this->getCpuModel();
		$this->data['distribution']=$this->getDistribution();
		$this->data['wanIP']=$this->getWanIP();
		$this->id='server_details';
		$this->render();
	}
	public function getUptime()
	{
		$uptime = exec("cat /proc/uptime");
		$uptime = split(" ",$uptime);
		$uptimeSecs = $uptime[0];

		return $this->format_uptime($uptimeSecs);
	}

	public function getTemperature()
	{
		$temperature = exec("cat /proc/acpi/thermal_zone/THRM/temperature | awk '{print $2$3}'");
		if(!$temperature)
			$temperature = "Unkown";
		return $temperature;
	}

	public function getCpuModel()
	{
		$cpu = exec("cat /proc/cpuinfo | grep 'model name'");
		$cpu = substr($cpu,strpos($cpu,":")+1);
		$cpuNr = exec("ls /proc/acpi/processor | wc -l");

		if(!$cpu)
			$cpu = "Unkown";
		return ($cpuNr>1?$cpuNr."x ":"").$cpu;
	}

	public function getDistribution()
	{
		$distributionName = exec("lsb_release -d");
		$distributionName = substr($distributionName,strpos($distributionName,":")+1);
		$distributionCodeName = exec("lsb_release -c");
		$distributionCodeName = substr($distributionCodeName,strpos($distributionCodeName,":")+1);
		if(!$distributionName)
			$distributionName="Unkown";
		if(!$distributionCodeName)
			$distributionCodeName="Unkown";
		return $distributionName." (".ucfirst(trim($distributionCodeName)).")";
	}

	public function getWanIP()
	{
		$externalIp = exec("curl -L -s --max-time 10 http://checkip.dyndns.org | egrep -o -m 1 '([[:digit:]]{1,3}\.){3}[[:digit:]]{1,3}'");

		return $externalIp;
	}

	private function format_uptime($seconds)
	{
		$secs = intval($seconds % 60);
		$mins = intval($seconds / 60 % 60);
		$hours = intval($seconds / 3600 % 24);
		$days = intval($seconds / 86400);

		if ($days > 0) {
			$uptimeString .= $days;
			$uptimeString .= (($days == 1) ? " day" : " days");
		}
		if ($hours > 0) {
			$uptimeString .= (($days > 0) ? ", " : "") . $hours;
			$uptimeString .= (($hours == 1) ? " hour" : " hours");
		}
		if ($mins > 0) {
			$uptimeString .= (($days > 0 || $hours > 0) ? ", " : "") . $mins;
			$uptimeString .= (($mins == 1) ? " minute" : " minutes");
		}
		if ($secs > 0) {
			$uptimeString .= (($days > 0 || $hours > 0 || $mins > 0) ? ", " : "") . $secs;
			$uptimeString .= (($secs == 1) ? " second" : " seconds");
		}
		return $uptimeString;
	}
}
?>