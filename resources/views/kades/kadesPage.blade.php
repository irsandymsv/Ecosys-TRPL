@extends ('layouts.kades')

@section('judul')
	Ecosys-Beranda
@endsection

@section('gaya')
	.img{
		padding: 0;
		height: 100%;
		width: 100%;
	}

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('beranda') /kades/{{$us->id}} @endsection
@section('pengumuman') /kades/{{$us->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/kades/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

<!-- @section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="/kades/{{$us->id}}" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="/kades/{{$us->id}}/pengumuman" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	<a href="/kades/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

@section('isi1')
	<img class="img" src="{{asset('image/village.jpg')}}">

	
@endsection



