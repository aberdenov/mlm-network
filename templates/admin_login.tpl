<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Вход для администраторов</title>
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
	<div class="av3">Авторизация</div>

	{RESULT_MESSAGE}

	<form name="frmLogin" action="" method="post" style="margin: 0px; padding: 0px">
	<div class="av4"><input type="text" name="login" class="in1" placeholder="Ваш логин" value="{USR_LOGIN}"></div>
	<div class="av4"><input type="password" name="password" class="in1" placeholder="Пароль" value="{USR_PASSW}"></div>
	
	<div class="av4"><input type="checkbox" name="chk_save" value="1" {SAVE}> запомнить</div>

	<div><input type="submit" name="send" class="in2" id="send" value="войти"></div>
	</form>
</div>
<!--==============================================================================================-->
</body></html>