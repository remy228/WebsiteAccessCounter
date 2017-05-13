<!DOCTYPE html>
<html>
<head><title>Display</title></head>

	<body>
	<?php
	session_start();
	function messageController()
	{
	  if(isset($_SERVER['PATH_INFO']))
	   {
			$data=$_SERVER['PATH_INFO'];
			render($data);
		}
	}
	function render($data)
	{
	   // $data has any data set up from the controller
	   //outputs the message form

		$path_info=$_SERVER['PATH_INFO'];
		$path_translated=$_SERVER['PATH_TRANSLATED'];

		$request_method= $_SERVER['REQUEST_METHOD'];
		$request_time= $_SERVER['REQUEST_TIME'];

		$ip1=$_SERVER["REMOTE_ADDR"];
		$ip= gethostbyaddr($ip1);

		$split = explode('/', "$path_info");
		$path=$split[1];
		$inf=split("[.]", $path_info);
		$html="html";
		$jpeg="jpg";
		$data=array($path,$request_time,$ip);
		$d= implode(" ",$data);
		counter($path,$d);

		if ($inf[1] == $html)
		{
		echo "Content-Type:text/html";

		?>

		
		<meta http-equiv="refresh" CONTENT="2;URL=../Model/readfilehtml.php?p1=<?php echo "../View/".$path ?>"/>;
		
		<?php
		}
		else if($inf[1] == $jpeg)
		{	
		echo "Content-Type:Image/JPEG";
		?>

		
		<META HTTP-EQUIV="refresh" CONTENT="2;URL=../Model/readfile.php?p1=<?php echo "../View/".$path ?>"/>;
		
		<?php
		}
		else
		{
			print "Only html and jpeg images are allowed";
		}


	}
	function counter($path,$d)
	{
		 $fh=fopen("..//data/counts.txt","a");
			 fwrite($fh,$d."\n");
			 fclose($fh);   
	}
	messageController();
	?>
	</body>
</html>
