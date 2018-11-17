@extends ('layouts.warga')

@section('meta')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('link ref')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('judul')
	Ecosys-Beranda
@endsection

@section('gaya')
	.img{
		padding: 0;
		height: 100%;
		width: 100%;
	}

	.atas{
		margin-top: 15px; 
		padding: 10px;
		text-align: center;
		background-color: White;
	}

	.mapWrapper{
		width: 100%;
		height: 450px;
		overflow: hidden;
		margin-top: 10px;
		padding: 20px;
		background-color: white;
		text-align: left;
	}

	#map{
		width: 100%;
		height: 90%;
		margin-top: 10px;
	}

	.marker{
		background-image: url({{asset('image/map-marker.png')}}) ;
		background-size: cover;
		width: 40px;
		height: 40px;
		cursor: pointer;
	}

	.pop{
		font-size: 14px;
	}
	

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('isi1')
	<!-- <img class="img" src="{{asset('image/village.jpg')}}"> -->

	<div class="atas">
		<h2>Visualisasi Lokasi Laporan Per Bulan</h2>
	</div>
	<div class="mapWrapper">
		<div class="form-inline" class="pilihan">
			<span><b>Pilih Bulan</b></span>
			<select class="form-control" id="pilihBln">
				<?php for ($i=0; $i < $thisMonth; $i++) { 
					if ($i+1 == $thisMonth) {
						echo '<option value="'.($i+1).'" selected>'.$namaBln[$i].'</option>';	
					}
					else{
						echo '<option value="'.($i+1).'">'.$namaBln[$i].'</option>';
					}
				} ?>
			</select>
			<span style="margin-left: 20px;"><b>Pilih Tag</b></span>
			<select class="form-control" id="pilihTag">
				<option value="Semua">Semua</option>	
				@foreach($tagAll as $tag)
					@if($tag->nama == "Kriminalitas")
						<option value="{{$tag->nama}}" selected>{{$tag->nama}}</option>	
					@else
						<option value="{{$tag->nama}}">{{$tag->nama}}</option>	
					@endif
					
				@endforeach
			</select>
		</div>
		<div id="map"></div>
	</div>
	
@endsection

@section('script')

	<script type="text/javascript">
		mapboxgl.accessToken = 'pk.eyJ1IjoiaXJzYW5keSIsImEiOiJjam5lNnZ3bTUxMW95M3FwOHBlZ2F3dThhIn0.9HAWtGG9lWMFzNVcAjWolg';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v10?optimize=true',
			center: [113.695938,-8.191985],
			zoom: 12
		});

		map.addControl(new mapboxgl.NavigationControl());

		makeMarker(<?php echo $lap_month ?>);

		jQuery(document).ready(function($) {
			$('#pilihBln,#pilihTag').change(function(event) {
				var bln = $('#pilihBln').val();
				var tag = $('#pilihTag').val();
				console.log('value pilihBln = '+bln);
				console.log('value pilihTag = '+tag);

				$.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	                }
	            });

				$.ajax({
					url: '/mapData',
					type: 'POST',
					dataType: 'json',
					data: {"bulan": bln,
							 "tag": tag , 
							 _token: '{{csrf_token()}}'
						},
				})
				.done(function(data) {
					console.log("success");
					console.log(data[0]);

					// makeMap(map);
					makeMarker(data);
					

				})
				.fail(function(request, status, error) {
					console.log("error");
					console.log(error.responseText);
				})
				.always(function() {
					console.log("complete");
				});
			
			});	
		});
		

		$(window).on('load',function() {
			event.preventDefault();
			
		});

		function makeMap(map) {
			map.remove();

			mapboxgl.accessToken = 'pk.eyJ1IjoiaXJzYW5keSIsImEiOiJjam5lNnZ3bTUxMW95M3FwOHBlZ2F3dThhIn0.9HAWtGG9lWMFzNVcAjWolg';
			var map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/streets-v10?optimize=true',
				center: [113.695938,-8.191985],
				zoom: 12
			});

			map.addControl(new mapboxgl.NavigationControl());

			return map;
		}

		function makeMarker(laporan) {

			$(".marker").remove();
			
			for (var i = 0; i < laporan.length; i++) {

				var koordinat = laporan[i].koordinat;
				console.log(koordinat);
				var latLng = koordinat.split(",");
				var lng = parseFloat(latLng[0]);
				var lat = parseFloat(latLng[1]);
				console.log(lat);

				if(laporan[i].status == "Belum ditangani"){
					var popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<p><a href="/warga/{{$us->id}}/laporan/'+laporan[i].id+'" class="pop">'+laporan[i].judul+'</a></p><p class="pop">'+laporan[i].created_at+'<br>'+laporan[i].status+'</p>');					
				}else if(laporan[i].status == "Sudah ditangani"){
					var popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<p class="pop">'+laporan[i].judul+'</p><p class="pop">'+laporan[i].created_at+'<br>'+laporan[i].status+'</p>');
				}

				// var popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<p><a href="/warga/{{$us->id}}/laporan/'+laporan[i].id+'" class="pop">'+laporan[i].judul+'</a></p> <p class="pop">'+laporan[i].created_at+'<br>'+laporan[i].status+'</p>');

				var el = document.createElement('div');
				el.classList.add('marker');
				// el.id = 'marker';
				

				var marker = new mapboxgl.Marker({
					element: el,
			    	draggable: false,
			    	color: "#ff1a1a"
				})
			    	.setLngLat([lng, lat])
			    	.setPopup(popup)
			    	.addTo(map);	
			}
			
		    return marker;
		}

	</script>

@endsection

