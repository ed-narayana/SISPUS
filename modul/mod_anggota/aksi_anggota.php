<?php			
session_start();
include "../../config/library_config.php";
include "../../config/fungsi_model_data.php";
switch($_GET['act']){
	case 'tambah':
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_anggota' => '"'.$_POST['nama'].'"',
				'jenis_kelamin'	 => '"'.$_POST['jk'].'"',
				'alamat'	 => '"'.$_POST['alamat'].'"',
				'no_telp'	 => '"'$_POST['telpon'].'"',
				'tempat_lahir'	 => '"'.$_POST['tempat'].'"',
				'tanggal_lahir'	 => '"'.$_POST['tanggal_lahir'].'"',
				'tanggal_gabung'	 => '"'.$_POST['tanggal_gabung'].'"',
				'id_wilayah_anggota' => $_POST['wilayah']
			);
			$table = 'anggota';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data nama : '.$input['nama_anggota'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data nama : '.$input['nama_anggota'].' gagal ditambah');
			}
		}
		
break;
	case 'update':
		$clause = array('id_anggota' => $_POST['id']);
			$input = array(
				'nama_anggota' => '"'.$_POST['nama'].'"',
				'jenis_kelamin'	 => '"'.$_POST['jk'].'"',
				'alamat'	 => '"'.$_POST['alamat'].'"',
				'no_telp'	 => '"'.$_POST['telpon'].'"',
				'tempat_lahir'	 => '"'.$_POST['tempat'].'"',
				'tanggal_lahir'	 => '"'.$_POST['tanggal_lahir'].'"',
				'tanggal_gabung'	 => '"'.$_POST['tanggal_gabung'].'"',
				'id_wilayah_anggota' => $_POST['wilayah']
			);
			$table = 'anggota';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_anggota'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_anggota'].' gagal.');
			}	

	break;
	
	case 'delete':
		$table  = 'anggota';
		$clause = array('id_anggota' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_anggota'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_anggota'].' gagal.');
		}
	break;
}
redirect(base_url("index.php?page=anggota"));