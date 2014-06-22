<?

// 100 days
$expireTime = 60*60*24*100; 
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


?>
<html>
<head>
<title>Results</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="./css/style.css" rel="stylesheet">
<script type='text/javascript' src='./js/jquery.pack.js'></script>
<script type='text/javascript' src='./js/vote.js'></script>
</head>
<body>

<center>Username: <? echo "$user"; ?></center>
<br/>

<center>РЕЗУЛЬТАТЫ</center>

<?

global $theme;
global $theme2;

$allgood = 0;
$allbad = 0;
$weak = "";

for($i=1;$i<37;$i++):

    $step=$i;

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

$curgood = 0;
$curbad = 0;
if(mysql_num_rows($r)>0) {

	while($row = mysql_fetch_assoc($r)) {
		$allgood += $row['good'];
		$curgood += $row['good'];

		$allbad += $row['bad'];
		$curbad += $row['bad'];
    };
};


?>

<div class='entry'>
    <center>
		<?
            if ($curbad>=2){
                echo "<span style='color:red'>";
                $weak.=$theme2[$step-1].", ";
            } 
            if ($curbad<=1) {
                echo "<span>";
            };

            echo "<b>".$theme[$step-1]."</b><br/>";

            echo "Правильных: ".$curgood."<br/>\n";
            echo "Ошибочных: ".$curbad;
            echo "</span>";
        ?>
    </center>
</div>


<?php

endfor;

?>

<br/>
<br/>

<center>ИТОГО</center>

<div class='entry'>
    <center>
		<?
            echo "<b>Ответов по всем темам</b><br/>";

            if ($allbad>36){
                echo "<span style='color:red'>";
            } else {
                echo "<span>";
            };
            echo "Правильных: ".$allgood."<br/>\n";
            echo "Ошибочных: ".$allbad;
            echo "</span>";

            echo "<br/>\n";
            echo "<br/>\n";

            $weak = rtrim($weak,", ");

            if ($allbad>=50){
                echo "<center><b>Ваше знание социальных норм - неудовлетворительное.</b></center>";
                echo "<center>Видимо, когда всем выдавали совесть, вы прогуляли урок.</center>";
                echo "<br/><center>Ваши слабые места (над чем надо поработать):</center>";
                echo "<center>$weak</center>";
            };
            if ( ($allbad>=36) and ($allbad<50) ){
                echo "<center><b>Ваше знание социальных норм хорошо бы обновить.</b></center>";
                echo "<br/><center>Ваши слабые места (над чем надо поработать):</center>";
                echo "<center>$weak</center>";
            };
            if ($allbad<36) {
                echo "<center><b>Поздравляем, вы знаете социальные нормы!</b></center>";
                echo "<center>Это свидетельство сформированного супер-эго.</center>";
                echo "<br/><center>Ваши слабые места (над чем надо поработать):</center>";
                echo "<center>$weak</center>";
            };

            echo "<br/>\n";
            echo "<br/>\n";

        ?>
    </center>
</div>

<br/>
<br/>
<center>[ <a href="/superego">На главную</a> ]</center>
<br/>
<br/>
<br/>

</body>
</html>
