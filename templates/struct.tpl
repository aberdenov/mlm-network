<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Структура</title>
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
<input type="hidden" name="action" id="action" value="0">

<div class="av1"><a href="" class="ln1">← Назад к сайту</a></div>
<div class="av2">
	<div class="mn2"><a href="profile.php" class="ln1">Профиль</a></div>
	<div class="mn1">Структура</div>
	<div class="mn2"><a href="logout.php" class="ln1">Выход</a></div>	
</div>

<div class="tp4">Ваша программа: {PROGRAMS}</div>

<ul id="organisation" style="display: none">
    {STRUCT}
</ul>

<div id="main" style="width: 500px; margin: 90px 0px 50px 200px"></div>

<div id="sel_id" style="display: none">
	<ul id="struct" style="display: none"></ul>

	<div class="tp4">Ваша команда</div>

	<div id="command" style="width: 500px; margin: 20px 0px 50px 200px"></div>
</div>
<!--==============================================================================================-->
</body></html>