@extends ('layouts.dash')

@section('judul')
	Ecosys-Detail Data Pengguna
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
		padding-top: 0;
	}

	.row1{
		padding: 10px;
		<!-- text-align: center; -->
	}

	.r1{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		min-height: 575px;
	}

	.r2{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		min-height: 575px;

	}

<!-- 	.btn.btn-default.db{
		background-color: rgb(200,200,200);
		margin-right: 5px;
	}

	.btn.btn-default.db:hover{
		background-color: rgb(180,180,180);
	} -->
@endsection

@section('nama-user')
	{{$ad->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="/admin/{{$ad->id}}" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	<a href="/admin/{{$ad->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
	
@endsection

@section('isi1')
<div class="row1">
		<form method="POST" action="/admin/{{$ad->id}}/data/perdes/{{$us->id}}">
			{{csrf_field()}}

			<div class="r1">
				<div>
					<h3 style="text-align: center; margin-top: 0px; margin-bottom: 15px;">Profil Data Pengguna</h3>
				</div>
				<!-- <br> -->
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input class="form-control" type="text" name="nama" id="nama" value="{{$us->nama}}" readonly>
					
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input class="form-control" type="text" name="nik" id="nik" value="{{$us->nik}}" readonly>
					
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="{{$us->tempat_lahir}}" readonly>

						</div>

						<div class="col-xs-6">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{$us->tanggal_lahir}}" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="gender">Jenis Kelamin</label><br>
						<label class="radio-inline">
							<input type="radio" name="jenis_kelamin" value="Laki-laki" id="gender" disabled <?php if($us->jenis_kelamin == 'Laki-laki'){echo 'checked';} ?> >Laki-laki
						</label>

						<label class="radio-inline">
							<input type="radio" name="jenis_kelamin" value="Laki-laki" " id="gender" disabled <?php if($us->jenis_kelamin == 'Perempuan'){echo 'checked';} ?> >Perempuan
						</label>
					
				</div>

				<div class="form-group">
					<label for="profesi_id">Profesi</label>
					<select class="form-control" name="profesi_id" id="profesi_id" disabled>
						<option value="">---Pilih Profesi---</option>
						<?php foreach ($profs as $prof): ?>
							<option value="{{$prof->id_prof}}" 
								<?php if($us->profesi_id == $prof->id_prof) echo 'selected'; ?> 
								>{{$prof->nama_profesi}}</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<label for="no_hp">No. HP</label>
					<input class="form-control" type="text" name="no_hp" id="no_hp" value="{{$us->no_hp}}" readonly>
					<?php if ($errors->has('no_hp')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('no_hp') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="alamat_tinggal">Alamat Tinggal</label>
					<input class="form-control" type="text" name="alamat_tinggal" id="alamat_tinggal" value="{{$us->alamat_tinggal}}" readonly>
					<?php if ($errors->has('alamat_tinggal')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('alamat_tinggal') }}
						</div>
					<?php endif ?>
				</div>

			</div>

			<div class="r2">
				<div style="margin-bottom: 40px;">
					<h3 ></h3>
				</div>

				<div class="form-group">
					<label for="alamat_asal">Alamat Asal</label>
					<input class="form-control" type="text" name="alamat_asal" id="alamat_asal" value="{{$us->alamat_asal}}" readonly>
				</div>

				<div class="form-group">
					<label for="prov">Provinsi</label>
					<select id="prov" class="form-control" name="id_prov_asal" disabled>
						<option value="">---Pilih Provinsi Asal---</option>
						<?php foreach ($provinsis as $prov): ?>
							<option value="{{$prov->id}}"
								<?php if($us->id_prov_asal == $prov->id) echo 'selected'; ?> 
								>{{$prov->name}}</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<label for="kabupaten">Kota</label>
					<select id="kabupaten" class="form-control" name="id_kab_asal" disabled>
						<option value="">---Pilih Kota Asal---</option>
						<?php foreach ($kabs as $kab): ?>
							<option value="{{$kab->id}}"
								<?php if($us->id_kab_asal == $kab->id) echo 'selected'; ?> 
								>{{$kab->name}}</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" value="{{$us->email}}" readonly>
					<?php if ($errors->has('email')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('email') }}
						</div>
					<?php endif ?>
				</div>

				<!-- <div class="form-group">
					<label for="password">Password</label>
					 <input type="password" class="form-control" name="password" id="password" value = "" readonly>
				</div> -->

				<div class="form-group">
					<label for="id_role">Role</label>
					<select name="id_role" class="form-control" disabled>
						<option value="">---Pilih Role---</option>
						<?php foreach ($roles as $peran): ?>
							<option value="{{$peran->id}}"
								<?php if($us->id_role == $peran->id) echo 'selected'; ?> 
								>{{$peran->nama_role}}</option>
						<?php endforeach ?>
					</select>
				</div>
				<br>

				<div class="form-inline" style="text-align: right;">
					<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal">Hapus</button>

					<a href="/admin/{{$ad->id}}/data/edit/{{$us->id}}" class="btn btn-default" role="button">Ubah Data</a>

					<a href="/admin/{{$ad->id}}/data/edit/password/{{$us->id}}" class="btn btn-warning" role="button">Ubah Password</a>
				</div>

			</div>

			<div id="myModal" class="modal fade" role="dialog">
			  	<div class="modal-dialog">
			    	<!-- Modal content-->
				    <div class="modal-content">

				      <div class="modal-header" style="background-color: rgb(255, 77, 77)">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="color: white;">Konfirmasi Penghapusan</h4>
				      </div>

				      <div class="modal-body">
				        <p>Apakah anda ingin Menghapus data?</p>
				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				        <button class="btn btn-danger" type="submit" name="submit">Hapus</button>
				      </div>
				    </div>

			  	</div>
			</div>

			<input type="hidden" name="_method" value="DELETE">
		</form>

	</div>

@endsection

