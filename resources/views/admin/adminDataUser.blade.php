@extends ('layouts.dash')

@section('judul')
	Ecosys-Data Pengguna
@endsection

@section('gaya')

	<!-- .buttAdm{
		margin-top: 150px;
	} -->

	.buatBaru{
		margin-top: 240px;
	}

	.btn.btn-success.btn-lg{
		color: black;
	}

	.nav{
		padding: 15px;
		padding-top: 0;
	}
	
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
	<div class="nav">
		<p style="font-size: 14px;"><h3 style="text-align: left;">Data Pengguna</h3></p>	
	</div>
	
	<br><br><br><br>

	<div class="row" style="text-align: center;">
		<div class="col-md-6">
			<a href="/admin/{{$ad->id}}/data/perdes" class="btn btn-success btn-lg" style="padding: 40px 60px;">Perangkat Desa</a>		
		</div>

		<div class="col-md-6">
			<a href="/admin/{{$ad->id}}/data/warga" class="btn btn-success btn-lg" style="padding: 40px 60px;">Warga Desa</a>
		</div>

		<div class="col-md-12">
			<a href="/admin/{{$ad->id}}/data/admin" class="btn btn-success btn-lg" style="padding: 40px 60px;">Admin</a>
		</div>

		<!-- <br><br><br><br><br> -->
		<div class="buatBaru">
			<a href="/admin/{{$ad->id}}/data/baru" class="btn btn-warning btn-lg baru" style="padding: 10px 15px;">Buat Data <br> Pengguna Baru</a>
		</div>
		
		
	</div>
	<!-- <a href=""></a> -->
@endsection