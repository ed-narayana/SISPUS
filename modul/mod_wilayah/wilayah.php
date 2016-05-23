<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";

function data_wilayah(){
	//fetch data
	$wilayah = fetch_data('wilayah');
	echo '
		<table class="table table-condensed table-bordered">
			<tr>
				<th>ID Wilayah</th>
				<th>Nama Wilayah</th>
				<th colspan="2">Aksi</th>
			</tr>
	';
	foreach($wilayah as $data){
		$id = $data['id_wilayah'];
		$update = base_url('index.php?page=wilayah&act=update&id='.$data['id_wilayah']);
		$delete = base_url('modul/mod_wilayah/aksi_wilayah.php?act=delete_wilayah&id='.$data['id_wilayah']);
		echo '
			<tr>
				<td>'.$id.'</td>
				<td>'.$data['nama_wilayah'].'</td>
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

function form_tambah(){
	$action = base_url("modul/mod_wilayah/aksi_wilayah.php?act=simpan_wilayah");
	$wilayah = fetch_data('wilayah');
	$list = '';
	foreach ($wilayah as $data) {
		$list .= '<option value="'.$data['id_wilayah'].'">'.$data['nama_wilayah'].'</option>';
	}
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="nama">Nama Wilayah</label>
						<input type="text" class="form-control" id="nama" name="nama_wilayah" require/>
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
			'id_wilayah',
			' = ',
			$_GET['id']
		)
	);
	$limit  = 1;
	$data   = fetch_data('wilayah', $clause, $limit);
	if(!$data){
		set_flashdata('error', 'Data id : '.$_GET['id'].' tidak ditemukan.');
		redirect(base_url('index.php?page=wilayah'));
	}
	$action = base_url('modul/mod_wilayah/aksi_wilayah.php?act=update_wilayah');

	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Update Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" id="id" name="id_wilayah" value="'.$data[0]['id_wilayah'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="nama">Nama Wilayah</label>
						<input type="text" class="form-control" id="nama" name="nama_wilayah" value="'.$data[0]['nama_wilayah'].'" />
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Update Data" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
						&nbsp;
						<a href="'.base_url('index.php?page=wilayah').'" class="btn btn-default">Kembali</a>
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
	<div class='col-sm-8 col-md-8'><?php data_wilayah(); ?></div>
</div>
