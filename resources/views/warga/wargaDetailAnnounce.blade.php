@extends ('layouts.detailPengumuman')

@section('beranda') /warga/{{$us->id}} @endsection
@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
@section('Laporan') /warga/{{$us->id}}/laporan @endsection
@section('Statistika') /warga/{{$us->id}}/statistika @endsection

@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection

<!-- @section('beranda')
	/warga/{{$us->id}}
@endsection

@section('pengumuman')
	/warga/{{$us->id}}/pengumuman
@endsection

@section('profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

@section('nav1')
	/warga/{{$us->id}}/pengumuman
@endsection