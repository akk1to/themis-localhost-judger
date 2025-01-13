<?php
	include("init.php");
	include("config.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
if (((date_timestamp_get($startTime) + $duringTime*60 - time() > 0)) || ($duringTime == 0)) {
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ( !$_FILES["file"]["name"] ) 
		{$message = "LỖI: Chưa chọn file.\\n";}
	else if ($_FILES["file"]["size"] > 10*1024*1024)  
		{$message = "LỖI: File có dung lượng quá lớn.\\n";}
	else if ($_FILES["file"]["error"] > 0) 
		{$message = "LỖI: Không rõ.";}
	else 
		{		
			$dir = $uploadDir;
			move_uploaded_file($_FILES["file"]["tmp_name"],$dir ."/".  $user['id']."[".$user['username']."][".$temp[0]."].".$extension);
			$message = "Nộp bài thành công";	
		}
?>
		<script>
			alert("<?php echo $message; ?>");
			window.history.back();
		</script>
<?php
} else {
?>
		<script>
			alert("Đã hết thời gian nộp bài! \n Nộp bài không thành công!");
			window.history.back();
		</script>
<?php
}	
?>		
</body>
</html>
