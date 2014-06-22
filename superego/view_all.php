<?

include("_config.php");
include("_func.php");
include("_q.php");

global $q_arr;

$step = intval($_GET["step"]);

if ($step <= 0) {
    $step = 1;
};


if ($step == 37) {
    header("Location: result_all.php");
    die();
};



?>
<html>
<head>
<title>Test</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="./css/style.css" rel="stylesheet">
<script type='text/javascript' src='./js/jquery.pack.js'></script>
<script type='text/javascript' src='./js/vote.js'></script>
</head>
<body>

<center>Username: All - Page: (<? echo "$step"; ?>/36)</center>
<br/>

<?php

$content = file_get_contents("material/part$step.txt");
$content = iconv("CP1251","UTF-8",$content);
$content = do_replace($content);
$content = nl2br($content);

?>

<div class='entry'>
    <? echo $content; ?>
</div>
<br/>

<div class='entry'>
    Как следует поступать в данной ситуации?<br />
</div>
<br/>

<?

$qstart=3*($step-1)+1;
$qend=$qstart+2;

if ($step==2){
    $qend++;
};
if ($step==5){
    $qend++;
};
if ($step==9){
    $qend++;
};

if ($step>2){
    $qstart++;
    $qend++;
};
if ($step>5){
    $qstart++;
    $qend++;
};
if ($step>9){
    $qstart++;
    $qend++;
};


for ($qncur = $qstart; $qncur<=$qend; $qncur++):

?>

<div class='entry'>
	<span class='link'>
		<?
            $qn = $qncur - 1;
            $text = $q_arr[$qn];
            echo "<font color='blue'>".$text."</font>";
        ?>
	</span>
</div>

<?

$arr_user = array(
"allbeam",
"astra_nat",
"bazelyanka",
"botv0091",
"efimera",
"eoloa",
"everlovin_baby",
"faith_forven",
"fat_firefly",
"furry",
"masha_leit",
"mozgos",
"pesni_pameli",
"pomanticinik",
"psisa_bmw",
"pughuapo",
"velori",
"vokabula",
"w_mikulishna",
);


foreach ($arr_user as $user):

$q = " SELECT * FROM entries WHERE (username = '".$user."') ";
$q.= " AND (q_num = $qncur)";

$r = mysql_query($q);

$data = file_get_contents("userdata/{$user}.txt");
$arr = explode("\n",$data);

if(mysql_num_rows($r)>0){
    $row = mysql_fetch_assoc($r);
    $net_vote = "(не проверено)";
    if ($row['good']==1) {
        $net_vote="верно";
    };
	if ($row['bad']==1) {
        $net_vote="неверно";
    };
};


?>

<div class='entry'>
	<span class='link'>
		<?
            $t = ($qncur*3)-2;
            $answer = trim($arr[$t]," \n\r");
            $answer = stripslashes($answer);
            if ($net_vote=="верно") {
                echo "$user: $answer\n";
                //echo "$answer\n";
            } else {
                echo "<font color='red'>[-]</font> $user: $answer\n";
                //echo "<font color='red'>[-]</font> $answer\n";
            };
        ?>
	</span>
</div>

<?php
    endforeach;
?>

<br/><br/>

<?
  endfor;
?>

<div class='entry'>
    <? echo $content; ?>
</div>

<br/>
<br/>

<center>
<form action="view_all.php" method="GET">
<input type="hidden" name="step" value="<? echo $step+1; ?>" />
<input type="submit" value="&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;" />
</form>
</center>

<br/>
<center><a href="compare.php?step=<? echo $step-1; ?>" />Prev</a></center>

<br/>
<br/>

</body>
</html>
