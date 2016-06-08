<?php			
session_start();
include "../../config/library_config.php";
include "../../config/fungsi_model_data.php";
switch($_GET['act']){
	case 'tambah':
		if(isset($_POST['Submit'])){
			$input = array(
				'nama_buku' => '"'.$_POST['nama'].'"',
				'isbn'	 => '"'.$_POST['isbn'].'"',
				'tanggal_terbit'	 => '"'.$_POST['tglter'].'"',
				'jumlah_buku'	 => '"'.$_POST['jum'].'"',
				'id_kategori_buku'	 => '"'.$_POST['kategori'].'"',
				'id_penulis_buku'	 => '"'.$_POST['penulis'].'"',
				'id_penerbit_buku'	 => '"'.$_POST['penerbit'].'"',
				'id_wilayah_buku' => $_POST['wilayah']
			);
			$table = 'buku';
			$insert = insert($table, $input);
			if($insert){
				set_flashdata('sukses', 'Data nama : '.$input['nama_buku'].' berhasil ditambah');
			} else {
				set_flashdata('error', 'Data nama : '.$input['nama_buku'].' gagal ditambah');
			}
		
		}
break;
	case 'update':
		$clause = array('id_buku' => $_POST['id']);
			$input =array(
						'nama_buku' => '"'.$_POST['nama'].'"',
				'isbn'	 => '"'.$_POST['isbn'].'"',
				'tanggal_terbit'	 => '"'.$_POST['tglter'].'"',
				'jumlah_buku'	 => '"'.$_POST['jum'].'"',
				'id_kategori_buku'	 => '"'.$_POST['kategori'].'"',
				'id_penulis_buku'	 => '"'.$_POST['penulis'].'"',
				'id_penerbit_buku'	 => '"'.$_POST['penerbit'].'"',
				'id_wilayah_buku' => $_POST['wilayah']
				);
			$table = 'buku';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_buku'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_buku'].' gagal.');
			}	

	break;
	
	case 'delete':
		$table  = 'buku';
		$clause = array('id_buku' => $_GET['id']);
		$delete = delete($table, $clause);
		if($delete){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_buku'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_buku'].' gagal.');
		}
	break;
}redirect (base_url('index.php?page=buku'));
?>