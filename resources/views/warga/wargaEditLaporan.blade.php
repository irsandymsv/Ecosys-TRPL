@extends ('layouts.editLaporan')

@section('beranda') /warga/{{$us->id}} @endsection
@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
@section('Laporan') /warga/{{$us->id}}/laporan @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(255, 204, 0);"></span>Profil</a>
@endsection

@section('nav-laporan')
	/warga/{{$us->id}}/laporan
@endsection

@section('nav-lihat')
	/warga/{{$us->id}}/laporan/{{$laporan->id}}
@endsection

@section('edit')
	/warga/{{$us->id}}/laporan/{{$laporan->id}}/update
@endsection

@section('batal')
	/warga/{{$us->id}}/laporan/{{$laporan->id}}
@endsection