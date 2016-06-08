<?php
$act = isset($_GET['act']) ? $_GET['act'] : "";

function data_buku(){
	//fetch data
	$buku = fetch_data('book');
	echo '
		<table class="table table-condensed table-bordered">
			<tr>
				<th>ID buku</th>
				<th>Nama buku</th>
				<TH>penerbit</th>
				<th>Wilayah</th>
				<th>kategori</th>
				<th>Penulis</th>
				<th>ISBN</th>
				<th>Jumlah</th>
				<th> Tanggal terbit</th>
				<th colspan="2">Aksi</th>
			</tr>
	';
	foreach($buku as $data){
		$id = $data['id'];
		$update = base_url('modul/mod_buku/aksi_buku.php?act=update&id='.$data['id']);
		$delete = base_url('modul/mod_buku/aksi_buku.php?act=delete&id='.$data['id']);
		echo '
			<tr>
				<td>'.$id.'</td>
				<td>'.$data['judul'].'</td>
				<td>'.$data['penerbit'].'</td>
				<td>'.$data['lokasi'].'</td>
				<td>'.$data['kategori'].'</td>				
				<td>'.$data['penulis'].'</td>
  				<td>'.$data['isbn'].'</td>
				<td>'.$data['Jumlah'].'</td>
				<td>'.$data['tanggal'].'</td>
				


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
					</a>
				</td>
			</tr>
		';
	}
	echo '</table>';
}

function form_tambah(){

	$action = base_url("modul/mod_buku/aksi_buku.php?act=tambah");
	
	$wilayah = fetch_data('wilayah');
	$list = '';
	foreach ($wilayah as $data) {
		$list .= '<option value="'.$data['id_wilayah'].'">'.$data['nama_wilayah'].'</option>';
	}
	
	$kategori = fetch_data('kategori');
	$list3= '';
	foreach ($kategori as $data3) {
		$list3 .= '<option value="'.$data3['id_kategori'].'">'.$data3['nama_kategori'].'</option>';
	}	
	$penerbit = fetch_data('penerbit');
	$list1= '';
	foreach ($penerbit as $data1) {
		$list1 .= '<option value="'.$data1['id_penerbit'].'">'.$data1['nama_penerbit'].'</option>';
	}$penulis = fetch_data('penulis');
	$list2 = 	'';
	foreach ($penulis as $data2) {
		$list2 .= '<option value="'.$data2['id_penulis'].'">'.$data2['nama_penulis'].'</option>';
	}
	echo '
			<div class="panel panel-default">
			<div class="panel-heading">Tambah Data</div>
			<div class="panel-body">
<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="nama">Nama buku</label>
						<input type="text" class="form-control" id="nama" name="nama" require/>
						<label for="nama">ISBN</label>
						<input type="text" class="form-control" id="ISBN" name="isbn" require/>
						<label for="nama">Jumlah</label>
						<input type="number" class="form-control" id="no_telp" name="jum" require/>
						<label for="nama"> Tanggal terbit </label>
						<input type="date" class="form-control" id="tanggal_terbit" name="tglter" require/>
							<div class="form-group">
						<label for="wilayah">kategori</label>
						<select class="form-control" id="kategori" name="kategori">
							'.$list3.'
						</select>
				  </div>

							<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<select class="form-control" id="wilayah" name="wilayah">
							'.$list.'
						</select>
				  
					</div>
			
			<div class="form-group">
						<label for="wilayah">Penerbit</label>
						<select class="form-control" id="penerbit" name="penerbit">
							'.$list1.'
						</select>
				  
					</div>
							<div class="form-group">
						<label for="wilayah">Penulis</label>
						<select class="form-control" id="penulis" name="penulis">
							'.$list2.'
						</select>
				  
					</div>
				

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="Submit" value="Create Data" />
						&nbsp;
						<input type="reset" class="btn btn-default" name="Reset" value="Reset" />
					</div>
					</div>
				</form>
			</div>
				
		</div>
		
	';
}

