<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Просмотр профиля участника</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Robots" content="INDEX, FOLLOW">
<link rel=stylesheet href="styles.css" type="text/css">
<script language="javascript" type="text/javascript" src="script.js"></script>
<link rel="stylesheet" href="css/jquery.orgchart.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery.orgchart.js"></script>

<script>
	$(function() {
		$("#organisation").orgChart({container: $("#main")});
 	});
</script>
</head>
<body marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" rightmargin="0" leftmargin="0">
<a name="top"></a>
<!--==============================================================================================-->
<form name="frmProfile" action="" method="post" style="margin: 0px; padding: 0px" enctype="multipart/form-data">
<input type="hidden" name="action" id="action" value="0">

<div class="av1"><a href="struct.php" class="ln1">← Назад</a></div>
<div class="av2">
	<div class="mn1">Профиль участника</div>
</div>

<div>
	<div class="av5">
		<div class="av4"><input type="text" name="lastname" class="in1" placeholder="Фамилия" value="{LASTNAME_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="name" class="in1" placeholder="Имя" value="{NAME_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="surname" class="in1" placeholder="Отчество" value="{SURNAME_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="iin" class="in1" placeholder="ИИН" value="{IIN_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="phone" class="in1" placeholder="Телефон" value="{PHONE_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="email" class="in1" placeholder="E-mail" value="{EMAIL_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="country" class="in1" placeholder="Страна" value="{COUNTRY_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="city" class="in1" placeholder="Город" value="{CITY_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="sponsor_login" class="in1" placeholder="Логин спонсора" value="{SPONSOR_LOGIN_VALUE}" disabled="disabled"></div>
		<div class="av4"><input type="text" name="login" class="in1" placeholder="Ваш логин" value="{LOGIN_VALUE}" disabled="disabled"></div>
	</div>
	<div class="av5">
		<div>{AVATAR}</div>

		<div class="at1">Программа</div>
		<div class="at2">{PROGRAM}</div>
	</div>
</div>

<div style="margin: 40px 0px 20px 0px">
	<div class="tp4">Ваша команда</div>

	<ul id="organisation" style="display: none">
	    {STRUCT}
	</ul>

	<div id="main" style="width: 500px; margin: 40px 0px 0px 200px"></div>
</div>
</form>
<!--==============================================================================================-->
</body></html>