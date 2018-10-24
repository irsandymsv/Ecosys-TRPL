@extends ('layouts.dash')

@section('link ref')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('judul')
	Ecosys-Ubah Laporan
@endsection

@section('gaya')
	.nav{
		padding: 15px;
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

	#btn-submit{
		margin-top: 30px;
		margin-top: 20px;
	}

	input[type="file"]{
	    position: absolute;
	    width: 1px;
	    height: 1px;
	    padding: 0;
	    margin: -1px;
	    overflow: hidden;
	    clip: rect(0,0,0,0);
	    border: 0;
  	}

  	.uploadIcon{
	    margin-top: 20px;
	    border: 1px solid #ccc;
	    border-radius: 5px;
	    display: inline-block;
	    padding: 6px 12px;
	    cursor: pointer; 
  	}

  	.uploadIcon:hover{
    	background-color: lightgrey;
  	}

  	.image{
	    margin: auto;
	    width: 80%;
	    min-height: 100px;
	    border: 1px dashed navy;
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
		width: 300px;;
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

	.mapWrap{
		position: relative;
		width: 100%;
		background-color: grey;
	}

	#map {
	   width: 100%;
	   height: 300px;
	}

	.coordinates {
	    background: rgba(0,0,0,0.4);
	    color: #fff;
	    position: absolute;
	    top: 10px;
	    left: 10px;
	    padding:5px;
	    margin: 0;
	    font-size: 11px;
	    line-height: 18px;
	    border-radius: 3px;
	    display: none;
	    z-index: 1;
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
			<li><a href="@yield('nav-lihat')">Lihat Laporan</a></li>
			<li class="active">Ubah Laporan</li>
		</ol>	
	</div>

	<div class="row1">
		<form method="POST" action="@yield('edit')" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">
			<div class="r1">
				<h3 style="text-align: center;">Ubah Laporan</h3>

				<div class="form" style="margin-top: 25px;">
					<div class="form-group">
						<label for="">Judul Laporan</label>
						<input class="form-control" type="text" name="judul" id="judul" value="{{$laporan->judul}}">
					</div>
					<?php if ($errors->has('judul')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('judul')}}
						</div>
					<?php endif ?>

					<div class="form-group">
						<label for="">Isi Laporan</label>
						<textarea class="form-control" type="text" name="isi" id="isi" rows="5">{{$laporan->isi}}</textarea>
					</div>
					<?php if ($errors->has('isi')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 2px;">
							{{$errors->first('isi')}}
						</div>
					<?php endif ?>

					<div class="form-group">
						<label>Upload Gambar</label>
						<div class="image">
			              <img src="{{asset('storage/'.$laporan->image_url) }}" id="preview" style="width: 100%;">  
			            </div>
			        </div>
			        <div class="form-inline">
				        <label for="imgInp" class="uploadIcon"><span class="glyphicon glyphicon-cloud-upload"></span> Pilih Gambar</label>
				        <input type="file" name="img_file" accept="image/*" id="imgInp">

			            <button id="btnDel" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 	<b>Hapus gambar</b></button>
		            </div>
		            <input type="hidden" id="hapuskan" name="del" value="">
				</div>			
			</div>

			<div class="r2">

				<div class="form-group">
					<label for="tagSelect">Tags</label>
					<div class="multiTag">
						<div class="selectbox" id="tagBox">
							<button type="button" class="btn btn-default">-- Pilih Tags -- 		<span style="font-size: 10px;" class="glyphicon glyphicon-triangle-bottom"></span></button>
						</div>
						<div id="pilihTags">
					    	<?php foreach ($tagAll as $key): ?>
					    		<label>
					    			<input type="checkbox" name="tag[]" value="{{$key->id}}"
					    			<?php foreach ($tag as $tg): ?>
					    				<?php if($key->id == $tg->id) echo 'checked'; ?>
				    				<?php endforeach ?>
					    			>{{$key->nama}}
				    			</label>
					    	<?php endforeach ?>
					    </div>
					    <?php if ($errors->has('tag')): ?>
							<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('tag') }}
							</div>
						<?php endif ?>
					</div>
				</div>

				<div class="form-group">
					<label>Profesi</label>
					<div class="multiTag">
						<div class="selectbox" id="profBox">
							<button type="button" class="btn btn-default">-- Pilih profesi -- 		<span style="font-size: 10px;" class="glyphicon glyphicon-triangle-bottom"></span></button>
						</div>
						<div id="pilihProf">
					    	<?php foreach ($profAll as $key): ?>
					    		<label >
					    			<input type="checkbox" name="prof[]" value="{{$key->id_prof}}"
					    				<?php foreach ($prof as $pf): ?>
					    					<?php if($key->id_prof == $pf->id_prof) echo 'checked'; ?>
					    				<?php endforeach ?>
					    			>{{$key->nama_profesi}}
					    		</label>
					    	<?php endforeach ?>
					    </div>
					    <?php if ($errors->has('prof')): ?>
							<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('prof') }}
							</div>
						<?php endif ?>
					</div>
				</div>

				<div class="form-group">
					<label>Lokasi</label>
					<?php if ($errors->has('koordinat')): ?>
							<div class="alert alert-danger" role="alert" style="padding: 2px;">
								{{$errors->first('koordinat')}}
							</div>
					<?php endif ?>
					<div class="mapWrap">
						<div id="map"></div>
						<pre id='coordinates' class='coordinates'></pre>

						<input type="hidden" id="koordinat" name="koordinat" value="{{$laporan->koordinat}}">
					</div>
				</div>

				<div id="btn-submit" class="form-inline" style="text-align: right;">
					<a href="@yield('batal')" class="btn btn-default" type="button" style="margin-right: 10px;">Batal</a>

					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalA">kirim</button>
				</div>

				<div id="modalA" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Konfirmasi</h4>
							</div>

							<div class="modal-body">
								<p>Apakah anda ingin mengubah laporan?</p>
							</div>

							<div class="modal-footer">
								<button type="button" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>

								<button class="btn btn-primary" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		// $('#btnDel').hide();

		if ("{{$laporan->image_url}}" == "") {
			$('#preview').attr('src', "{{asset('image/photo.gif')}}");
			$('#btnDel').hide();
		}

		function readURL(input) {
		    if (input.files && input.files[0]) {
		    	var reader = new FileReader();

		        reader.onload = function(e) {
		        	$('#preview').show();
		        	$('#preview').attr('src', e.target.result);
		        	$('#btnDel').show();
	    			$('#hapuskan').val("");
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
	    }

	    $("#imgInp").change(function() {
	      readURL(this);
	    });	

	    $('#btnDel').click(function() {
	    	$('#imgInp').val("");
	    	$('#hapuskan').val("delete");
	        $('#preview').attr('src', "{{asset('image/photo.gif')}}");
	        $(this).hide();
	    });
	</script>

	<script type="text/javascript">
		var tag = false;

		$('#tagBox').click(function() {
			if (tag == false) {
				$('#pilihTags').css('display', 'block');
				tag = true;	
			} else {
				$('#pilihTags').css('display', 'none');
				tag = false;
			}
			
		});

		var prof = false;
		$('#profBox').click(function() {
			if (prof == false) {
				$('#pilihProf').css('display', 'block');
				prof = true;	
			} else {
				$('#pilihProf').css('display', 'none');
				prof = false;
			}
			
		});

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
		    draggable: true,
		    color: "#ff1a1a"
		})
		    .setLngLat(koordinat)
		    .addTo(map);

		function onDragEnd() {
		    var lngLat = marker.getLngLat();
		    coordinates.style.display = 'block';
		    coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
		    var point = [lngLat.lng, lngLat.lat];
		    $('#koordinat').val(point);
		}

		marker.on('dragend', onDragEnd);
	</script>
@endsection