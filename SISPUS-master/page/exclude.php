<?php
function title(){
	$title = isset($_GET['page']) ? $_GET['page'] : '';
	switch($title){
		case 'wilayah'	: $title = 'Data Wilayah Cabang';			break;
		case 'penulis'	: $title = 'Data Penulis Buku';				break;
		case 'penerbit'	: $title = 'Data Penerbit Buku';			break;
		case 'kategori'	: $title = 'Data Kategori Buku';			break;
		case 'admin'	: $title = 'Data Admin';					break;
		case 'transaksi': $title = 'Data Transaksi Pinjam Buku';	break;
		case 'buku'		: $title = 'Data Buku';						break;
		case 'anggota'	: $title = 'Data Anggota';					break;
		case ''			:
		default 		: $title = 'Sistem Informasi Manajemen Perpustakaan';	break;
	}
	return $title;
}

function content(){
	if(isset($_SESSION['logged_in'])){
		$mod = isset($_GET['page']) ? $_GET['page'] : '';
		switch($mod){
			case '' 			: include 'modul/mod_home/home.php'; 			break;
			case 'wilayah'		: include 'modul/mod_wilayah/wilayah.php';		break;
			case 'penulis'		: include 'modul/mod_penulis/penulis.php';		break;
			case 'penerbit'		: include 'modul/mod_penerbit/penerbit.php';	break;
			case 'kategori'		: include 'modul/mod_kategori/kategori.php';	break;
			case 'admin'		: include 'modul/mod_admin/admin.php';			break;
			case 'transaksi'	: include 'modul/mod_transaksi/transaksi.php';	break;
			case 'buku'			: include 'modul/mod_buku/buku.php';			break;
			case 'anggota'		: include 'modul/mod_anggota/anggota.php';		break;
			case 'logout'		: redirect(base_url('modul/mod_autentikasi/aksi_autentikasi.php?act=logout')); break;
			default				: include 'modul/mod_warning/error.php';		break;
		} 
	} else {
		include 'modul/mod_autentikasi/autentikasi.php';	
	}
}

function menu(){
	if(isset($_SESSION['logged_in'])){
		$link = array(
			'home'		=> base_url(),
			'wilayah'	=> base_url('index.php?page=wilayah'),
			'penulis'	=> base_url('index.php?page=penulis'),
			'penerbit'	=> base_url('index.php?page=penerbit'),
			'kategori'	=> base_url('index.php?page=kategori'),
			'admin'		=> base_url('index.php?page=admin'),
			'transaksi'	=> base_url('index.php?page=transaksi'),
			'buku'		=> base_url('index.php?page=buku'),
			'anggota'	=> base_url('index.php?page=anggota'),
			'logout'	=> base_url('index.php?page=logout')
		);
		echo "
		<nav class='navbar navbar-default navbar-fixed-top'>
			<div class='container-fluid'>
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class='navbar-header'>
					<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
						<span class='sr-only'>Toggle navigation</span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a class='navbar-brand' href='#'>Perpustakaan</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
					<ul class='nav navbar-nav'>
						<li><a href='".$link['home']."'><span class='glyphicon glyphicon-home'></span> Home</a></li>
						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-th-large'></span> Data Master <span class='caret'></span></a>
							<ul class='dropdown-menu'>
								<li><a href='".$link['wilayah']."'><span class='glyphicon glyphicon-tree-conifer'></span> Data Wilayah</a></li>
								<li><a href='".$link['penulis']."'><span class='glyphicon glyphicon-tree-conifer'></span> Data Penulis</a></li>
								<li><a href='".$link['penerbit']."'><span class='glyphicon glyphicon-tree-conifer'></span> Data Penerbit</a></li>
								<li><a href='".$link['kategori']."'><span class='glyphicon glyphicon-tree-conifer'></span> Data Kategori</a></li>
							</ul>
						</li>
						<li><a href='".$link['admin']."'><span class='glyphicon glyphicon-th-large'></span> Data Administrator</a></li>
						<li><a href='".$link['anggota']."'><span class='glyphicon glyphicon-th-large'></span> Data Anggota</a></li>
						<li><a href='".$link['buku']."'><span class='glyphicon glyphicon-th-large'></span> Data Buku</a></li>
						<li><a href='".$link['transaksi']."'><span class='glyphicon glyphicon-th-large'></span> Data Transaksi Buku</a></li>
						<li><a href='".$link['logout']."'><span class='glyphicon glyphicon-tree-conifer'></span> Logout</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		";
	}
}