<?php
include "../../config/library_config.php";
include "../../config/fungsi_model_data.php";
switch($_GET['act']){
	case 'tambah':
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_admin' => '"'.$_POST['nama'].'"',
				'username'	 => '"'.$_POST['username'].'"',
				'password'	 => '"'.md5($_POST['password']).'"',
				'id_wilayah_admin' => $_POST['wilayah']
			);
			$table = 'admin';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data nama : '.$input['nama_admin'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data nama : '.$input['nama_admin'].' gagal ditambah');
			}
		}
	break;
	
	case 'update':
		if(isset($_POST['Submit'])){
			$clause = array('id_admin' => $_POST['id']);
			if(!empty($_POST['password'])){
				$input = array(
					'nama_admin' => '"'.$_POST['nama'].'"',
					'username'	 => '"'.$_POST['username'].'"',
					'password'	 => '"'.md5($_POST['password']).'"',
					'id_wilayah_admin' => $_POST['wilayah'],
				);	
			} else {
				$input = array(
					'nama_admin' => '"'.$_POST['nama'].'"',
					'username'	 => '"'.$_POST['username'].'"',
					'id_wilayah_admin' => $_POST['wilayah'],
				);
			}
			$table = 'admin';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_admin'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_admin'].' gagal.');
			}
		}
	break;
	
	case 'delete':
		$table  = 'admin';
		$clause = array('id_admin' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_admin'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_admin'].' gagal.');
		}
	break;
}
redirect(base_url("index.php?page=admin"));