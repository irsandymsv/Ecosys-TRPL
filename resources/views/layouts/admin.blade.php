@extends ('layouts.dash')

@section('beranda') /admin/{{$ad->id}} @endsection
@section('pengumuman') /admin/{{$ad->id}}/pengumuman @endsection
@section('Laporan') /admin/{{$ad->id}}/laporan @endsection
@section('Statistika') /admin/{{$ad->id}}/statistika @endsection

@section('data profil')
	<a href="/admin/{{$ad->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection