@extends ('layouts.dash')

@section('link ref')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('judul')
	Ecosys-Lihat Laporan
@endsection

@section('gaya')
	.nav{
		padding: 15px;
		<!-- padding-top: 0; -->
	}
	.row1{
		padding: 5px;
		margin-top: -15px;
	}

	.r1{
		float: left;
		width: 48%;
		overflow: hidden;
		background-color: white; 
		padding: 15px;
		margin-left: 10px;
		padding-bottom: 100%;
    	margin-bottom: -100%;
		<!-- min-height: 500px; -->

	}

	.r2{
		float: left;
		width: 48%;
		overflow: hidden;
		background-color: white; 
		padding: 15px;
		margin-left: 10px;
		padding-bottom: 100%;
    	margin-bottom: -100%;
		<!-- min-height: 500px; -->
	}

	#pilihan{
		margin-top: 30px;
		margin-bottom: 20px;
	}

	.image{
		margin: auto;
		width: 80%;
		min-height: 100px;
		<!-- border: 1px dashed navy; -->
	}

	.image img{
		height: 20%;
	}

	.multiTag{
		width: 40%;
	}

	.selectbox{
		position:relative;
	}

	.selectbox select{
		width: 100%;
	}

	.overselect {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
	}

	#pilihTags{
		width: 300px;
		display: none;
		border: 1px lightgrey solid ;
		border-radius: 5px;
	}

	#pilihTags label{
		display: inline-block;
		padding: 3px;
	}

	#pilihTags label:hover{
		background-color: lightgrey;
		cursor: pointer;
	}


	#pilihProf{
		width: 300px;
		display: none;
		border: 1px lightgrey solid ;
		border-radius: 5px;
	}

	#pilihProf label{
		display: inline-block;
		padding: 3px;
	}

	#pilihProf label:hover{
		background-color: lightgrey;
		cursor: pointer;
	}

	#map {
		width: 100%;
		height: 300px;
	}
@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('isi1')
<div class="nav">
	<ol class="breadcrumb" style="background-color: white;">
		<li><a href="@yield('nav-laporan')">Laporan</a></li>
		<li class="active">Lihat Laporan</li>
	</ol>	
</div>

<div class="row1">
	<div class="r1" id="card1">
		<!-- <h3 style="text-align: center;">Laporan</h3> -->

		<div class="form" style="margin-top: 15px;">
			<div class="form-group">
				<label for="">Judul Laporan</label>
				<input class="form-control" type="text" name="judul" id="judul" value="{{$laporan->judul}}" readonly>
			</div>

			<div class="form-group">
				<label for="">Isi Laporan</label>
				<textarea class="form-control" type="text" name="isi" id="isi" rows="5" readonly>{{$laporan->isi}}</textarea>
			</div>

			<div class="form-group">
				<label>Tanggal Dibuat</label>
				<input class="form-control" type="text" name="created_at" value="{{$laporan->created_at}}" readonly>
			</div>

			<div class="form-group">
				<label>Penulis</label>
				<input class="form-control" type="text" name="penulis" value="{{$penulis->nama}}" readonly>
			</div>

			<div class="form-group">
				<label>Gambar</label>
				<div class="image">
					<img src="{{asset('storage/'.$laporan->image_url) }}" id="preview" style="width: 100%;">  
				</div>
			</div>
		</div>			
	</div>

	<div class="r2" id="card2">
		<div class="form" style="margin-top: 15px;">
			<div class="form-group">
				<label for="tagSelect">Tags</label>
				<div class="multiTag">
					<?php foreach ($tag as $key): ?>
						<li>{{$key->nama}}</li>
					<?php endforeach ?>
				</div>
			</div>

			<div class="form-group">
				<label>Profesi</label>
				<div class="multiTag">
					<?php foreach ($prof as $key): ?>
						<li>{{$key->nama_profesi}}</li>
					<?php endforeach ?>
				</div>
			</div>

			<div class="form-group">
				<label>Tanggal Diubah</label>
				@if($laporan->updated_at != $laporan->created_at)
					<input class="form-control" type="text" name="updated_at" value="{{$laporan->updated_at}}" readonly>
				@else
					<input class="form-control" type="text" name="updated_at" value="-" readonly>
				@endif
			</div>

			<div class="form-group">
				<label>Pengubah</label>
				@if($laporan->id_pengubah != null)
					<input class="form-control" type="text" name="penulis" value="{{$pengubah->nama}}" readonly>
				@else
					<input class="form-control" type="text" name="penulis" value="-" readonly>
				@endif
				
			</div>

			<label>Lokasi</label>
			<div id="map"></div>

			<form method="POST" action="@yield('hapus-laporan')">
				{{csrf_field()}}
				<div class="form-inline" style="text-align: right;">
					<div class="form-inline" id="pilihan">
						<a href="@yield('kembali')" class="btn btn-default" type="button">Kembali</a>

						<a href="@yield('ubah')" class="btn btn-warning" type="button" >Ubah</a>
					</div>

					<div id="hapus" style="margin-top: 20px;">
						<input type="hidden" name="_method" value="delete">
						<button class="btn btn-danger" id="hapus" type="button" type="button" data-toggle="modal" data-target="#myModal">Hapus</button>
					</div>
				</div>
				<div id="myModal" class="modal fade" role="dialog">
					  	<div class="modal-dialog">
					    	<!-- Modal content-->
						    <div class="modal-content">

						    	<div class="modal-header" style="background-color: rgb(255, 77, 77)">
						        	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        	<h4 class="modal-title" style="color: white;">Konfirmasi Penghapusan</h4>
						    	</div>

						    	<div class="modal-body">
						        	<p>Apakah anda ingin menghapus laporan ini?</p>
						    	</div>

						    	<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
						        	<button class="btn btn-danger" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
						    	</div>
						    </div>
					  	</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('script')

	<script type="text/javascript">
		if ("{{$role->nama_role}}" == "admin") {
			$('#hapus').show();
		} else {
			$('#hapus').hide();
		}
	</script>

	<script type="text/javascript">
		if ("{{$laporan->koordinat}}" != "") {
			var koordinat = [<?php echo $laporan->koordinat ?>];
		} else {
			var koordinat = [0,0];
		}

		mapboxgl.accessToken = 'pk.eyJ1IjoiaXJzYW5keSIsImEiOiJjam5lNnZ3bTUxMW95M3FwOHBlZ2F3dThhIn0.9HAWtGG9lWMFzNVcAjWolg';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v10?optimize=true',
			center: koordinat,
			zoom: 13
		});

		map.addControl(new mapboxgl.NavigationControl());

		var coordinates = document.getElementById('coordinates');
		var marker = new mapboxgl.Marker({
			draggable: false,
			color: "#ff1a1a"
		})
			.setLngLat(koordinat)
			.addTo(map);

	</script>

	@yield('show-btn');

	<script type="text/javascript">

		// if ({{$laporan->id_penulis}} == {{$us->id}}) {
		// 	$('#pilihan').show();	
		// } else {
		// 	$('#pilihan').hide();
		// }

		if ("{{$laporan->image_url}}" == "") {
			$('#preview').attr('src', "{{asset('image/photo.gif')}}");
		}

	</script>
@endsection