<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Генератор e-ticket</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Robots" content="INDEX, FOLLOW">
<link rel=stylesheet href="styles.css" type="text/css">
<script language="javascript" type="text/javascript" src="script.js"></script>
</head>
<body marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" rightmargin="0" leftmargin="0">
<a name="top"></a>
<!--==============================================================================================-->
<div class="av1"><a href="" class="ln1">← Назад к сайту</a></div>
<div class="av2">
	<div class="av3">Генератор E-ticket</div>

	<form name="frmGenerator" action="" method="post" style="margin: 0px; padding: 0px">
	<div class="av4">Программа: <select name="program_id">{PROGRAMS}</select></div>
	<div class="av4">Пользователь: <select name="user_id">{USERS}</select></div>

	<div><input type="submit" name="send" class="in2" id="send" value="Сгенерировать"></div>
	</form>
</div>

<div>
	<div class="av1">
	{TICKETS}
	</div>
</div>
<!--==============================================================================================-->
</body></html>