<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");

	session_start();

	# POST ####################################################################################

	if (isset($_POST['action'])) {
		// авторизация в админ панели
		if ($_POST['action'] == 1) {
			$username = trim($_POST['admin_login']);
			$userpass = trim($_POST['admin_password']);

			$result = db_query("SELECT * FROM admins WHERE login = '".$username."' AND password = MD5('".$userpass."') LIMIT 1");
			if (db_num_rows($result) > 0) {
				$row = db_fetch_object($result);

				$_SESSION['admin_id'] = $row->id;
			} 

			pageReload();
		}

		// выход из админ панели
		if ($_POST['action'] == 2) {
			unset($_SESSION['admin_id']);
			pageReload();
		}

		// сохраняем данные
		if ($_POST['action'] == 3) {
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
			
			$sql = "UPDATE users SET 
									lastname = '".$lastname."',
									name = '".$name."',
									surname = '".$surname."',
									iin = '".$iin."',
									phone = '".$phone."',
									email = '".$email."',
									country = '".$country."',
									city = '".$city."',
									sponsor_login = '".$sponsor_login."',
									login = '".$login."' WHERE id = ".$_SESSION['id'];
				
			db_query($sql);

			// загружаем аватарку
			if ($_FILES['file']['name'] != '') {
				$tmp_filename = $_FILES['file']['tmp_name'];
				$extension = validateFileType($_FILES['file']['type']);
				
				$file_name = time().".".$extension;
				$ret = copy($tmp_filename, "avatars/".$file_name);
				
				$avatar = "http://".$_SERVER['SERVER_NAME'].'/admin/avatars/'.$file_name;
				
				$sql = "UPDATE users SET avatar = '".$avatar."' WHERE id = ".$_SESSION['id'];
				db_query($sql);
			}

			pageReload();
		}
	}

	# MAIN #######################################################################################

	if (isset($_SESSION['id'])) {
		require_once ("includes/template.php");

		$tpl = new FastTemplate('./templates/');
		
		$tpl->define(array(
				"profile" => "profile.tpl",
				"admin_auth" => "admin_auth.tpl",
				"admin_save" => "admin_save.tpl",
		));
		
		// Авторизация для админа
		if (isset($_SESSION['admin_id'])) {
			$tpl->assign("FIELDS_ACTIVE", "");
			$tpl->assign("FILE_DISPLAY", '');
			$tpl->parse("ADMIN_AUTH", "admin_save");
		} else {
			$tpl->assign("FIELDS_ACTIVE", 'disabled="disabled"');
			$tpl->assign("FILE_DISPLAY", 'style="display: none"');
			$tpl->parse("ADMIN_AUTH", "admin_auth");
		}

		$data = db_get_data("SELECT * FROM users WHERE id = ".$_SESSION['id']);

		if ($data['avatar'] != "") {
			$avatar = '<img src="'.$data['avatar'].'" width="341">';
		} else {
			$avatar = '<img src="images/avatar.png">';
		}

		$program = db_get_data("SELECT name FROM programs WHERE id = ".$data['program'], "name");

		$tpl->assign("PROGRAM", $program);
		$tpl->assign("AVATAR", $avatar);
		$tpl->assign("LASTNAME_VALUE", $data['lastname']);
		$tpl->assign("NAME_VALUE", $data['name']);
		$tpl->assign("SURNAME_VALUE", $data['surname']);
		$tpl->assign("IIN_VALUE", $data['iin']);
		$tpl->assign("PHONE_VALUE", $data['phone']);
		$tpl->assign("EMAIL_VALUE", $data['email']);
		$tpl->assign("COUNTRY_VALUE", $data['country']);
		$tpl->assign("CITY_VALUE", $data['city']);
		$tpl->assign("SPONSOR_LOGIN_VALUE", $data['sponsor_login']);
		$tpl->assign("LOGIN_VALUE", $data['login']);

		$tpl->parse("FINAL", "profile");
		$tpl->clear_unassigned_tags();

		$tpl->FastPrint();
	} else {
		header("Location: login.php");
		exit;
	}	
?>
