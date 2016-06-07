<?php
session_start();
require_once('../../config/library_config.php');
require_once('../../config/fungsi_model_data.php');

switch($_GET['act']){
	case 'id_wilayah'	:
  break;

  case 'simpan_wilayah' :
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_wilayah' => '"'.$_POST['nama_wilayah'].'"'
			);
			$table = 'wilayah';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data wilayah : '.$input['nama_wilayah'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data wilayah : '.$input['nama_wilayah'].' gagal ditambah');
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
redirect (base_url('index.php?page=wilayah'));
?>
