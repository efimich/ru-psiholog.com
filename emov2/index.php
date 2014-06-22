<?php

require("pril.php");
require("emotions.php");

$param=$_GET["emotion"];

if ( strlen($param) > 0 ) {
    $word2 = $param;
} else {
    $maxemo = count($emotions)-1;
    $rnd2 = rand(0,$maxemo);
    $word2 = $emotions[$rnd2];
};

$maxpril = count($pril)-1;
$rnd1 = rand(0,$maxpril);
$word1 = $pril[$rnd1];

if (substr($word2,0,3) == "мой") {
   $w1=$word1;
};
if (substr($word2,0,3) == "моя") {
   $w1=substr($word1,0,strlen($word1)-2);
   $w1=$w1."ая";
};
if (substr($word2,0,3) == "моё") {
   $w1=substr($word1,0,strlen($word1)-2);
   $w1=$w1."ое";
};

$w2=substr($word2,4);
$phrase = $w1." ".$w2;


$slist = $emotions;
sort($slist, SORT_STRING);


//echo $phrase;
//include('_html.inc');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
        <title>Описание эмоций</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
<body>

<br/>
<center>
случайно подобранные описания эмоций
</center>
<br/><br/><br/>
<br/>

<center>
<h2><? echo $phrase; ?></h2>
</center>
<br/>
<center>
<form action="" method="GET">
<select name="emotion">
<? 
echo "<option value=\"\"></option>\n";
foreach ($slist as $s){
    $show=substr($s,4);
    if ($param == $s){
        echo "<option value=\"$s\" selected>$show</option>\n";
    } else {
        echo "<option value=\"$s\">$show</option>\n";
    };
};
?>
</select>
<br/>
<input type="submit" value="ещё" />
</form>
</center>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17397329-1']);
  _gaq.push(['_setDomainName', '.sociofob.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>
