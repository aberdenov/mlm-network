<?php
	require_once ("./includes/db_config.php");
	require_once ('./databases/'.DB_TYPE);
	
	db_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
	db_select_db(DB_NAME);
?>