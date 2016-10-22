<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");

	# POST ####################################################################################

	session_start();

	if (isset($_POST['send'])) {
		$username = trim($_POST['login']);
		$userpass = trim($_POST['password']);

		$result = db_query("SELECT * FROM admins WHERE login = '".$username."' AND password = MD5('".$userpass."') LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_object($result);
			
			$_SESSION['id'] = $row->id;
			$_SESSION['login'] = $row->login;
			$_SESSION['password'] = $row->password;
			
			// Сохраняем логин и пароль в куках, удаляем если не отметили "запомнить"
			if (isset($_POST['chk_save'])) {
				$cookie_value = $username."|".$userpass."|".$_SERVER['HTTP_HOST'];
				$cookie_value = crypt_string($cookie_value);
				setcookie("korkem_auth", $cookie_value, time()+60*60*24*30, "", $_SERVER['HTTP_HOST']);
			} else {
				if (isset($_COOKIE['korkem_auth_admin'])) {
					$cookie_value = "";
					setcookie("korkem_auth_admin", $cookie_value, 0, "", $_SERVER['HTTP_HOST']);
				}
			}
			
			header("Location: eticket_generator.php");
			exit;
		} else {
			header("Location: admin_login.php?result=1");
			exit;
		}
	}

	# MAIN #######################################################################################

	require_once ("includes/template.php");

	$tpl = new FastTemplate('./templates/');
	
	$tpl->define(array(
			"admin_login" => "admin_login.tpl",
	));
	
	if (isset($_GET['result'])) {
		switch ($_GET['result']) {
	 		case 1: $tpl->assign("RESULT_MESSAGE", showResult("Неверный логин или пароль", 'result_error')); break;
	 		default: $tpl->assign("RESULT_MESSAGE", '');
		}
	} else {
		$tpl->assign("RESULT_MESSAGE", '');
	}

	$usr_login = '';
	$usr_passw = '';
	$save      = '';
	
	if (isset($_COOKIE['korkem_auth_admin'])) {
		$str = crypt_string($_COOKIE['korkem_auth_admin'], false);
		
		$login_info = explode("|", $str);
		if (is_array($login_info)) {
			$host = $login_info[2];
			if ($host == $_SERVER['HTTP_HOST']) {
				$usr_login = $login_info[0];
				$usr_passw = $login_info[1];
				$save = 'checked';
			}
		}
	}

	$tpl->assign(array(
			"USR_LOGIN" => $usr_login,
			"USR_PASSW" => $usr_passw,
			"SAVE"      => $save,
		));

	$tpl->parse("FINAL", "admin_login");
	$tpl->clear_unassigned_tags();

	$tpl->FastPrint();
?>
