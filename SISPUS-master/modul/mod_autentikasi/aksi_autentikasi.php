<?php
session_start();
require_once('../../config/library_config.php');
require_once('../../config/fungsi_model_data.php');

switch($_GET['act']){
	case 'login'	:
		if(isset($_POST['submit'])){
			$input = array(
				'username' => $_POST['username'], 
				'password' => md5($_POST['password'])
			);

			//fetch data
			$clause = array(
				array(
					'username',
					' = ',
					'"'.$input['username'].'"',
					' AND '
				),

				array(
					'password',
					' = ',
					'"'.$input['password'].'"',
				)
			);
			$limit = 1;
			$table = 'admin';
			$login = fetch_data($table, $clause, $limit);
			
			if($login){
				$_SESSION = array(
					'id'		=> $login[0]['id_admin'],
					'nama'		=> $login[0]['nama_admin'],
					'logged_in'	=> TRUE
				);
			} else {
				set_flashdata('error', 'Username dan password salah.');
			}
		}
	break;
	
	case 'logout'	:
		if(isset($_SESSION['logged_in'])){
			unset($_SESSION);
			session_destroy();
		}
	break;
}
redirect(base_url());