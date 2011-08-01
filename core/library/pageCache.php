<?php
class PageCache
{

	private $filename;

	public function __construct( $file=false )
	{
		if(!$file)
			$file=basename($_SERVER['PHP_SELF']);
		$this->filename=$file;
	}

	public function read($expiry=10)
	{
		if (file_exists(DIR_CACHE . $this->filename.".cache"))
		{
			if ((time() - $expiry) > filemtime(DIR_CACHE . $this->filename.".cache"))
			{
				return false;
			}
			$cache = file(DIR_CACHE . $this->filename.".cache");
			return implode('', $cache);
		}
		return false;
	}

	public function write($content="")
	{
		$fp = fopen(DIR_CACHE . $this->filename . '.cache', 'w');
		fwrite($fp, $content);
		fclose($fp);
	}

	public function start($expiry=10)
	{
		if($header = $this->read($expiry))
		{
		  echo $header;
		  exit();
		}
		ob_start();
	}

	public function stop($writeFile=true,$showContents=true)
	{
		if($writeFile)
		   $this->write(ob_get_contents());
		
		if($showContents)
			ob_end_flush();
		else
			ob_clean();
	}
}
?>
