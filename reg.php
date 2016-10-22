<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");

	# POST ####################################################################################

	session_start();
	
	foreach ($_POST as $key => $value) {
		$_SESSION[$key] = $value;
	}

	if (isset($_POST['send'])) {
	 	if (empty($_POST['lastname']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['iin']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['country']) || empty($_POST['city']) || empty($_POST['sponsor_login']) || empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['eticket'])) {	
			header("Location: reg.php?result=1");
			exit;
		}

		$count = db_table_count('users', "login = '".$_POST['login']."'");
		if ($count == 0) {
			$lastname = strip_tags(trim($_POST['lastname']));
			$name = strip_tags(trim($_POST['name']));
			$surname = strip_tags(trim($_POST['surname']));
			$iin = strip_tags(trim($_POST['iin']));
			$phone = strip_tags(trim($_POST['phone']));
			$email = strip_tags(trim($_POST['email']));
			$country = strip_tags(trim($_POST['country']));
			$city = strip_tags(trim($_POST['city']));
			$sponsor_login = strip_tags(trim($_POST['sponsor_login']));
			$login = strip_tags(trim($_POST['login']));
			$password = strip_tags(trim($_POST['password']));
			$confirm_password = strip_tags(trim($_POST['confirm_password']));
			$eticket = strip_tags(trim($_POST['eticket']));

			$lastname = htmlspecialchars($lastname);
			$name = htmlspecialchars($name);
			$surname = htmlspecialchars($surname);
			$iin = htmlspecialchars($iin);
			$phone = htmlspecialchars($phone);
			$email = htmlspecialchars($email);
			$country = htmlspecialchars($country);
			$city = htmlspecialchars($city);
			$sponsor_login = htmlspecialchars($sponsor_login);
			$login = htmlspecialchars($login);
			$password = htmlspecialchars($password);
			$confirm_password = htmlspecialchars($confirm_password);
			$eticket = htmlspecialchars($eticket);

			$program = db_get_data("SELECT program_id FROM codes WHERE code = '".$eticket."'", "program_id");

			if ($password == $confirm_password) {
				$sql = "INSERT INTO users SET 
											lastname = '".$lastname."',
											name = '".$name."',
											surname = '".$surname."',
											iin = '".$iin."',
											phone = '".$phone."',
											email = '".$email."',
											country = '".$country."',
											city = '".$city."',
											sponsor_login = '".$sponsor_login."',
											login = '".$login."',
											password = MD5('".$password."'),
											eticket = '".$eticket."',
											program = '".$program."'";
				
				db_query($sql);

				header("Location: login.php");
				exit;
			} else {
				header("Location: reg.php?result=3");
				exit;
			}
		} else {
			header("Location: reg.php?result=2");
			exit;
		}
	}

	# MAIN #######################################################################################

	require_once ("includes/template.php");

	$tpl = new FastTemplate('./templates/');
	
	$tpl->define(array(
			"reg" => "reg.tpl",
	));
	
	if (isset($_GET['result'])) {
		switch ($_GET['result']) {
			case 1: $tpl->assign("RESULT_MESSAGE", showResult("Все поля обязательны для заполнения", 'result_error')); break;
			case 2: $tpl->assign("RESULT_MESSAGE", showResult("Пользователь с таким логином уже существует", 'result_error')); break;
			case 3: $tpl->assign("RESULT_MESSAGE", showResult("Неверный пароль", 'result_error')); break;
			default: $tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	foreach ($_SESSION as $key => $value) {
		$tpl->assign(strtoupper($key)."_VALUE", $value);
	}

	$tpl->parse("FINAL", "reg");
	$tpl->clear_unassigned_tags();

	$tpl->FastPrint();
?>
