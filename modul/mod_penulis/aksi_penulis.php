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
				'telepon_penulis' => '"'.$_POST['telp_penulis'].'"'
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

	case 'update_wilayah':
		if(isset($_POST['Submit'])){
			$clause = array('id_wilayah' => $_POST['id_wilayah']);
			$input = array(
				'nama_wilayah' => '"'.$_POST['nama_wilayah'].'"'
			);
			$table = 'wilayah';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_wilayah'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_wilayah'].' gagal.');
			}
		}
	break;

	case 'delete_wilayah':
		$table  = 'wilayah';
		$clause = array('id_wilayah' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_wilayah'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_wilayah'].' gagal.');
		}
	break;

}
redirect (base_url('index.php?page=penulis'));
?>
