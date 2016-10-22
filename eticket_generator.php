<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");
	require_once("./includes/class.Pages.php");

	# POST ####################################################################################

	session_start();

	if (isset($_POST['send'])) {
		$user_id = intval($_POST['user_id']);
		$program_id = intval($_POST['program_id']);
		$code = generatePassword(19);

		$sql = "INSERT INTO codes SET date = NOW(), user_id = '".$user_id."', program_id = '".$program_id."', code = '".$code."'";
		db_query($sql);
	
		pageReload();
	}

	# MAIN #######################################################################################

	if (isset($_SESSION['id'])) {
		require_once ("includes/template.php");

		$tpl = new FastTemplate('./templates/');
		$_pages  = new Pages(15, 10);

		$tpl->define(array(
			"eticket_generator" => "eticket_generator.tpl",
			"eticket_table" => "eticket_table.tpl",
			"eticket_tr" => "eticket_tr.tpl",
		));

		$programs_list = '';
		$result = db_query("SELECT * FROM programs");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$programs_list .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
		}
		$tpl->assign("PROGRAMS", $programs_list);

		$users_list = '';
		$result = db_query("SELECT * FROM users");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$users_list .= '<option value="'.$row['id'].'">'.$row['login'].'</option>';
			}
		}
		$tpl->assign("USERS", $users_list);

		// E-ticket список
		$_pages->numRows = db_table_count('codes', '');
		$_pages->rowsPerPage = 10;
		$_pages->pagesRegion = 10;
		
		$result = db_query("SELECT * FROM codes LIMIT ".$_pages->getLimit());
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$user = db_get_data("SELECT login FROM users WHERE id = ".$row['user_id'], "login");
				$program = db_get_data("SELECT name FROM programs WHERE id = ".$row['program_id'], "name");

				$tpl->assign("DATE", $row['date']);
				$tpl->assign("USER", $user);
				$tpl->assign("PROGRAM", $program);
				$tpl->assign("CODE", $row['code']);
				$tpl->parse("TICKET_ROWS", "."."eticket_tr");
			}	

			$_pages->parse('eticket_generator.php?page={PAGE}', "Страницы", "LIST_PAGES");	
		}

		$tpl->parse("TICKETS", "eticket_table");
		$tpl->parse("FINAL", "eticket_generator");
		$tpl->clear_unassigned_tags();

		$tpl->FastPrint();
	} else {
		header("Location: admin_login.php");
		exit;
	}
?>
