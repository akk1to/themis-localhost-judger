<?php
include("config.php");
include("functions.php");
date_default_timezone_set("Asia/Bangkok"); 
$YYYY = date('Y', time());
$dir = $logsDir;
$cntc = $cntp = 0;
$reg_cttants = $reg_problems = $sum = $last = $cttants = $problems = array();
$data = $log = array(array());
$color = array("red", "orangered", "orange", "darkviolet", "blue");
if (is_dir($dir)) if ($dh = opendir($dir)) {
  while ($file = readdir($dh)) if ($file!="." && $file!=".." && $file != "<") {
    if (filemtime($dir.$file) < $begintime) continue;
    $handle = @fopen($dir.$file, "r");
    if ($handle && !feof($handle)) { 
      $content = fgets($handle, 100); fclose($handle); 
    }
    getdata($content, $w, $p, $scr);
    if (updatectts($w, $cttants[$cntc], $reg_cttants[$w])) ++$cntc;
    if (updateprbs($p, $problems[$cntp], $reg_problems[$p])) ++$cntp;
    if ($scr == "") continue;
    if ($data[$w][$p] == 0 || filemtime($dir.$file) > filemtime($dir.$log[$w][$p])) {
      $data[$w][$p] = $scr;
      $log[$w][$p] = $file;
      $last[$w] = max($last[$w], filemtime($dir.$file));
    } 
  }
  closedir($dh);
}
?>

<!DOCTYPE HTML PUBLIC>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bảng điểm</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="15" />
  <!--CombineResourcesFilter-->
  <link rel="stylesheet" href="../css_hy/clear.css" type="text/css" charset="utf-8" />
  <link rel="stylesheet" href="../css_hy/style.css" type="text/css" charset="utf-8" />
  <link rel="stylesheet" href="../css_hy/datatable.css" type="text/css" charset="utf-8" />
  <link rel="stylesheet" href="../css_hy/table-form.css" type="text/css" charset="utf-8" />
</head>
<body> 
  <div id="body">
    <div class='datatable' style='background-color: #E1E1E1; padding-bottom: 3px;position:absolute '>

      <div style="padding: 4px 0 0 6px;font-size:1em;position:relative;"> <h2 style="color:#445f9d;margin-left:10px">Bảng xếp hạng</h2> </div>

      <div style="background-color: white;margin:0.3em 3px 0 3px;position:relative;">
        <table class="standings">
          <?php function swap(&$xm, &$ym){ $tmp = $xm; $xm = $ym; $ym = $tmp; }
          for ($i = 0; $i < $cntc; ++$i)
          for ($j = 0; $j < $cntp; ++$j)
          if ($data[$cttants[$i]][$problems[$j]] != "...") $sum[$cttants[$i]] += $data[$cttants[$i]][$problems[$j]];
          for ($i = 0; $i < $cntc; ++$i) // SORT CONTESTANTS
          for ($j = $i + 1; $j < $cntc; ++$j)
          if ($sum[$cttants[$i]] < $sum[$cttants[$j]] || ($sum[$cttants[$i]] == $sum[$cttants[$j]] && $last[$cttants[$i]] > $last[$cttants[$j]]))
          swap ($cttants[$i], $cttants[$j]);
          for ($i = 0; $i < $cntp; ++$i) // SORT PROBLEMS
          for ($j = $i + 1; $j < $cntp; ++$j)
          if ($problems[$i] > $problems[$j])
          swap ($problems[$i], $problems[$j]); ?>
          <tr>
          <th style='color:#445f9d; min-width:40px'>#</th>
          <th style='text-align:left;min-width:250px;color:#445f9d;'> <h3> Thí Sinh </h3> </th>
          <th style='color:#445f9d;min-width:80px'> <h4> Tổng </h4> </th>
          <?php for ($i = 0; $i < $cntp; ++$i) echo "<th style='min-width:95px;'>".$problems[$i]."</th>"; ?> 
          </tr>

          <?php for ($i = 0; $i < $cntc; ++$i) {
          $cl = "black	";
          if ($i >= $cntc - 5) $cl = "grey";
          if ($i < 5) $cl = $color[min($i, 6)];
          echo "<tr>";
          if ($i % 2) {
            echo "<td>".($i + 1)."</td>";
            echo "<td style='text-align:left;color:".$cl."'><b>".$cttants[$i]."</b></td>";
            echo "<td style='color:black'><b>".sprintf("%0.2f", $sum[$cttants[$i]])."</b></td>";
            for ($j = 0; $j < $cntp; ++$j)
            echo "<td style='color:#0a0'> <a onclick=wload('".$logssubDir.rawurlencode($log[$cttants[$i]][$problems[$j]])."')> <b>".$data[$cttants[$i]][$problems[$j]]."</b> </a> </td>";
          } else {
            echo "<td class='contestant-cell dark'>".($i + 1)."</td>";
            echo "<td style='text-align:left;color:".$cl."' class='contestant-cell dark'><b>".$cttants[$i]."</b></td>";
            echo "<td style='color:black' class='contestant-cell dark'><b>".sprintf("%0.2f", $sum[$cttants[$i]])."</b></td>";
            for ($j = 0; $j < $cntp; ++$j)
              echo "<td class='contestant-cell dark' style='color:#0a0'> <a onclick=wload('".$logssubDir.rawurlencode($log[$cttants[$i]][$problems[$j]])."')> <b>".$data[$cttants[$i]][$problems[$j]]."</b> </a> </td>";
            }
            echo "</tr>"; 
          } ?>
        </table>
      </div>
	  
   
	</div> 
  </div> 
</body>
</html>