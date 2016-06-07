<?php
include "../../config/library_config.php";
include "../../config/fungsi_model_data.php";
switch($_GET['act']){
	case 'tambah':
		if(isset($_POST['nama'])){
			$conn = MysqlConnectionOpen();
			$sukses = 1;
			$input = array(
				$_POST['nama'],
				$_POST['wilayah'],
				$_POST['tgl_pinjam'],
				$_POST['tgl_harus_kembali'],
				0
			);
			$table = array('master_transaksi', 'detail_transaksi');
			$query = '	INSERT INTO '.$table[0].'
						VALUES(
							NULL,
							'.$input[0].',
							'.$input[1].',
							"'.$input[2].'",
							"'.$input[3].'",
							NULL,
							NULL,
							'.$input[4].'
						);
			';
			$exec = mysqli_query($conn, $query);
			if($exec){
				$last_id = mysqli_insert_id($conn);
			} else {
				set_flashdata('error', 'tambah transaksi error');
				break;
			}
			$sukses = $sukses && $exec;
			do{
				$pinjam = current($_POST['pinjam']);
				$jumlah = current($_POST['jumlah']);
				$query = '	INSERT INTO '.$table[1].'
							VALUES(
								NULL,
								'.$last_id.',
								'.$pinjam.',
								'.$jumlah.'
							);
				';
				$exec = mysqli_query($conn, $query);
				$sukses = $sukses && $exec;
			}while(next($_POST['pinjam']) && next($_POST['jumlah']));
		}
	break;
	
	case 'update':
		if(isset($_POST['Submit'])){
			$clause = array('id_master_transaksi' => $_POST['id']);
			$input = array(
				'tgl_kembali' => '"'.$_POST['tgl_kembali'].'"',
				'denda'	 => $_POST['denda'],
				'status' => 1
			);
			$table = 'master_transaksi';
			$update = update($table, $input, $clause);
			if($update){
				set_flashdata('sukses', 'Update data id : '.$clause['id_master_transaksi'].' berhasil.');
			} else {
				set_flashdata('error', 'Update data id : '.$clause['id_master_transaksi'].' gagal.');
			}
		}
	break;
	
	case 'delete':
		$table  = array('detail_transaksi', 'master_transaksi');
		$clause = array('id_master_transaksi' => $_GET['id']);
		
		if(delete($table[0],$clause) && delete($table[1], $clause)){
			set_flashdata('sukses', 'Delete data id : '.$clause['id_master_transaksi'].' berhasil.');
		} else {
			set_flashdata('error', 'Delete data id : '.$clause['id_master_transaksi'].' gagal.');
		}
	break;
}
//exit();
redirect(base_url("index.php?page=transaksi"));