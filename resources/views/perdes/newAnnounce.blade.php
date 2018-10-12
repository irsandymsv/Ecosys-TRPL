@extends ('layouts.perdes')

@section('judul')
	Ecosys-Buat Pengumuman
@endsection

@section('gaya')

	.nav{
		padding: 15px;
		<!-- padding-top: 0; -->
	}

	.row1{
		padding: 5px;
		margin-top: -20px;
	}

	.r1{
		background-color: white; 
		<!-- float: left; -->
		<!-- width: 40%; -->
		
		padding: 15px;
		margin-left: 10px;
		min-height: 500px;

	}

	.r2{
		float: left;
		width: 48%;
		background-color: white; 
		padding: 15px;
		margin-left: 10px;
		min-height: 500px;
	}

	.form-inline{
		position: absolute;
		bottom: 30px;
		right: 60px;
	}

	.form-control{
		<!-- width: 80%; -->

	}

	.form{
		padding: 20px;
	}

	.alert.alert-danger{
		width: 30%;
	}

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('beranda') /perdes/{{$us->id}} @endsection
@section('pengumuman') /perdes/{{$us->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/perdes/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

@section('isi1')
<div class="nav">
	<ol class="breadcrumb" style="background-color: white;">
		<li><a href="/perdes/{{$us->id}}/pengumuman">Pengumuman</a></li>
		<li class="active">Buat baru</li>
	</ol>	
</div>

<div class="row1">
	<form method="post" action="/perdes/{{$us->id}}/pengumuman/baru">
		{{csrf_field()}}
		<div class="r1">
			
			<div class="form" style="margin-top: 0px;">
				<h3 style="text-align: center;">Buat Pengumuman Baru</h3>
				<div class="form-group">
					<label for="">Judul Pengumuman</label>
					<input class="form-control" type="text" name="judul" id="judul">
					<?php if ($errors->has('judul')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('judul') }}
						</div>
					<?php endif ?>
				</div>

				<div class="form-group">
					<label for="">Isi Pengumuman</label>
					<textarea class="form-control" type="text" name="isi" id="isi" rows="11"></textarea>
					<?php if ($errors->has('isi')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('isi') }}
						</div>
					<?php endif ?>
				</div>

				<input type="hidden" name="status" id="status" value="">
				<?php if ($errors->has('status')): ?>
					<div class="alert alert-danger" role="alert" style="padding: 2px;">
						{{$errors->first('status') }}
					</div>
				<?php endif ?>

				<div class="form-inline" style="text-align: right;">
					<a href="/perdes/{{$us->id}}/pengumuman" class="btn btn-default" type="button" style="margin-right: 10px; ">Batal</a>

					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalA" onclick="simpan()" >Simpan</button>

					<!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalB" onclick="sebarkan()">Publikasi</button> -->
				</div>

				<div id="modalA" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Konfirmasi</h4>
							</div>

							<div class="modal-body">
								<p>Apakah anda ingin menyimpan pengumuman?</p>
							</div>

							<div class="modal-footer">
								<button type="button" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
								
								<button class="btn btn-success" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
							</div>
						</div>

					</div>
				</div>

			</div>			
		</div>

		<!-- <div class="r2">

			<div class="form-group">
				<label>Ini Label</label>
				<input class="form-control" type="text" name="" id="">
			</div>

			<div class="form-inline" style="text-align: right;">
				<a href="/perdes/{{$us->id}}/pengumuman" class="btn btn-default" type="button" style="margin-right: 10px; ">Batal</a>

				<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalA" onclick="simpan()" >Simpan</button>

				<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalB" onclick="sebarkan()">Publikasi</button>
			</div>

			<div id="modalA" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Konfirmasi</h4>
						</div>

						<div class="modal-body">
							<p>Apakah anda ingin menyimpan pengumuman?</p>
						</div>

						<div class="modal-footer">
							<button type="button" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
							
							<button class="btn btn-success" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
						</div>
					</div>

				</div>
			</div>
		</div> -->

	</form>
</div>

@endsection

			@section('script')
	<script type="text/javascript">
		function simpan () {
			document.getElementById("status").value="disimpan";
		}

		// function sebarkan () {
		// 	document.getElementById("status").value="dipublikasi";
		// }

		// function created () {
		// 	var d = new Date();
		// 	document.getElementById("created").value = d;
		// }
	</script>
	@endsection