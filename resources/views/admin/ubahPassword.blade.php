@extends ('layouts.admin')

@section('judul')
	Ecosys-Ubah Password Pengguna
@endsection

@section('gaya')

	<!-- .buatBaru{
		margin-top: 240px;
	} -->

	.prime{
		padding: 15px;
		<!-- text-align: center; -->
	}

	.nama{
		background-color: white;
		padding: 2px 15px;
		width: 100%;
	}

	.badan{
		background-color: white;
		margin: auto;
		margin-top: 40px;
		padding: 40px;
		padding-top:30px;
		min-height: 350px;
		width: 60%;
	}

	.btn.btn-default.db{
		margin-right: 15px;
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
	<div class="prime">
		<div class="nama">
			<h3>Nama Pengguna: {{$user->nama}}</h3>
		</div>

		<form method="post" action="/admin/{{$ad->id}}/data/update/password/{{$user->id}}">
			<div class="badan">
			<h3 style="text-align: center;">Ubah Password</h3>
				{{csrf_field()}}

				<div class="form-group" style="padding-top: 40px; text-align: left;">
					<label for="password" >Masukkan password baru</label>
					<div class="input-group">
						<input type="password" class="form-control input-lg" name="password" id="password">
						<div class="input-group-addon">
							<button type="button" onmousedown="showPass()" onmouseup="hidePass()"><span class="glyphicon glyphicon-eye-open"></span>
							</button>
						</div>
					</div>

						<?php if ($errors->has('password')): ?>
							<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('password') }}
							</div>
						<?php endif ?>
				</div>

				<div class="form-inline" style="text-align: center; padding-top: 30px;">
					<a href="/admin/{{$ad->id}}/data/edit/{{$user->id}}" class="btn btn-default db" role="button">Batal</a>
					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Simpan</button>
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
					        <p>Apakah anda ingin mengubah password?</p>
					      </div>

					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					        <button class="btn btn-success" type="submit" name="submit">Simpan</button>
					      </div>
					    </div>

				  	</div>
				</div>

				<input type="hidden" name="_method" value="PUT">
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
	
@endsection