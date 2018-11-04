@extends ('layouts.lihatLaporan')

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

@section('kembali')
	/admin/{{$us->id}}/laporan
@endsection

@section('ubah')
	/admin/{{$us->id}}/laporan/{{$laporan->id}}/ubah
@endsection

@section('hapus-laporan')
	/admin/{{$us->id}}/laporan/{{$laporan->id}}/delete
@endsection

@section('show-btn')
	<script type="text/javascript">
		if ({{$laporan->id_penulis}} == {{$us->id}}) {
			$('#pilihan').show();
		} else {
			$('#pilihan').hide();
		}

		// $('#hapus').show();
	</script>
@endsection