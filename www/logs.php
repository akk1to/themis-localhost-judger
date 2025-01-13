<?php
	include("init.php");
	include("config.php");
	$dir = opendir($logsDir);
	$session = $user['username'];
	while ($file = readdir($dir)) {
		$pos = strpos($file,"[".$session."]");
		if ($pos > 0) {
			echo "<p>";
			if ($publish == 1) echo "&raquo; <a href='download.php?file=".$file."'>".substr($file,$pos+strlen($session)+2)."</a> (";
			else echo "&raquo; <a href='#'>".substr($file,$pos+strlen($session)+2)."</a> (";
			if (strpos($file,".log") > 0 || strpos($file,".LOG") > 0) {
				if ($publish == 1) {
					$finp = fopen($logsDir."/".$file,"r");
					$str = substr(fgets($finp),strlen($session)+3);
					fclose($finp);
				}	
				else $str = "Đã chấm xong!";
			}	
			else $str = "Đang đợi chấm...";
			echo $str.")";
			echo "</p>";
		}
	}
?>

