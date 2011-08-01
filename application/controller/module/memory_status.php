<?php
class ControllerModuleMemoryStatus extends Controller
{

	public function index()
	{
		$this->getStats();
		$this->id='memory_status';

		$this->render();
	}

	private function getStats()
	{
		$this->ramTotal =  exec("free -mto | grep Mem: | awk '{ print $2 }'");
		$this->ramUsed =  exec("free -mto | grep Mem: | awk '{ print $3 }'");
		$this->ramFree =  exec("free -mto | grep Mem: | awk '{ print $4 }'");
		$this->ramCached =  exec("free -mto | grep Mem: | awk '{ print $7 }'");
		$this->ramBuffered = exec("free -mto | grep Mem: | awk '{ print $6 }'");
		$this->ramUsed = $this->ramUsed - $this->ramCached - $this->ramBuffered;
		$this->ramFree = $this->ramFree + $this->ramCached + $this->ramBuffered;
		$this->ramPercent = round(($this->ramUsed / $this->ramTotal)*25,2);
		$this->ramBufferedPercent = round(($this->ramBuffered / $this->ramTotal)*25,2);
		$this->ramCachedPercent = round(($this->ramCached / $this->ramTotal)*25,2);
		$this->ramFreePercent = round((($this->ramFree-$this->ramBuffered-$this->ramCached) / $this->ramTotal)*25,2);

		$this->data['ramTotal']=$this->ramTotal;
		$this->data['ramUsed']=$this->ramUsed;
		$this->data['ramFree']=$this->ramFree;
		$this->data['ramCached']=$this->ramCached;
		$this->data['ramBuffered']=$this->ramBuffered;
		$this->data['ramPercent']=$this->ramPercent;
		$this->data['ramBufferedPercent']=$this->ramBufferedPercent;
		$this->data['ramCachedPercent']=$this->ramCachedPercent;
		$this->data['ramFreePercent']=$this->ramFreePercent;
	}

	public function generateGraph($color1="green",$color2="blue",$color3="red",$color4="white")
	{
		$output="";
		$output.= '[';

		$output.= '<font color="'.$color1.'"><b>';
		for($i=0;$i<=$this->$ramPercent;$i++)
		  $output.= '|';
		$output.= '</b></font>';

		$output.= '<font color="'.$color2.'"><b>';
		for($i=0;$i<=$this->ramBufferedPercent;$i++)
		  $output.= '|';
		$output.= '</b></font>';

		$output.= '<font color="'.$color3.'"><b>';
		for($i=0;$i<=$this->ramCachedPercent;$i++)
		  $output.= '|';
		$output.= '</b></font>';

		$output.= '<font color="'.$color4.'"><b>';
		for($i=0;$i<=$this->ramFreePercent;$i++)
		  $output.= '&nbsp';
		$output.= '</b></font>';

		$output.= ']';
		return $output;
	}
}
?>