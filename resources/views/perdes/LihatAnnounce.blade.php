@extends ('layouts.perdes')

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

	.form2{
		padding-top: 10px;
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

<!-- @section('beranda') /perdes/{{$us->id}} @endsection
@section('pengumuman') /perdes/{{$us->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/perdes/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

@section('isi1')
	<div class="badan">
		<div class="nav">
			<ol class="breadcrumb" style="background-color: white;">
				<li><a href="/perdes/{{$us->id}}/pengumuman">Pengumuman</a></li>
				<li class="active">Lihat Pengumuman</li>
			</ol>	
		</div>

		<form method="post" action="/perdes/{{$us->id}}/pengumuman/{{$ann->id}}/status">
			{{csrf_field()}}
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
						<?php if ($errors->has('judul')): ?>
							<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('judul') }}
							</div>
						<?php endif ?>
					</div>

					<div class="form-group">
						<label for="">Isi Pengumuman</label>
						<textarea class="form-control" type="text" name="isi" id="isi" rows="13" readonly>{{$ann->isi}}</textarea>
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

					<!-- <input type="hidden" id="dibuat" name="dibuat" value=""> -->

				</div>			
			</div>

			<div class="r2">
				<div class="form2">
					<div class="form-group">
						<label for="created_at" >Tanggal Dibuat</label>
						<input class="form-control" type="text" name="created_at" id="" value="{{$ann->created_at}}" readonly>
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

					<div class="form-inline" id="tombol">

						<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modalB" id="publish" style="margin-right: 10px;" onclick="sebarkan()">Publikasi</button>

						<button type="button" class="btn btn-danger" id="batal" data-toggle="modal" data-target="#modalA" style="margin-right: 10px;" onclick="batalkan()">Batalkan Publikasi</button>

						<a href="/perdes/{{$us->id}}/pengumuman/{{$ann->id}}/ubah" class="btn btn-success" id="butt2" style="padding: 5px 10px;">Ubah</a>
					</div>
				</div>
			</div>

			<!-- <div style="height: 2px; background-color: lightgrey;"></div> -->
			

			<div id="modalB" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Konfirmasi</h4>
						</div>

						<div class="modal-body">
							<p>Apakah anda yakin ingin sebarkan pengumuman?</p>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" >Tidak</button>
							
							<button class="btn btn-warning" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
						</div>
					</div>

				</div>
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
							<p>Apakah anda yakin ingin menarik kembali pengumuman?</p>
						</div>

						<div class="modal-footer">
							<button type="button" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>

							<button class="btn btn-danger" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
						</div>
					</div>

				</div>
			</div>

			<input type="hidden" name="_method" value="PUT">
		</form>
	</div>

@endsection

@section('script')
	<script type="text/javascript">

		function batalkan() {
			document.getElementById("status").value="disimpan";
		}

		function sebarkan() {
			document.getElementById("status").value="dipublikasi";
		}

		$(document).ready(function cekUser() {
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
		});
		

	</script>
@endsection
