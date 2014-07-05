<?

// Session cookie for 180 days
$expireTime = 60*60*24*180;
session_set_cookie_params($expireTime);
session_start();


include("_config.php");
include("_func.php");
include("_func_translit.php");
include("_q.php");

global $q_arr;


//
// make user for session
//
$user = $_POST["user"];
if (strlen($user)>0){
    // do convert russian unicode chars, if any, to translit
    $user = str2name($user);
    $_SESSION["user"] = $user;
    do_create($user);
};


//
// load user from session
//
$user = $_SESSION["user"];
if (strlen($user)==0){
    echo "username not defined, probably session expired.\n";
    exit(1);
};



$step = intval($_REQUEST["step"]);

if ($step <= 0) {
    echo "Test step unknown\n";
    exit(1);
};




$save_qarr = $_POST["save_qarr"];
if (strlen($save_qarr)>0){
    $form_arr=explode(",", $save_qarr);
    foreach ($form_arr as $save_qnum) {
        $tmp = "text".$save_qnum;
        $textq = $q_arr[$save_qnum];
        $textd = $_POST["$tmp"];

        $textq = trim($textq,"\r\n ");
        $textd = trim($textd,"\r\n ");

        $sdata = $textq."\n";
        $sdata.= $textd."\n";
        $sdata.= "\n";
        file_put_contents("userdata/{$user}.txt", $sdata, FILE_APPEND);
    };
};



if ($step == 37) {
    header("Location: showall.php");
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

<div class='entry'>
    Как следует поступать в данной ситуации?<br />
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

?>

<form action="interactive.php" method="POST">

<?

$q = " SELECT * FROM entries WHERE username = '".$user."' ";
$q.= " AND (q_num BETWEEN $qstart AND $qend)";
$q.= " ORDER BY id";

$r = mysql_query($q);

$q_form_arr = "";

if(mysql_num_rows($r)>0):

	while($row = mysql_fetch_assoc($r)):

?>

<br/>
<div class='entry'>

	<span class='link'>
		<?
            $q_num = $row['q_num'] - 1;
            $text = $q_arr[$q_num];
            echo $text;

            $q_form_arr.="$q_num,";
        ?>
	</span>
</div>

<div class='entry'>
	<span class='link'>
        <textarea style="width: 705px; height: 80px;" name="text<? echo $q_num; ?>"></textarea>
	</span>
<br/>
</div>


<?php
	endwhile;
endif;
?>

<br/>
<br/>

<? 
    // remove last comma, for not create last empty element in q_arr array
    $q_form_arr = trim($q_form_arr,",");
?>

<center>
<input type="hidden" name="step" value="<? echo $step+1; ?>" />
<input type="hidden" name="save_qarr" value="<? echo $q_form_arr; ?>" />
<input type="submit" value="&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;" />
</form>
</center>

<br/>

<br/>
<br/>

</body>
</html>
