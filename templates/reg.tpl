<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Регистрация</title>
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
	<div class="av3">Регистрация</div>

	{RESULT_MESSAGE}

	<form name="frmReg" action="" method="post" style="margin: 0px; padding: 0px">
	<div class="av4"><input type="text" name="lastname" class="in1" placeholder="Фамилия" value="{LASTNAME_VALUE}"></div>
	<div class="av4"><input type="text" name="name" class="in1" placeholder="Имя" value="{NAME_VALUE}"></div>
	<div class="av4"><input type="text" name="surname" class="in1" placeholder="Отчество" value="{SURNAME_VALUE}"></div>
	<div class="av4"><input type="text" name="iin" class="in1" placeholder="ИИН" value="{IIN_VALUE}"></div>
	<div class="av4"><input type="text" name="phone" class="in1" placeholder="Телефон" value="{PHONE_VALUE}"></div>
	<div class="av4"><input type="text" name="email" class="in1" placeholder="E-mail" value="{EMAIL_VALUE}"></div>
	<div class="av4"><input type="text" name="country" class="in1" placeholder="Страна" value="{COUNTRY_VALUE}"></div>
	<div class="av4"><input type="text" name="city" class="in1" placeholder="Город" value="{CITY_VALUE}"></div>
	<div class="av4"><input type="text" name="sponsor_login" class="in1" placeholder="Логин спонсора" value="{SPONSOR_LOGIN_VALUE}"></div>
	<div class="av4"><input type="text" name="login" class="in1" placeholder="Ваш логин" value="{LOGIN_VALUE}"></div>
	<div class="av4"><input type="password" name="password" class="in1" placeholder="Пароль" value="{PASSWORD_VALUE}"></div>
	<div class="av4"><input type="password" name="confirm_password" class="in1" placeholder="Подтверждение пароля" value="{CONFIRM_PASSWORD_VALUE}"></div>
	<div class="av4"><input type="text" name="eticket" class="in1" placeholder="E-ticket" value="{ETICKET_VALUE}"></div>
	
	<div class="av4"><input type="checkbox" name="agree" onchange="inputStatus(this, 'send');"> <a href="" target="_blank" class="ln2">С договором согласен</a></div>

	<div><input type="submit" name="send" class="in2" id="send" disabled="disabled" value="зарегистрироваться"></div>
	</form>
</div>
<!--==============================================================================================-->
</body></html>