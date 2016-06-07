<?php
session_start();
require_once('../../config/library_config.php');
require_once('../../config/fungsi_model_data.php');

switch($_GET['act']){
	case 'id_kategori'	:
  break;

  case 'simpan_kategori' :
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_kategori' => '"'.$_POST['nama_kategori'].'"'
			);
			$table = 'kategori';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data kategori : '.$input['nama_kategori'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data kategori : '.$input['nama_kategori'].' gagal ditambah');
			}
		}
  break;

	case 'update_kategori':
		if(isset($_POST['Submit'])){
			$clause = array('id_kategori' => $_POST['id_kategori']);
			$input = array(
				'nama_kategori' => '"'.$_POST['nama_kategori'].'"'
			);
			$table = 'kategori';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_kategori'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_kategori'].' gagal.');
			}
	break;

	case 'delete_kategori':
		$table  = 'kategori';
		$clause = array('id_kategori' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_kategori'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_kategori'].' gagal.');
		}
	break;

}
redirect (base_url('index.php?page=kategori'));
?>