<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");

	session_start();

	# VARS ####################################################################################

	$out = '';

	# MAIN #######################################################################################

	if (isset($_SESSION['id'])) {
		require_once ("includes/template.php");

		$tpl = new FastTemplate('./templates/');
		
		$tpl->define(array(
				"show_profile" => "show_profile.tpl",
		));
		

		$data = db_get_data("SELECT * FROM users WHERE id = ".$_GET['user_id']);

		if ($data['avatar'] != "") {
			$avatar = '<img src="'.$data['avatar'].'" width="341">';
		} else {
			$avatar = '<img src="images/avatar.png">';
		}

		$program = db_get_data("SELECT name FROM programs WHERE id = ".$data['program'], "name");

		// генерируем структуру 
		getStruct($_GET['user_id'], 0);

		$tpl->assign("STRUCT", $out);
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

		$tpl->parse("FINAL", "show_profile");
		$tpl->clear_unassigned_tags();

		$tpl->FastPrint();
	} else {
		header("Location: login.php");
		exit;
	}	
?>
