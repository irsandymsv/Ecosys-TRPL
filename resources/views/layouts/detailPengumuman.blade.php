@extends ('layouts.dash')

@section('judul')
	Ecosys-Lihat Pengumuman
@endsection

@section('gaya')
	.badan{
		padding: 10px;
	}

	.nav{
		padding:10px;
	}

	.isi{
		padding: 20px;
		background-color: white;
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
		right: 50px;
	}

	<!-- .form-inline{
		text-align: right;
		padding: 15px;
		padding-right: 20px;
		
	} -->

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="@yield('beranda')" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="@yield('pengumuman')" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	@yield('profil')	
@endsection -->

@section('isi1')
	<div class="badan">
		<div class="nav">
			<ol class="breadcrumb" style="background-color: white;">
			  	<li><a href="@yield('nav1')">Pengumuman</a></li>
			  	<li class="active">Lihat Pengumuman</li>
			</ol>	
		</div>
			<!-- <div class="isi">
				<h3>{{$ann->judul}}</h3>
				{{$ann->published_at}}

				<div style="height: 5px; background-color: black;"></div>
				<br>
				<p style="font-size: 16px;">
					{{$ann->isi}}
				</p>

				<br><br>

				<p>
					<i>Ditulis oleh:
						<b>{{$ann->nama}}</b>
					<br>

					Terakhir diubah oleh:
						<?php if (is_null($ubah)): ?>
							-
						<?php else: ?>
							<b>{{$ubah}}</b>
							pada <b>{{$ann->updated_at}}</b>
						<?php endif ?>
						
					</i>
						
				</p>
				<input type="hidden" name="status" id="status" value="">
				<?php if ($errors->has('status')): ?>
					<div class="alert alert-danger" role="alert" style="padding: 2px;">
						{{$errors->first('status') }}
					</div>
				<?php endif ?>

			</div> -->

			<div class="r1">
			<div class="form" style="padding-top: 0px;">
				{{csrf_field()}}

				<h3 style="text-align: center;">Pengumuman</h3>

				<div class="form-group">
					<label for="">Judul Pengumuman</label>
					<input class="form-control" type="text" name="judul" id="judul" value="{{$ann->judul}}" readonly>
				</div>

				<div class="form-group">
					<label for="">Isi Pengumuman</label>
					<textarea class="form-control" type="text" name="isi" id="isi" rows="13" readonly>{{$ann->isi}}</textarea>
				</div>

				<input type="hidden" name="status" id="status" value="">
			</div>			
		</div>

		<div class="r2">

			<div class="form-group">
				<label for="created_at" >Tanggal Publikasi</label>
				<input class="form-control" type="text" name="created_at" id="" value="{{$ann->published_at}}" readonly>
			</div>

			<div class="form-group">
				<label for="penulis">Penulis</label>
				<input class="form-control" type="text" name="penulis" value="{{$ann->nama}}" readonly>
			</div>
			
			<div class="form-group">
				<label for="updated_at" >Tanggal Terakhir Diubah</label>
				<?php if ($ann->updated_at === $ann->created_at): ?>
					<input class="form-control" type="text" name="updated_at" id="" value="-" readonly>
				<?php else: ?>
					<input class="form-control" type="text" name="updated_at" id="" value="{{$ann->updated_at}}" readonly>
				<?php endif ?>
			</div>
			
			<div class="form-group">
				<label for="namaPengubah" >User Terakhir yang Mengubah</label>
				<?php if (is_null($ubah)): ?>
					<input class="form-control" type="text" name="namaPengubah" id="" value="-" readonly>
				<?php else: ?>
					<input class="form-control" type="text" name="namaPengubah" id="" value="{{$ubah}}" readonly>
				<?php endif ?>
			</div>
		</div>

			<!-- <div style="height: 2px; background-color: lightgrey;"></div> -->
	</div>

@endsection

@section('script')
	<!-- <script type="text/javascript">

		function batalkan() {
			document.getElementById("status").value="disimpan";
		}

		function sebarkan() {
			document.getElementById("status").value="dipublikasi";
		}

		if ({{$us->id}} != {{$ann->id_penulis}} ) {
			document.getElementById('tombol').style.display = "none";
		} else {
			if ("{{$ann->status}}" == "disimpan") {
				// alert("tes"); 
				document.getElementById('batal').style.display = "none";
				document.getElementById('publish').style.display = "initial";
			}	
			else if ("{{$ann->status}}" == "dipublikasi") {
				document.getElementById('batal').style.display = "initial";
				document.getElementById('publish').style.display = "none";
			}
		}

	</script> -->
@endsection
