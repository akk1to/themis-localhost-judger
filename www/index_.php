<?php
	include("init.php");
	include("config.php");
	include("functions.php")
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hệ thống nộp bài trực tuyến.</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
	<script src="js/jquery-latest.js"></script>
	<script>
		var refreshId = setInterval(function(){
			$('#logs').load('logs.php');
			$('#timer').load('timer.php');
		}, 1000);
	</script>
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">&middot; Hệ thống nộp bài trực tuyến.</a>
        </div>
		
		<div class="navbar-collapse collapse">
			<div class="navbar-form navbar-right"> 
				<a class="btn btn-success" href="repass.php" title="Đổi mật khẩu">Thí sinh: <?php echo $_SESSION['tname']; ?></a> 
				<a href="logout.php">(Thoát)</a>
		</div>
		</div>  
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $contestName; ?></h1>
        <p><?php echo $description; ?></p>
<?php if ($duringTime > 0) { ?>
		<p>
			- Thời gian bắt đầu: <?php echo date("H:i:s F jS Y", $begintime); ?> <br/>
			- Thời gian làm bài: <?php echo $duringTime; ?> phút. <br/>
			<span id="timer"> </span>
		</p>
<?php } ?>
          <a href="ranking.php" target="_blank"> Bảng Xếp Hạng </a> 
          <form class="navbar-form navbar-right"  action="upload.php" method="POST" enctype="multipart/form-data">
 			 Nộp bài: 
			<div class="form-group">
				<input type="file" name="file" id="file" accept=".pas,.cpp" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Nộp</button>
          </form>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
	  
        <div class="col-md-4">
          <h2>Đề:</h2>
<?php
		$dir = opendir($problemsDir);
		while ($file = readdir($dir)) { if ($file!="." && $file!=".." && substr($file,0,strlen($file)-4)!="allproblems") {
			echo "<h4>Bài: <a href='".$problemsDir."/".$file."'>".$file."</a></h4>";
		}}
		closedir($dir);
?>		  
        <p><a class="btn btn-default" href="<?php echo $problemsDir.'/'.$problemsFile; ?>" role="button">Tải về &raquo;</a></p>  
        </div>
		
        <div class="col-md-4">
          <h2>Test mẫu:</h2>
<?php	
		$dir = opendir($examTestDir);
		while ($file = readdir($dir)) { if ($file!="." && $file!=".." && !is_file($examTestDir."/".$file)) {
			echo "<h4>Bài: ".$file."</h4>"; 
			$subdir = opendir($examTestDir."/".$file);
			echo "<p>";
			while ($subfile = readdir($subdir)) {
				if ($subfile!="." && $subfile!=".." && !is_file($examTestDir."/".$file."/".$subfile)) {
					echo "<a href='".$examTestDir."/".$file."/".$subfile."'>".$subfile."</a> | ";
				}
			}
			echo "</p>";
			closedir($subdir);
		}}
		closedir($dir);
?>		  
          <p><a class="btn btn-default" href="<?php echo $examTestDir.'/'.$examTestFile; ?>" role="button">Tải về &raquo;</a></p>
       </div>
	   
        <div class="col-md-4">
          <h2>Nhật ký nộp bài:</h2>
		  <div id="logs"> Đang tải... </div>
        </div>
      </div>

      <hr>

      <footer>
        <p><?php echo $footer; ?></p>
      </footer>
    </div> <!-- /container -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
