<?php
session_start();
require_once('../../config/library_config.php');
require_once('../../config/fungsi_model_data.php');
switch($_GET['act']){
	case 'id_penerbit'	:
  break;
  case 'simpan_penerbit' :
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_penerbit' => '"'.$_POST['nama_penerbit'].'"',
				'alamat_penerbit' => '"'.$_POST['alamat_penerbit'].'"',
				'telp_penerbit' => '"'.$_POST['telp_penerbit'].'"'
			);
			$table = 'penerbit';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data penerbit : '.$input['nama_penerbit'].''.$input['alamat_penerbit'].''.$input['telp_penerbit'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data penerbit : '.$input['nama_penerbit'].''.$input['alamat_penerbit'].''.$input['telp_penerbit'].' gagal ditambah');
			}
		}
  break;
	case 'update_penerbit':
		if(isset($_POST['Submit'])){
			$clause = array('id_penerbit' => $_POST['id_penerbit']);
			$input = array(
				'nama_penerbit' => '"'.$_POST['nama_penerbit'].'"',
				'alamat_penerbit' => '"'.$_POST['alamat_penerbit'].'"',
				'telp_penerbit' => '"'.$_POST['telp_penerbit'].'"'
			);
			$table = 'penerbit';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_penerbit'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_penerbit'].' gagal.');
			}
		}
	break;
	case 'delete_penerbit':
		$table  = 'penerbit';
		$clause = array('id_penerbit' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_penerbit'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_penerbit'].' gagal.');
		}
	break;
}
redirect (base_url('index.php?page=penerbit'));
?>
