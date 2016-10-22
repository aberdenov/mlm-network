<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Профиль</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Robots" content="INDEX, FOLLOW">
<link rel=stylesheet href="styles.css" type="text/css">
<script language="javascript" type="text/javascript" src="script.js"></script>
</head>
<body marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" rightmargin="0" leftmargin="0">
<a name="top"></a>
<!--==============================================================================================-->
<form name="frmProfile" action="" method="post" style="margin: 0px; padding: 0px" enctype="multipart/form-data">
<input type="hidden" name="action" id="action" value="0">

<div class="av1"><a href="" class="ln1">← Назад к сайту</a></div>
<div class="av2">
	<div class="mn1">Профиль</div>
	<div class="mn2"><a href="struct.php" class="ln1">Структура</a></div>
	<div class="mn2"><a href="logout.php" class="ln1">Выход</a></div>	
</div>

<div>
	<div class="av5">
		<div class="av4"><input type="text" name="lastname" class="in1" placeholder="Фамилия" value="{LASTNAME_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="name" class="in1" placeholder="Имя" value="{NAME_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="surname" class="in1" placeholder="Отчество" value="{SURNAME_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="iin" class="in1" placeholder="ИИН" value="{IIN_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="phone" class="in1" placeholder="Телефон" value="{PHONE_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="email" class="in1" placeholder="E-mail" value="{EMAIL_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="country" class="in1" placeholder="Страна" value="{COUNTRY_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="city" class="in1" placeholder="Город" value="{CITY_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="sponsor_login" class="in1" placeholder="Логин спонсора" value="{SPONSOR_LOGIN_VALUE}" {FIELDS_ACTIVE}></div>
		<div class="av4"><input type="text" name="login" class="in1" placeholder="Ваш логин" value="{LOGIN_VALUE}" {FIELDS_ACTIVE}></div>
		
		{ADMIN_AUTH}
	</div>
	<div class="av5">
		<div>{AVATAR}</div>
		<div class="au3" {FILE_DISPLAY}><input type="file" name="file" id="file" style="color: #fff"></div>

		<div class="at1">Программа</div>
		<div class="at2">{PROGRAM}</div>
	</div>
</div>
</form>
<!--==============================================================================================-->
</body></html>