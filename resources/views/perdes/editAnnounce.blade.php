@extends ('layouts.perdes')

@section('judul')
	Ecosys-Ubah Pengumuman
@endsection

@section('gaya')

	.nav{
		padding: 15px;
		<!-- padding-top: 0; -->
	}

	.row1{
		padding: 5px;
		margin-top: -15px;
	}

	.r1{
		float: left;
		width: 48%;
		background-color: white; 
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

<!-- @section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="/perdes/{{$us->id}}" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="/perdes/{{$us->id}}/pengumuman" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

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
		<form method="post" action="/perdes/{{$us->id}}/pengumuman/{{$ann->id}}/update">
			{{csrf_field()}}
			<div class="r1">
				<h3 style="text-align: center;">Ubah Pengumuman Baru</h3>

				<div class="form" style="margin-top: 25px;">
						<!-- {{csrf_field()}} -->
					<div class="form-group">
							<label for="">Judul Pengumuman</label>
							<input class="form-control" type="text" name="judul" id="judul" value="{{$ann->judul}}">
					</div>
					<?php if ($errors->has('judul')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('judul') }}
						</div>
					<?php endif ?>

					<div class="form-group">
							<label for="">Isi Pengumuman</label>
							<textarea class="form-control" type="text" name="isi" id="isi" rows="8">{{$ann->isi}}</textarea>
					</div>
					<?php if ($errors->has('isi')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('isi') }}
						</div>
					<?php endif ?>

					<input type="hidden" name="status" id="status" value="{{$ann->status}}">
						<!-- <input type="hidden" name="updated" value=""> -->
				</div>			
			</div>

			<div class="r2">

				<div class="form-group">
					<label>Tanggal Dibuat</label>
					<input class="form-control" type="text" name="created_at" id="" value="{{$ann->created_at}}" readonly="">
				</div>

				<div class="form-inline" style="text-align: right;">
					<a href="/perdes/{{$us->id}}/pengumuman/{{$ann->id}}" class="btn btn-default" type="button" style="margin-right: 10px;">Batal</a>

					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalA">Simpan</button>

					<!-- <button class="btn btn-success" type="button" id="publish" data-toggle="modal" data-target="#modalB" onclick="sebarkan()">Publikasi</button> -->
				</div>

					<div id="modalA" class="modal fade" role="dialog">
						  	<div class="modal-dialog">

						    	<!-- Modal content-->
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

							        <button class="btn btn-primary" type="submit" name="submit" style="padding: 5px 20px;" onclick="updated()">Ya</button>
							      </div>
							    </div>

						  	</div>
					</div>

					<!-- <div id="modalB" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
							    <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Konfirmasi</h4>
							    </div>

							    <div class="modal-body">
							        <p>Apakah anda ingin sebarkan pengumuman?</p>
							    </div>

							    <div class="modal-footer">
							    	<button class="btn btn-success" type="submit" name="submit" style="padding: 5px 15px;" onclick="updated()">ya</button>

							    	<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
							    </div>
						    </div>
					  	</div>
					</div> -->
			</div>
			<input type="hidden" name="_method" value="PUT">
		</form>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		function simpan () {
			document.getElementById("status").value="disimpan";
		}

		function sebarkan () {
			document.getElementById("status").value="dipublikasi";
		}
		if ("{{$ann->status}}" == "dipublikasi") {
			// alert("tes");
			document.getElementById("publish").style.display="none";
		} 

		// function updated() {
		// 	var d = new Date();
		// 	document.getElementById("updated").value=d;
		// }
	</script>
@endsection