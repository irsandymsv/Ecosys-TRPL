@extends ('layouts.dash')

@section('judul')
	Ecosys-Profil
@endsection

@section('gaya')

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
		min-height: 720px;
	}

	.r2{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		min-height: 720px;

	}

	.val{
		font-size: 18px;
	}
	
@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('isi1')
<div class="row1">
			<div class="r1">
				<div>
					<h3 style="text-align: center; margin-top: 0px; margin-bottom: 15px;">Profil</h3>
				</div>
				<!-- <br> -->
				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br>
					<!-- <input class="form-control" type="text" name="nama" id="nama" value="{{$us->nama}}" readonly> -->
					<p class="val">{{$us->nama}}</p>
					<hr>

				</div>
				<div class="form-group">
					<label for="nik">NIK</label><br>
					<!-- <input class="form-control" type="text" name="nik" id="nik" value="{{$us->nik}}" readonly> -->
					<p class="val">{{$us->nik}}</p>
					<hr>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<label for="tempat_lahir">Tempat Lahir</label><br>
							<!-- <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="{{$us->tempat_lahir}}" readonly> -->
							<p class="val">{{$us->tempat_lahir}}</p>

						</div>

						<div class="col-xs-6">
							<label for="tanggal_lahir">Tanggal Lahir</label><br>
							<!-- <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{$us->tanggal_lahir}}" readonly> -->
							<p class="val">{{$us->tanggal_lahir}}</p>
						</div>
					</div>
					<hr>
				</div>
				<div class="form-group">
					<label for="gender">Jenis Kelamin</label><br>
						<!-- <label class="radio-inline">
							<input type="radio" name="jenis_kelamin" value="Laki-laki" id="gender" disabled <?php if($us->jenis_kelamin == 'Laki-laki'){echo 'checked';} ?> >Laki-laki
						</label>

						<label class="radio-inline">
							<input type="radio" name="jenis_kelamin" value="Laki-laki" " id="gender" disabled <?php if($us->jenis_kelamin == 'Perempuan'){echo 'checked';} ?> >Perempuan
						</label> -->
					<p class="val">{{$us->jenis_kelamin}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="profesi_id">Profesi</label>
					<p class="val">{{$profs->nama_profesi}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="no_hp">No. HP</label>
					<!-- <input class="form-control" type="text" name="no_hp" id="no_hp" value="{{$us->no_hp}}" readonly> -->
					<p class="val">{{$us->no_hp}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="alamat_tinggal">Alamat Tinggal</label>
					<!-- <input class="form-control" type="text" name="alamat_tinggal" id="alamat_tinggal" value="{{$us->alamat_tinggal}}" readonly> -->
					<p class="val">{{$us->alamat_tinggal}}</p>
					<hr>
				</div>

			</div>

			<div class="r2">
				<div style="margin-bottom: 40px;">
					<h3 ></h3>
				</div>

				<div class="form-group">
					<label for="alamat_asal">Alamat Asal</label>
					<!-- <input class="form-control" type="text" name="alamat_asal" id="alamat_asal" value="{{$us->alamat_asal}}" readonly> -->
					<p class="val">{{$us->alamat_asal}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="prov">Provinsi</label>
					<p class="val">{{$provinsis->name}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="kabupaten">Kota</label>
					<p class="val">{{$kabs->name}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<!-- <input type="email" class="form-control" name="email" id="email" value="{{$us->email}}" readonly> -->
					<p class="val">{{$us->email}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					 <!-- <input type="text" class="form-control" name="username" id="password" value = "{{$us->username}}" readonly> -->
					 <p class="val">{{$us->username}}</p>
					<hr>
				</div>

				<!-- <div class="form-group">
					<label for="password">Password</label>
					 <input type="password" class="form-control" name="password" id="password" value = "" readonly>
				</div> -->

				<div class="form-group">
					<label for="id_role">Role</label>
					<p class="val">{{$roles->nama_role}}</p>
					<hr>
				</div>
				<br>

				<!-- <div class="form-inline" style="text-align: right;">
					<a href="/admin/{{$us->id}}/data/edit/{{$us->id}}" class="btn btn-default" role="button">Kembali</a>
				</div> -->

			</div>
	</div>

@endsection

