<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Contest Ranking</title>
    <link rel="shortcut icon" type="image/png" href="logochuyenhy.png">

    <!--CombineResourcesFilter-->
    <link rel="stylesheet" href="prettify.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="clear.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="ttypography.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="problem-statement.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="second-level-menu.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="roundbox.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="datatable.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="table-form.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="topic.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="jquery.jgrowl.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="facebox.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="jquery.wysiwyg.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="jquery.autocomplete.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="colorbox.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="jquery.drafts.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="status.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="community.css" type="text/css" charset="utf-8" />
</head>
<body>
<div id="body">

<div class="datatable"
     
     style="background-color: #E1E1E1; padding-bottom: 3px;">
            <div style="padding: 4px 0 0 6px;font-size:1em;position:relative;">
                <h2 style="color:#445f9d">Contest Ranking</h2>
            </div>
            <div style="background-color: white;margin:0.3em 3px 0 3px;position:relative;">
						<table class="standings">
							/*<tr>
								<th style="width:2em;">#</th>
								<th style="text-align:left;">Account</th>
								<th style="width:2em;" title="Score">Score</th>
									<th style="width:4em;">
											<p> Bai 1</p>
									</th>
									<th style="width:4em;">
											<p> Bai 2</p>
									</th>
									<th style="width:4em;">
											<p> Bai 3</p>
									</th>
									
							</tr>*/
                            <?php
                                function getdata($str, &$who, &$problem, &$score) {
                                    $s = 0;
                                    while (!ctype_alpha($str[$s])) ++$s;
                                    $e = $s;
                                    while (ctype_alpha($str[$e]) || $str[$e] == ' ') ++$e;
                                    $who = substr($str, $s, $e - $s);
                                    $s = $e;
                                    while (!ctype_alpha($str[$s])) ++$s;
                                    $e = $s;
                                    while (ctype_alpha($str[$e])) ++$e;
                                    $problem = substr($str, $s, $e - $s); $s = $e;
                                    $s = $e;
                                    while (!ctype_digit($str[$s])) ++$s;
                                    $e = $s;
                                    while (ctype_digit($str[$e])) ++$e;
                                    $score = substr($str, $s, $e - $s);
                                }
                                function updatectts(&$name, &$pos, &$exist){
                                    if ($exist) return 0;
                                    $pos = $name;
                                    $exist = 1;
                                    return 1;
                                }
                                function updateprbs(&$name, &$pos, &$exist){
                                    if ($exist) return 0;
                                    $pos = $name;
                                    $exist = 1;
                                    return 1;
                                }
                                $dir = "C:/Users/ncddu/Downloads/Compressed/UniServer/www/submit/Logs/";
                                $cntc = 0;
                                $cntp = 0;
                                $reg_cttants = array();
                                $cttants = array();
                                $reg_problems = array();
                                $problems = array();
                                $data = array(array());
                                if (is_dir($dir))
                                    if ($dh = opendir($dir)) {
                                        while ($file = readdir($dh))
                                            if ($file!="." && $file!=".." && $file != "<") {
                                                $handle = @fopen($dir.$file, "r");
                                                if ($handle && !feof($handle)) {
                                                    $content = fgets($handle, 100);
                                                    fclose($handle);
                                                }
                                                getdata($content, $who, $prb, $scr);
                                               // echo "$who $prb $scr <br/>";
                                                if (updatectts($who, $cttants[$cntc], $reg_cttants[$who])) ++$cntc;
                                                if (updateprbs($prb, $problems[$cntp], $reg_problems[$prb])) ++$cntp;
                                                $data[$who][$prb] = $scr;
                                             }
                                             closedir($dh);
                                        }
                                echo "<tr>";
                                echo "<th style='width:2em;'>#</th>>";
                                echo "<th style='text-align:left;'> Contestant </th>";
                                for ($i = 0; $i < $cntp; ++$i)
                                    echo "<th style='width:4em;'>".$problems[$i]."</th>";
                                echo "</tr>";
                                for ($i = 0; $i < $cntc; ++$i){
                                    echo "<tr>";
                                    echo "<th>".$cttants[$i]."</th>";
                                    for ($j = 0; $j < $cntp; ++$j)
                                        echo "<td>".$data[$cttants[$i]][$problems[$j]]."</td>";
                                    echo "</tr>";
                                }
                            ?>
										</table>
						</div>
        </div>

        </div>
</body>
</html>
