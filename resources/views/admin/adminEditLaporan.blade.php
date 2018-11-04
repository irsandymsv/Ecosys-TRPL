@extends ('layouts.editLaporan')

@section('beranda') /admin/{{$us->id}} @endsection
@section('pengumuman') /admin/{{$us->id}}/pengumuman @endsection
@section('Laporan') /admin/{{$us->id}}/laporan @endsection
@section('Statistika') /admin/{{$us->id}}/statistika @endsection

@section('data profil')
	<a href="/admin/{{$us->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection

@section('nav-laporan')
	/admin/{{$us->id}}/laporan
@endsection

@section('nav-lihat')
	/admin/{{$us->id}}/laporan/{{$laporan->id}}
@endsection

@section('edit')
	/admin/{{$us->id}}/laporan/{{$laporan->id}}/update
@endsection

@section('batal')
	/admin/{{$us->id}}/laporan/{{$laporan->id}}
@endsection