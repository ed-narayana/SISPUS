<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";
date_default_timezone_set("Asia/Makassar");

function data_transaksi(){
	//fetch data
	$transaksi = fetch_data('transaksi_pinjam');
	echo '
		<table class="table table-condensed table-bordered">
			<tr>
				<th>ID</th>
				<th>Nama Anggota</th>
				<th>Wilayah</th>
				<th>Tgl Pinjam</th>
				<th>Tgl Harus Kembali</th>
				<th>Tgl Kembali</th>
				<th>Denda</th>
				<th>Status</th>
				<th colspan="3">Aksi</th>
			</tr>
	';
	foreach($transaksi as $data){
		$id = $data['id_transaksi'];
		$status = ($data['status']) ? 'Kembali' : 'Belum Kembali';
		$update = base_url('index.php?page=transaksi&act=update&id='.$data['id_transaksi']);
		$delete = base_url('modul/mod_transaksi/aksi_transaksi.php?act=delete&id='.$data['id_transaksi']);
		echo '
			<tr>
				<td>'.$id.'</td>
				<td>'.$data['nama_anggota'].'</td>
				<td>'.$data['wilayah'].'</td>
				<td>'.$data['tgl_pinjam'].'</td>
				<td>'.$data['tgl_harus_kembali'].'</td>
				<td>'.$data['tgl_kembali'].'</td>
				<td>'.$data['denda'].'</td>
				<td>'.$status.'</td>
				<td align="center">
					<a href="'.$update.'">
						<span class="glyphicon glyphicon-edit"></span>
						<span class="sr-only">Update</span>
					</a>
				</td>
				<td align="center">
					<a href="'.$delete.'" data-confirm="Anda yakin ingin menghapus data id : '.$id.' ?">
						<span class="glyphicon glyphicon-trash"></span>
						<span class="sr-only">Delete</span>
					</a>
				</td>
			</tr>
		';
	}
	echo '</table>';
}

function data_detail_transaksi(){
	$clause = array(
		array(
			'id_master_transaksi',
			' = ',
			$_GET['id']
		)
	);
	//fetch data
	$detail_transaksi = fetch_data('transaksi_pinjam_detail', $clause);
	echo '
		<table class="table table-condensed table-bordered">
			<tr>
				<th>ID</th>
				<th>ID Buku</th>
				<th>Judul Buku</th>
				<th>Jumlah Buku</th>
			</tr>
	';
	foreach($detail_transaksi as $data){
		echo '
			<tr>
				<td>'.$data['id_detail_transaksi'].'</td>
				<td>'.$data['id_buku'].'</td>
				<td>'.$data['judul_buku'].'</td>
				<td>'.$data['jumlah_buku'].'</td>
			</tr>
		';
	}
	echo '</table>';
}

function form_tambah(){
	$action = base_url("modul/mod_transaksi/aksi_transaksi.php?act=tambah");
	
	$anggota = fetch_data('anggota');
	$list_anggota = '';
	foreach ($anggota as $data) {
		$list_anggota .= '<option value="'.$data['id_anggota'].'">'.$data['nama_anggota'].'</option>';
	}

	$wilayah = fetch_data('wilayah');
	$list_wilayah = '';
	foreach ($wilayah as $data) {
		$list_wilayah .= '<option value="'.$data['id_wilayah'].'">'.$data['nama_wilayah'].'</option>';
	}

	$tgl_pinjam = date("Y-m-d H:i:s");
	$rentang_hari = 5;
	$tgl_kembali = date("Y-m-d H:i:s", strtotime("+".$rentang_hari." days"));
	
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Data</div>
			<div class="panel-body">
				<form action="'.$action.'" name="tambah_transaksi" method="POST">
					<div class="form-group">
						<label for="nama">Nama Peminjam</label>
						<select class="form-control" id="nama" name="nama">
							'.$list_anggota.'
						</select>
					</div>

					<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<select class="form-control" id="wilayah" name="wilayah">
							'.$list_wilayah.'
						</select>
					</div>
					
					<div class="form-group">
						<label for="tgl_pinjam">Tgl. Pinjam</label>
						<input type="text" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="'.$tgl_pinjam.'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="tgl_harus_kembali">Tgl. Harus Kembali</label>
						<input type="text" class="form-control" id="tgl_harus_kembali" name="tgl_harus_kembali" value="'.$tgl_kembali.'" readonly="readonly" />
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" id="pilih_buku" value="Pilih Buku" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
					</div>
					<div id="additional_parameter" style="display:none;"></div>
					'.modal_buku_for_tambah().'
				</form>
			</div>
		</div>
	';
}

