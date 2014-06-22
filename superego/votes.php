<?php

include("_config.php");

$id = $_POST['id'];
$action = $_POST['action'];

if($action=='vote_up') {
	$q = "UPDATE entries SET good=1, bad=0 WHERE id = $id";
    $r = mysql_query($q);
    $ret = "верно";
};

if($action=='vote_down') {
	$q = "UPDATE entries SET good=0, bad=1 WHERE id = $id";
    $r = mysql_query($q);
    $ret = "неверно";
};

if($r) {
    echo $ret;
} else {
	echo "Failed!";
};

?>
