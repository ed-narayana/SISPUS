<?php
session_start();
require_once('../../config/library_config.php');
require_once('../../config/fungsi_model_data.php');

switch($_GET['act']){
	case 'id_penulis'	:
  break;

  case 'simpan_penulis' :
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_penulis' => '"'.$_POST['nama_penulis'].'"',
				'alamat_penulis' => '"'.$_POST['alamat_penulis'].'"',
				'telp_penulis' => '"'.$_POST['telepon_penulis'].'"'
			);
			$table = 'penulis';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data penulis : '.$input['nama_penulis'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data penulis : '.$input['nama_penulis'].' gagal ditambah');
			}
		}
  break;

	case 'update_penulis':
		if(isset($_POST['Submit'])){
			$clause = array('id_penulis' => $_POST['id_penulis']);
			$input = array(
				'nama_penulis' => '"'.$_POST['nama_penulis'].'"',
				'alamat_penulis' => '"'.$_POST['alamat_penulis'].'"',
				'telp_penulis' => '"'.$_POST['telepon_penulis'].'"'
			);
			$table = 'penulis';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_penulis'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_penulis'].' gagal.');
			}
		}
	break;

	case 'delete_penulis':
		$table  = 'penulis';
		$clause = array('id_penulis' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_penulis'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_penulis'].' gagal.');
		}
	break;

}
redirect (base_url('index.php?page=penulis'));
?>
