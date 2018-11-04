@extends ('layouts.profil')

@section('beranda') /warga/{{$us->id}} @endsection
@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
@section('Laporan') /warga/{{$us->id}}/laporan @endsection
@section('Statistika') /warga/{{$us->id}}/statistika @endsection

@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection

<!-- @section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="/warga/{{$us->id}}" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->