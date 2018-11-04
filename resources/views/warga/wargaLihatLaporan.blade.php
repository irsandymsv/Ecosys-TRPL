@extends ('layouts.lihatLaporan')

@section('beranda') /warga/{{$us->id}} @endsection
@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
@section('Laporan') /warga/{{$us->id}}/laporan @endsection
@section('Statistika') /warga/{{$us->id}}/statistika @endsection

@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(255, 204, 0);"></span>Profil</a>
@endsection

@section('nav-laporan')
	/warga/{{$us->id}}/laporan
@endsection

@section('kembali')
	/warga/{{$us->id}}/laporan
@endsection

@section('ubah')
	/warga/{{$us->id}}/laporan/{{$laporan->id}}/ubah
@endsection

@section('hapus-laporan')
	/warga/{{$us->id}}/laporan/{{$laporan->id}}/delete
@endsection

@section('show-btn')
	<script type="text/javascript">
		if ({{$laporan->id_penulis}} == {{$us->id}}) {
			$('#pilihan').show();	
		} else {
			$('#pilihan').hide();
		}
	</script>
@endsection