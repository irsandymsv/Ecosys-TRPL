@extends ('layouts.admin')

@section('judul')
	Ecosys-Buat Data Pengguna
@endsection

@section('gaya')

	<!-- .buatBaru{
		margin-top: 240px;
	} -->

	.btn.btn-success.btn-lg{
		color: black;
	}

	.nav{
		padding: 15px;
		<!-- padding-top: 0; -->
	}

	.row1{
		padding: 10px;
		padding-top: 0;
		<!-- text-align: center; -->
	}

	.r1{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		min-height: 645px;
	}

	.r2{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		min-height: 645px;

	}

	.btn.btn-default.db{
		background-color: rgb(200,200,200);
		margin-right: 5px;
	}

	.btn.btn-default.db:hover{
		background-color: rgb(180,180,180);
	}
	
@endsection

@section('nama-user')
	{{$ad->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('beranda') /admin/{{$ad->id}} @endsection
@section('pengumuman') /admin/{{$ad->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/admin/{{$ad->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection -->

@section('isi1')
	<div class="nav">
		<ol class="breadcrumb">
		  <li ><a href="/admin/{{$ad->id}}/data">Data Pengguna</a></a></li>
		  <li class="active">Buat User Baru</li>
		</ol>	
	</div>

	<div class="row1">
		<form method="POST" action="/admin/{{$ad->id}}/data/baru">
			{{csrf_field()}}

			<div class="r1">
				<div>
					<h3 style="text-align: center; margin-top: 0px; margin-bottom: 15px;">Buat Data Pengguna</h3>
				</div>
				<!-- <br> -->
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input class="form-control" type="text" name="nama" id="nama" value="{{old('nama')}}">
					<?php if ($errors->has('nama')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('nama') }}
						</div>
					<?php endif ?>
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input class="form-control" type="text" name="nik" id="nik" value="{{old('nik')}}">
					<?php if ($errors->has('nik')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('nik') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir')}}">

							<?php if ($errors->has('tempat_lahir')): ?>
								<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('tempat_lahir') }}
								</div>
							<?php endif ?>
						</div>

						<div class="col-xs-6">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{old('tanggal_lahir')}}">

							<?php if ($errors->has('tanggal_lahir')): ?>
								<div class="alert alert-danger" role="alert" style="padding: 2px;">
									{{$errors->first('tanggal_lahir') }}
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="gender">Jenis Kelamin</label><br>
					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" value="Laki-laki" id="gender">Laki-laki
					</label>

					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" value="Perempuan" " id="gender">Perempuan
					</label>
					<?php if ($errors->has('jenis_kelamin')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('jenis_kelamin') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="profesi_id">Profesi</label>
					<select class="form-control" name="profesi_id" id="profesi_id">
						<option value="">---Pilih Profesi---</option>
						<?php foreach ($profs as $prof): ?>
							<option value="{{$prof->id_prof}}">{{$prof->nama_profesi}}</option>
						<?php endforeach ?>
					</select>
					<?php if ($errors->has('profesi_id')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('profesi_id') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="no_hp">No. HP</label>
					<input class="form-control" type="text" name="no_hp" id="no_hp" value="{{old('no_hp')}}">
					<?php if ($errors->has('no_hp')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('no_hp') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="alamat_tinggal">Alamat Tinggal</label>
					<input class="form-control" type="text" name="alamat_tinggal" id="alamat_tinggal" value="{{old('alamat_tinggal')}}">
					<?php if ($errors->has('alamat_tinggal')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('alamat_tinggal') }}
						</div>
					<?php endif ?>
				</div>				

			</div>

			<div class="r2">
				<div style="margin-bottom: 40px;">
					<!-- <h3 ></h3> -->
				</div>

				<div class="form-group">
					<label for="alamat_asal">Alamat Asal</label>
					<input class="form-control" type="text" name="alamat_asal" id="alamat_asal" value="{{old('alamat_asal')}}">
					<?php if ($errors->has('alamat_asal')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('alamat_asal') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="prov">Provinsi</label>
					<select id="prov" class="form-control" name="id_prov_asal">
						<option value="">---Pilih Provinsi Asal---</option>
						<?php foreach ($provinsis as $prov): ?>
							<option value="{{$prov->id}}">{{$prov->name}}</option>
						<?php endforeach ?>
					</select>
					<?php if ($errors->has('id_prov_asal')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('id_prov_asal') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="kabupaten">Kota</label>
					<select id="kabupaten" class="form-control" name="id_kab_asal">
						<option value="">---Pilih Kota Asal---</option>
						<?php foreach ($kabs as $kab): ?>
							<option value="{{$kab->id}}">{{$kab->name}}</option>
						<?php endforeach ?>
					</select>
					<?php if ($errors->has('id_kab_asal')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('id_kab_asal') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
					<?php if ($errors->has('email')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('email') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="username" id="username" value="{{old('username')}}">
					<?php if ($errors->has('username')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('username') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<div class="input-group">
						<input type="password" class="form-control" name="password" id="password">
						<div class="input-group-addon"><button type="button" onmousedown="showPass()" onmouseup="hidePass()"><span class="glyphicon glyphicon-eye-open"></span></button>
						</div>
					</div>
					 
					 <?php if ($errors->has('password')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('password') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="id_role">Role</label>
					<select name="id_role" class="form-control">
						<option value="">---Pilih Role---</option>
						<?php foreach ($roles as $peran): ?>
							<option value="{{$peran->id}}">{{$peran->nama_role}}</option>
						<?php endforeach ?>
					</select>
					<?php if ($errors->has('id_role')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('id_role') }}
						</div>
					<?php endif ?>
				</div>
				<br>

				<div class="form-inline" style="text-align: right;">
					<a href="/admin/{{$ad->id}}/data" class="btn btn-default db" type="button">Batal</a>
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Simpan</button>
				</div>

			</div>

			<div id="myModal" class="modal fade" role="dialog">
			  	<div class="modal-dialog">

			    	<!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Konfirmasi</h4>
				      </div>

				      <div class="modal-body">
				        <p>Apakah anda ingin menyimpan data?</p>
				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				        <button class="btn btn-success" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
				      </div>
				    </div>

			  	</div>
			</div>

		</form>

	</div>
@endsection

@section('script')
<script type="text/javascript">
	function showPass() {
    	document.getElementById("password").type = "text";
	}

	function hidePass () {
		document.getElementById("password").type = "password";
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#nama').keypress(function(event) {
			var keyCode = event.which;
			if (!( (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) ) && keyCode != 8 && keyCode != 32) {
				return false;
			}
		});

		$('#alamat_tinggal').keypress(function(event) {
			var keyCode = event.which;
			if (!((keyCode>=48 && keyCode<=57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 46 ) && keyCode != 8 && keyCode != 32) {
				return false;
			}
		});

		$('#alamat_asal').keypress(function(event) {
			var keyCode = event.which;
			if (!((keyCode>=48 && keyCode<=57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 46 ) && keyCode != 8 && keyCode != 32) {
				return false;
			}
		});
	});
</script>
	
@endsection