@extends ('layouts.admin')

@section('judul')
	Ecosys-Beranda Admin
@endsection

@section('gaya')
	.img{
		padding: 0;
		height: 100%;
		width: 100%;
	}

@endsection

@section('nama-user')
	{{$ad->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('beranda') /admin/{{$ad->id}} @endsection
@section('pengumuman') /admin/{{$ad->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/admin/{{$ad->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
@endsection -->

@section('isi1')
	<img class="img" src="{{asset('image/village.jpg')}}">

	
@endsection



