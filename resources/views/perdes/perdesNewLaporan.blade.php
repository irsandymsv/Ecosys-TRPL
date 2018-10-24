@extends ('layouts.buatLaporan')

@section('beranda') /perdes/{{$us->id}} @endsection
@section('pengumuman') /perdes/{{$us->id}}/pengumuman @endsection
@section('Laporan') /perdes/{{$us->id}}/laporan @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/perdes/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection

@section('nav-laporan')
	/perdes/{{$us->id}}/laporan
@endsection

@section('create')
	/perdes/{{$us->id}}/laporan/baru
@endsection

@section('batal')
	/perdes/{{$us->id}}/laporan
@endsection