function modal_buku_for_tambah(){
	$buku = fetch_data('daftar_buku_pinjam');
	$list_table = '';
	$i = 0;
	foreach($buku as $data){
		$id = $data['id_buku'];

		$centang = '
			<label class="form-control">
				<input type="checkbox" name="pinjam[]" value="'.$id.'" data-check="'.$i.'" /> Pinjam
			</label>
		';
		$textbox = '
			<input type="text" class="form-control" name="jumlah[]" data-jumlah="'.$i.'" value="1" disabled="disabled" />
		';

		$list_table .= '
			<tr>
				<td>'.$centang.'</td>
				<td class="col-md-1">'.$textbox.'</td>
				<td>'.$id.'</td>
				<td>'.$data['judul_buku'].'</td>
				<td>'.$data['penerbit_buku'].'</td>
				<td>'.$data['penulis_buku'].'</td>
				<td>'.$data['sisa_buku'].'</td>
			</tr>
		';
		$i++;
	}
	echo '

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Pilih Buku Yang Dipinjam</h4>
					</div>
					<div class="modal-body">
						<table class="table table-condensed table-bordered">
							<tr>
								<th colspan="2">Aksi</th>
								<th>ID Buku</th>
								<th>Judul Buku</th>
								<th>Penerbit</th>
								<th>Penulis</th>
								<th>Sisa</th>								
							</tr>
							'.$list_table.'
						</table>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" id="real_submit" name="Submit" value="Pinjam Buku" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	';
}

function form_update(){
	$clause = array(
		array(
			'id_transaksi',
			' = ',
			$_GET['id']
		)
	);
	$limit  = 1;
	$data   = fetch_data('transaksi_pinjam', $clause, $limit);
	if(!$data){
		set_flashdata('error', 'Data id : '.$_GET['id'].' tidak ditemukan.');
		redirect(base_url('index.php?page=transaksi'));
	}
	$action = base_url('modul/mod_transaksi/aksi_transaksi.php?act=update');
	$disabled = ($data[0]['status']) ? 'disabled="disabled" ' : '';
	$tgl_harus_kembali = date('Y-m-d', strtotime($data[0]['tgl_harus_kembali']));
	$tgl_kembali = date('Y-m-d');

	$x = explode('-', $tgl_harus_kembali);
	$y = explode('-', $tgl_kembali);

	$tgl_K = GregorianToJD($x[1], $x[2], $x[0]);
	$tgl_N = GregorianToJD($y[1], $y[2], $y[0]);

	$denda = 1000;
	if(($hasil = $tgl_N - $tgl_K) > 0){
		$denda *= $hasil; 
	} else {
		$denda = 0;
	}
	$tgl_kembali = date('Y-m-d H:i:s');
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Update Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" id="id" name="id" value="'.$data[0]['id_transaksi'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="nama">Nama Anggota</label>
						<input type="text" class="form-control" id="nama" name="nama" value="'.$data[0]['nama_anggota'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<input type="text" class="form-control" id="wilayah" name="wilayah" value="'.$data[0]['wilayah'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="tgl_pinjam">Tgl Pinjam</label>
						<input type="text" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="'.$data[0]['tgl_pinjam'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="tgl_harus_kembali">Tgl Harus Kembali</label>
						<input type="text" class="form-control" id="tgl_harus_kembali" name="tgl_harus_kembali" value="'.$data[0]['tgl_harus_kembali'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="tgl_kembali">Tgl Kembali</label>
						<input type="text" class="form-control" id="tgl_kembali" name="tgl_kembali" value="'.$tgl_kembali.'" readonly="readonly" />
					</div>
					
					<div class="form-group">
						<label for="denda">Denda (Rp)</label>
						<input type="text" class="form-control" id="denda" name="denda" value="'.$denda.'" readonly="readonly" />
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Kembalikan Buku" '.$disabled.'/>
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
						&nbsp;
						<a href="'.base_url('index.php?page=transaksi').'" class="btn btn-default">Kembali</a>
					</div>
				</form>
			</div>
		</div>
	';
}

function form($act){
	if($act == 'update'){
		form_update();
	} else {
		form_tambah();
	}
}

function data($act){
	if($act == 'update'){
		data_detail_transaksi();
	} else {
		data_transaksi();
	}
}

function messages(){
	if(check_flashdata('sukses')){
		echo '
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						'.flashdata('sukses').'
					</div>
				</div>
			</div>
		';
	} else if(check_flashdata('error')){
		echo '
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-danger alert-dismissible" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						'.flashdata('error').'
					</div>
				</div>
			</div>
		';
	}
}
?>

<?php messages(); ?>
<div class='row'>
	<div class='col-sm-4 col-md-4'><?php form($act); ?></div>
	<div class='col-sm-8 col-md-8'><?php data($act); ?></div>
</div>

<script>
$(document).ready(function(){
	$('#pilih_buku').click(function(e){
		e.preventDefault();
		$('#myModal').modal('toggle');
	});

	$('input[type="checkbox"][name="pinjam[]"]').click(function(){
		var index_click = $(this).data('check');
		var dis = $(this);
		
		$('input[type="text"][name="jumlah[]"]').each(function(i, e){
			if(i == index_click){
				if(dis.prop('checked')){
					$(e).removeAttr('disabled');
				} else {
					$(e).attr('disabled', 'disabled');
				}		
				return false;
			}
		}); 
	});

	$('input[type="submit"][id="real_submit"]').click(function(){
		$('input[type="checkbox"][name="pinjam[]"]').each(function(i){
			$('form[name="tambah_transaksi"]').append($('input[type="checkbox"][data-check="'+i+'"]'));
			$('form[name="tambah_transaksi"]').append($('input[type="text"][data-jumlah="'+i+'"]'));
		});
		$('form[name="tambah_transaksi"]').submit();
	});
});
</script>