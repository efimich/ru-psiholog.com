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

<br/>
<center>Ответы получены! Спасибо!</center>
<br/>

<div class='entryshow'>
<center>Теперь вам самому(-ой) надо проверить их на правильность. Будьте внимательны.</center>
</div>

<br/>
<br/>
<center><a href="/superego/compare.php?step=1" target="_blank">проверить свои ответы</a></center>
<br/>
<br/>
<center>[ <a href="/superego/">на главную</a> ]</center>
<br/>
<br/>
<br/>

</body>
</html>
