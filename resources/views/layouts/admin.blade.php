@extends ('layouts.dash')

@section('beranda') /admin/{{$ad->id}} @endsection
@section('pengumuman') /admin/{{$ad->id}}/pengumuman @endsection
@section('Laporan') /admin/{{$ad->id}}/laporan @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/admin/{{$ad->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection