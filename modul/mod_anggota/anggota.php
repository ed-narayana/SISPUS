<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";
date_default_timezone_set("Asia/Makassar");

function data_anggota(){
	//fetch data
	$anggota = fetch_data('member');
	echo '
		<table class="table table-condensed table-bordered">
			<tr>
				<th>ID Anggota</th>
				<th>Nama Anggota</th>
				<TH>jenis kelamin</th>
				<th>Alamat</th>
				<th>No Telepon</th>
				<th>Tempat Lahir</th>
				<th>Tanggal Lahir</th>
				<th>Tanggal Gabung </th>
				<th>Wilayah</th>
				<th colspan="2">Aksi</th>
			</tr>
	';
	foreach($anggota as $data){
		$id = $data['id'];
		$update = base_url('index.php?page=anggota&act=update&id='.$data['id']);
		$delete = base_url('modul/mod_anggota/aksi_anggota.php?act=delete&id='.$data['id']);
		echo '
			<tr>
				<td>'.$id.'</td>
				<td>'.$data['nama'].'</td>
				<td>'.$data['jk'].'</td>
				<td>'.$data['alamat'].'</td>
				<td>'.$data['telp'].'</td>				
				<td>'.$data['tempat'].'</td>
  				<td>'.$data['tanggallahir'].'</td>
				<td>'.$data['tanggalgabung'].'</td>
				<td>'.$data['wilayah'].'</td>
				


				<td align="center">
					<a href="'.$update.'">
						<span class="glyphicon glyphicon-edit"></span>
						<span class="sr-only">Update</span>
					</a>
				</td>
				<td align="center">
					<a href="'.$delete.'" data-confirm="Anda yakin ingin menghapus data id : '.$id.' ?">
						<span class="glyphicon glyphicon-trash"></span>
						<span class="sr-only">Delete</span>	</a>
				</td>
			</tr>
		';
	}
	echo '</table>';
}

function form_tambah(){
	$action = base_url("modul/mod_anggota/aksi_anggota.php?act=tambah");
	$wilayah = fetch_data('wilayah');
	$list = '';
	foreach ($wilayah as $data) {
		$list .= '<option value="'.$data['id_wilayah'].'">'.$data['nama_wilayah'].'</option>';
	}
	$tgl_gbng = date("Y-m-d");
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="nama">Nama Anggota</label>
						<input type="text" class="form-control" id="nama_anggota" name="nama" require/>
						<label for ="nama"> jenis kelamin </label>
						<div class="radio">
  							<label><input type="radio"  id="jk" name="jk" value="L" checked>Laki-Laki</label>
						    <label><input type="radio" id="jk" name="jk" value="P">Perempuan</label>
						</div>

						<label for="nama">Alamat</label>
						<input type="text" class="form-control" id="alamat" name="alamat" require/>
						<label for="nama">nomor telpon</label>
						<input type="text" class="form-control" id="no_telp" name="telpon" require/>
						<label for="nama"> Tanggal Lahir</label>
						<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" require/>
						<label for="nama">Tempat Lahir</label>
						<input type="text" class="form-control" id="tempat" name="tempat" require/>
							<label for="nama"> Tanggal Gabung</label>
					
						<input type="text" class="form-control" id="tgl_gbng" name="tanggal_gabung" value="'.$tgl_gbng.'" readonly="readonly" />
					
							<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<select class="form-control" id="wilayah" name="wilayah">
							'.$list.'
						</select>
				  
					</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Create Data" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
					</div>
				</form>
			</div>
		</div>
	';
}

function form_update(){
	$clause = array(
		array(
			'id_anggota',
			' = ',
			$_GET['id']
		)
	);
	$limit  = 1;
	$data   = fetch_data('anggota', $clause, $limit);
	if(!$data)
	{
		set_flashdata('error', 'Data id : '.$_GET['id'].' tidak ditemukan.');
		redirect(base_url('index.php?page=anggota'));
	}
	$action = base_url('modul/mod_anggota/aksi_anggota.php?act=update');
	$wilayah = fetch_data('wilayah');
	$list = '';
	foreach ($wilayah as $cabang) {
		if($cabang['id_wilayah'] == $data[0]['id_wilayah_anggota'])
		{
			$list .= '<option value="'.$cabang['id_wilayah'].'" selected="selected">'.$cabang['nama_wilayah'].'</option>';	
		} else
		{
			$list .= '<option value="'.$cabang['id_wilayah'].'">'.$cabang['nama_wilayah'].'</option>';
		}
	}
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Update Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" id="id" name="id" value="'.$data[0]['id_anggota'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="nama">Nama Anggota</label>
						<input type="text" class="form-control" id="nama" name="nama" value="'.$data[0]['nama_anggota'].'" />
					</div>

					<div class="form-group">
						<label for="nama">Alamat Anggota</label>
						<input type="text" class="form-control" id="nama" name="alamat" value="'.$data[0]['alamat'].'" />
					</div>
						<div class="radio">

  							<label><input type="radio" name="jk" value="L">Laki-Laki</label>
						    <label><input type="radio" name="jk" value="P">Perempuan</label>
						</div>


					<div class="form-group">
						<label for="nama">Telepon</label>
						<input type="text" class="form-control" id="nama" name="telpon" value="'.$data[0]['no_telp'].'" />
					</div>
					<div class="form-group">
						<label for="nama">Tempat Lahir</label>
						<input type="text" class="form-control" id="nama" name="tempat" value="'.$data[0]['tempat_lahir'].'" />
					</div>
					<div class="form-group">
						<label for="nama">Tanggal Lahir</label>
						<input type="date" class="form-control" id="nama" name="tanggal_lahir" value="'.$data[0]['tanggal_lahir'].'" />
					</div>
					<div class="form-group">
						<label for="nama">Tanggal Gabung</label>
						<input type="date" class="form-control" id="nama" name="tanggal_gabung" value="'.$data[0]['tanggal_gabung'].'" readonly="readonly"  />
					</div>
					<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<select class="form-control" id="wilayah" name="wilayah">
							'.$list.'
						</select>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Update Data" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
						&nbsp;
						<a href="'.base_url('index.php?page=anggota').'" class="btn btn-default">Kembali</a>
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
	<div class='col-sm-8 col-md-8'><?php data_anggota(); ?></div>
</div>
