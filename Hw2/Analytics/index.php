<!DOCTYPE html>
<!-- Drop down menu for selection -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Web Analytics</title>
		<link rel = "stylesheet" href="site.css">
		<meta http-equiv="refresh" content="20">
	</head>
	<body>
	<h1> Web-Site Analytics </h1> 
	
	<form name ="analytics" method="post" action = "index.php">
	<label for ="select">Select a time-period</label>
	<select name = "event" id="select"> 
		<option value = "10"  > Last 10 Seconds </option>
		<option value = "60"  > Last Minute </option>
		<option value = "360" > Last Hour </option>
		<option value = "All" > All Time </option>
	</select>
	<input name="Go" type="submit" value="Go">

	<br>
	<br>
	<br>
	<?php
	$currTime=$_SERVER['REQUEST_TIME'];
	if(!isset($_POST['Go']))
	{
	retrieveCounts(0);
	}
	else if(isset($_POST['Go']))
	{
		myFunc($currTime);
	}

	#Calculating the time interval selected for displaying the graphs
	function myFunc($currTime)
	{ 
		$event = $_POST['event'];	
		switch ($event) 
		{
			case 10:
				$timeCalc=($currTime)-10;
				retrieveCounts($timeCalc);
				break;
				
			case 60:
				$timeCalc=($currTime)-60;
				retrieveCounts($timeCalc);
				break;
			case 360:
				$timeCalc=($currTime)-3600;
				retrieveCounts($timeCalc);
				break;
			case 'All':
				retrieveCounts(0);
				break;
			default:
				retrieveCounts(0);
				break;
			   
		}
	}	

	function retrieveCounts($time)
	{
		
		$fh = fopen("..//data/counts.txt","r");
			  
		$lines = file("..//data/counts.txt");
		$stack =[];
		$ipstack=[];
		// Loop through our array, show HTML source as HTML source; and line numbers too.
		foreach ($lines as $line_num => $line)
		{
				  
				   $pieces = explode(" ", $line);
				 
				  if($pieces[1]>=$time)
				  {
					array_push($stack,$pieces[0]);
			array_push($ipstack,$pieces[2]);
				   }
			  

		}
	$webcount=array_count_values($stack);
	$ipcount=array_count_values($ipstack);


	arsort($webcount);
	arsort($ipcount);
		
	fclose($fh);

	#displaying the bar graphs dynamically based on count
	barGraph1($webcount);
	barGraph2($ipcount);	
	}

	function barGraph1($webcount)
	{
		foreach ($webcount as $x=> $y)
		{	
			$widthVal=$y*20;
	?>
		<table>
		<tr> 
			<td><b> <?php echo "Web-Site Name:"?></b> <br> </td>
			<td><b> <?php echo $x; ?> </b></td>
			<td> </td>
		</tr>
		<tr>
			<td><b> <?php echo "No. of Times Downloaded:" ?> </b></td>
			<td><b> <?php echo $y; ?> </b></td>
			<td> <div id= "Bar1" style="width: <?php echo $widthVal; ?>px;"> </div>
		</tr>
		</table>
		<br>
		<br>
		<br>
	<?php 
		
		}
	}

	function barGraph2($ipcount)
	{

		foreach ($ipcount as $x => $y)
		{
			
			$widthVal=$y*20;
	?>  
		<table>
		<tr> 
			<td><b> <?php echo "IP Address:"?></b> <br> </td>
			<td><b> <?php print $x; ?></b> </td>
			<td>  </td>
		</tr>
		<tr>
			<td><b> <?php echo "No. of Times Downloaded:" ?></b> </td>
			<td><b> <?php echo $y; ?></b> </td>
			<td> <div id= "Bar2" style="width: <?php echo $widthVal; ?>px;"> </div>
		</tr>
		</table>
		</form>
	</body>
</html>		

<?php 
	
	}
}
