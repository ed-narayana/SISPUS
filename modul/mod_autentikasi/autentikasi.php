<?php
$error = '';
if(check_flashdata('error')){
	$error = '
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
?>

<div class='row'>
<div class='col-sm-4 col-md-4 col-md-offset-4'>
<?php echo $error; ?>
<form action='<?php echo base_url('modul/mod_autentikasi/aksi_autentikasi.php?act=login'); ?>' method='POST' name='login' role='form'>
	<div class='form-group'>
		<label for='username'>Username</label>
		<input type='text' class='form-control' name='username' id='username' placeholder ='Username' />
	</div>

	<div class='form-group'>
		<label for='password'>Password</label>
		<input type='password' class='form-control' name='password' id='password' placeholder='Password' />
	</div>
	
	<input type='submit' name='submit' value='Login' class='btn btn-primary' />
</form>
</div>
</div>