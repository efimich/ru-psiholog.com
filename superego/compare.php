<?

// Session cookie for 180 days
$expireTime = 60*60*24*180;
session_set_cookie_params($expireTime);
session_start();


include("_config.php");
include("_func.php");
include("_q.php");


$user = $_SESSION["user"];
if (strlen($user)==0){
    echo "username not defined, probably session expired.\n";
    exit(1);
};

$step = intval($_GET["step"]);

if ($step <= 0) {
    echo "Test step unknown\n";
    exit(1);
};


if ($step == 37) {
    header("Location: result.php");
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

<center>Username: <? echo "$user"; ?> - Page: (<? echo "$step"; ?>/36)</center>
<br/>

<?php

if ($step == 1) {
    //needed this now?
};


$content = file_get_contents("material/part$step.txt");
$content = iconv("CP1251","UTF-8",$content);
$content = do_replace($content);
$content = nl2br($content);

?>

<div class='entry'>
    Как следует поступать в данной ситуации?<br />
</div>

<br/>

<div class='entry'>
    <? echo $content; ?>
</div>

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


$q = " SELECT * FROM entries WHERE username = '".$user."' ";
$q.= " AND (q_num BETWEEN $qstart AND $qend)";
$q.= " ORDER BY id";

$r = mysql_query($q);

$data = file_get_contents("userdata/{$user}.txt");
$arr = explode("\n",$data);

if(mysql_num_rows($r)>0):

	while($row = mysql_fetch_assoc($r)):
        $net_vote = "(не проверено)";
		if ($row['good']==1) {
            $net_vote="верно";
        };
		if ($row['bad']==1) {
            $net_vote="неверно";
        };

?>

<br/>
<div class='entry'>

	<span class='link'>
		<?
            $q_num = $row['q_num'] - 1;
            $text = $q_arr[$q_num];
            echo $text;
        ?>
	</span>
</div>

<div class='entry'>
	<span class='link'>
        
		<?
            $t = ($row['q_num']*3)-2;
            $answer = trim($arr[$t]," \n\r");
            echo $answer;
        ?>

	</span>
<br/>
<div style="text-align: right;">
	<span class='votes_count' id='votes_count<?php echo $row['id']; ?>'><?php echo $net_vote; ?></span>
	
	<span class='vote_buttons' id='vote_buttons<?php echo $row['id']; ?>'>
		<a href='javascript:;' class='vote_up' id='<?php echo $row['id']; ?>'></a>
		<a href='javascript:;' class='vote_down' id='<?php echo $row['id']; ?>'></a>
	</span>
</div>

</div>

<?php
	endwhile;
endif;
?>

<br/>
<div class='entry'>
    <? echo $content; ?>
</div>

<br/>

<center>
<form style="display: inline;" action="compare.php" method="GET">
<input type="hidden" name="step" value="<? echo $step-1; ?>" />
<input type="submit" value="&nbsp;&nbsp;&nbsp;Prev&nbsp;&nbsp;&nbsp;" />
</form>

<form style="display: inline;" action="compare.php" method="GET">
<input type="hidden" name="step" value="<? echo $step+1; ?>" />
<input type="submit" value="&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;" />
</form>
</center>

<br/>
<br/>
<br/>

</body>
</html>