function form_update(){
	$clause = array(
		array(
			'id_buku',
			' = ',
			$_GET['id']
		)
	);
	$limit  = 1;
	$data   = fetch_data('buku', $clause, $limit);
	
	if(!$data){
		set_flashdata('error', 'Data id : '.$_GET['id'].' tidak ditemukan.');
		redirect(base_url('index.php?page=buku'));
	}
	$action = base_url('modul/mod_buku/aksi_buku.php?act=update');
	
	$kategori = fetch_data('kategori');
	$list3= '';
	foreach ($kategori as $cat) {
		if($kategori['id_kategori'] == $data[0]['id_kategori_buku']){
			$list3 .= '<option value="'.$cat['id_kategori'].'" selected="selected">'.$cat['nama_kategori'].'</option>';	
		} else {
			$list3 .= '<option value="'.$cat['id_kategori'].'">'.$cat['nama_kategori'].'</option>';
		}
	}
$wilayah = fetch_data('wilayah');
	$list = '';
	foreach ($wilayah as $cabang) {
		if($cabang['id_wilayah'] == $data[0]['id_wilayah_buku']){
			$list .= '<option value="'.$cabang['id_wilayah'].'" selected="selected">'.$cabang['nama_wilayah'].'</option>';	
		} else {
			$list .= '<option value="'.$cabang['id_wilayah'].'">'.$cabang['nama_wilayah'].'</option>';
		}
	}
$penerbit = fetch_data('penerbit');
	$list1 = '';
	foreach ($penerbit as $penerbitan) {
		if($penerbitan['id_penerbit'] == $data[0]['id_penerbit_buku']){
			$list1 .= '<option value="'.$penerbitan['id_penerbit'].'" selected="selected">'.$penerbitan['nama_penerbit'].'</option>';	
		} else {
			$list1 .= '<option value="'.$penerbitan['id_penerbit'].'">'.$penerbitan['nama_penerbit'].'</option>';
		}
	}
$penerbit = fetch_data('penulis');
	$list2 = '';
	foreach ($penulis as $author) {
		if($author['id_penulis'] == $data[0]['id_penulis_buku']){
			$list2 .= '<option value="'.$author['id_penulis'].'" selected="selected">'.$author['nama_penulis'].'</option>';	
		} else {
			$list2 .= '<option value="'.$author['id_penulis'].'">'.$author['nama_penulis'].'</option>';
		}
	}
	echo '
		<div class="panel panel-default">
			<div class="panel-heading">Update Data</div>
			<div class="panel-body">
				<form action="'.$action.'" method="POST">
					<div class="form-group">
						<label for="id">ID</label>
						<input type="text" class="form-control" id="id" name="id_buku" value="'.$data[0]['id_buku'].'" readonly="readonly" />
					</div>

					<div class="form-group">
						<label for="nama">Nama Buku</label>
						<input type="text" class="form-control" id="nama" name="nama_buku" value="'.$data[0]['nama_buku'].'" />
					</div>

					<div class="form-group">
						<label for="nama">ISBN</label>
						<input type="text" class="form-control" id="nama" name="ISBN" value="'.$data[0]['ISBN'].'" />
			


					<div class="form-group">
						<label for="nama">Jumlah</label>
						<input type="number" class="form-control" id="nama" name="Jumlah" value="'.$data[0]['jum'].'i" />
					</div>
		
					<div class="form-group">
						<label for="nama">Tanggal terbit</label>

						<input type="date" class="form-control" id="nama" name="tanggal_terbit" value="'.$data[0]['tanggal_terbit'].'" />
					</div>

					<div class="form-group">
						<label for="kategori">kategori</label>
						<select class="form-control" id="kategori" name="kategori">
							'.$list3.'
						</select>
					</div>

					
					<div class="form-group">
						<label for="wilayah">Wilayah</label>
						<select class="form-control" id="wilayah" name="wilayah">
							'.$list.'
						</select>
					</div>

					<div class="form-group">
						<label for="penerbit">penerbit</label>
						<select class="form-control" id="penerbit" name="penerbit">
							'.$list1.'
						</select>
					</div>

					<div class="form-group">
						<label for="wilayah">penulis</label>
						<select class="form-control" id="penulis" name="penulis">
							'.$list2.'
						</select>
					</div>


					<div class="form-group">
						<input type=penerbitrbitlass="btn btn-primary" name="Submit" value="Update Data" />
						&nbsp;
						<inp1upenerbit"reset" penerbitbtn btn-default" name="Reset" value="Reset" />
						&nbsp;
						<a href="'.base_url('index.php?page=buku').'" class="btn btn-default">Kembali</a>
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
	<div class='col-sm-8 col-md-8'><?php data_buku(); ?></div>
</div>
