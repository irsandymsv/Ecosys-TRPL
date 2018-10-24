@extends ('layouts.admin')

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
	<!-- padding-top: 0; -->
	}

	.row1{
		padding: 10px;
		padding-top: 0px;
		<!-- text-align: center; -->
	}

	.r1{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		<!-- min-height: 580px; -->
	}

	.r2{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 15px;
		<!-- min-height: 640px; -->

	}

	.val{
		font-size: 18px;
	}

	<!-- .btn.btn-default.db{
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
			<li class="active">Profil Pengguna</li>
		</ol>	
	</div>

	<div class="row1">
		<form method="POST" action="/admin/{{$ad->id}}/data/perdes/{{$us->id}}">
			{{csrf_field()}}

			<div class="r1" id="card1">
				<div class="kepala">
					<h3 style="text-align: center; margin-top: 0px; margin-bottom: 15px;">Profil Pengguna</h3>
				</div>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<br>
					<p class="val">{{$us->nama}}</p>
					<hr>
					
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<br>
					<p class="val">{{$us->nik}}</p>
					<hr>
					
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<label for="tempat_lahir">Tempat Lahir</label>
							<br>
							<p class="val">{{$us->tempat_lahir}}</p>
						</div>

						<div class="col-xs-6">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<br>
							<p class="val">{{$us->tanggal_lahir}}</p>
						</div>
					</div><hr>
				</div>

				<div class="form-group">
					<label for="gender">Jenis Kelamin</label>
					<br>
					<p class="val">{{$us->jenis_kelamin}}
				</div>
				<hr>

				<div class="form-group">
					<label for="profesi_id">Profesi</label>
					<br>
					<p class="val">{{$profs->nama_profesi}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="no_hp">No HP</label>
					<br>
					<p class="val">{{$us->no_hp}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="alamat_tinggal">Alamat Tinggal</label>
					<br>
					<p class="val">{{$us->alamat_tinggal}}</p>
					<hr>
				</div>
			</div>

			<div class="r2" id="card2">
				<div style="margin-bottom: 40px;">
					<h3 ></h3>
				</div>

				<div class="form-group">
					<label for="alamat_asal">Alamat Asal</label>
					<br>
					<p class="val">{{$us->alamat_asal}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="prov">Provinsi</label>
					<br>
					<p class="val">{{$provinsis->name}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="kabupaten">Kota</label>
					<br>
					<p class="val">{{$kabs->name}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<br>
					<p class="val">{{$us->email}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label>Username</label>	
					<br>
					<p class="val">{{$us->username}}</p>
					<hr>
				</div>

				<div class="form-group">
					<label for="id_role">Role</label>
					<br>
					<p class="val">{{$roles->nama_role}}</p>
					<hr>
				</div>
				<br>

				<div class="form-inline" style="text-align: right;">
					<a href="/admin/{{$ad->id}}/data" class="btn btn-default db" type="button">Kembali</a>

					<!-- <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal">Hapus</button> -->

					<!-- <a href="/admin/{{$ad->id}}/data/edit/{{$us->id}}" class="btn btn-default" role="button">Ubah Data</a> -->

					<!-- <a href="/admin/{{$ad->id}}/data/edit/password/{{$us->id}}" class="btn btn-warning" role="button">Ubah Password</a> -->
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

@section('script')
	<script type="text/javascript">
		var r1 = $('#card1').height();
		var r2 = $('#card2').height();

		if (r1 > r2) {
			$('#card2').height(r1);
		} else {
			$('#card1').height(r2);
		}
	</script>
@endsection

