<?

// Session cookie for 180 days
$expireTime = 60*60*24*180;
session_set_cookie_params($expireTime);
session_start();

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

<br/>
<center>
Интерактивный тест из сообщества ру_психолог "Нормальны ли вы?"<br/>
на знание социальных норм поведения.<br/>
По методике из книги <a target="_blank" href="http://www.ozon.ru/context/detail/id/4158906/">«Семейная позитивная динамическая психотерапия. Практическое руководство. </a> В.Ю. Слабинского.
<br/> 
</center>
<br/>
<br/>

<center>
<form action="interactive.php?step=1" method="POST">
Введите имя пользователя: <input type="text" name="user" value="" />
<br/>
<br/>
<input type="submit" value="Начать" />
</form>
</center>

<br/>


<br/>

</body>
</html>
