@extends ('layouts.detailPengumuman')

@section('beranda') /admin/{{$us->id}} @endsection
@section('pengumuman') /admin/{{$us->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/admin/{{$us->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection

<!-- @section('beranda')
	/admin/{{$us->id}}
@endsection

@section('pengumuman')
	/admin/{{$us->id}}/pengumuman
@endsection

@section('profil')
	<a href="/admin/{{$us->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection -->

@section('nav1')
	/admin/{{$us->id}}/pengumuman
@endsection
