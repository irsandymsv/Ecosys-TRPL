@extends ('layouts.editLaporan')

@section('beranda') /kades/{{$us->id}} @endsection
@section('pengumuman') /kades/{{$us->id}}/pengumuman @endsection
@section('Laporan') /kades/{{$us->id}}/laporan @endsection
@section('Statistika') /kades/{{$us->id}}/statistika @endsection

@section('data profil')
	<a href="/kades/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection

@section('nav-laporan')
	/kades/{{$us->id}}/laporan
@endsection

@section('nav-lihat')
	/kades/{{$us->id}}/laporan/{{$laporan->id}}
@endsection

@section('edit')
	/kades/{{$us->id}}/laporan/{{$laporan->id}}/update
@endsection

@section('batal')
	/kades/{{$us->id}}/laporan/{{$laporan->id}}
@endsection