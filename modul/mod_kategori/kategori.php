<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";

function data_kategori(){
	$kategori = fetch_data('kategori');
	echo '
		<table class = "table table-condensed table-bordered">
			<tr>
				<th>ID Kategori</th>
				<th>Nama Kategori</th>
				<th colspan="2">Aksi</th>
			</tr>
	';
	foreach ($kategori as $data){
		$id = $data['id_kategori'];
		$update = base_url('index.php?page=kategori&act=update&id='.$data['id_kategori']);
		$delete = base_url('modul/mod_kategori/aksi_kategori.php?act=delete_kategori&id='.$data['id_kategori]');
		echo '
			<tr>
				<td>'.$id.'</td>
				<td>'.$data['nama_kategori'].'</td>
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

function from_tambah(){
	$action = base_url("modul/mod_kategori/aksi_kategori.php?act=simpan_kategori");
	$kategori = fetch_data('kategori');
	$list = '';
	foreach ($kategori as $data) {
		$list .= '<option value="'.$data['id_kategori'].'">'.$data['nama_kategori'].'</option>';
	}
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="nama">Nama kategori</label>
						<input type="text" class="form-control" id="nama" name="nama_kategori" require/>
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
			'id_kategori',
			' = ',
			$_GET['id']
		)
	);
	$limit  = 1;
	$data   = fetch_data('kategori', $clause, $limit);
	if(!$data){
		set_flashdata('error', 'Data id : '.$_GET['id'].' tidak ditemukan.');
		redirect(base_url('index.php?page=kategori'));
	}
	$action = base_url('modul/mod_kategori/aksi_kategori.php?act=update_kategori');

	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Update Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" id="id" name="id_kategori" value="'.$data[0]['id_kategori'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="nama">Nama kategori</label>
						<input type="text" class="form-control" id="nama" name="nama_kategori" value="'.$data[0]['nama_kategori'].'" />
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Update Data" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
						&nbsp;
						<a href="'.base_url('index.php?page=kategori').'" class="btn btn-default">Kembali</a>
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
	<div class='col-sm-8 col-md-8'><?php data_kategori(); ?></div>
</div>