@extends ('layouts.dash')

@section('meta')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('link ref')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('judul')
	Ecosys-Statistika
@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('gaya')
	.body{
		padding: 0px;
	}

	.nav{
		padding: 15px;
	}

	.atas{
		padding: 30px; 
		padding-top: 5px;
	}

	.wrapper{
		padding-right: 10px;
		padding-left: 10px;
	}

	#w2{
		width: 100%;
		margin-top: -30px;
		padding: 20px;
		<!-- background-color: white; -->
	}

	#pilihan{
		width: 100%;
		margin-top: 10px;
		padding: 10px;
		text-align: left;
	}

	.form-group.sel{
		margin-right: 15px;
	}

	.top{
		width: 100%;
		margin-top: 0px;
		padding: 20px;
		background-color: white;
	}

	.card12{
		width: 100%;
		margin-top: 10px;
		padding: 15px;
		background-color: white;
	}

	#lapAll{
		width: 30%;
		margin-left: auto;
		margin-right: auto;
		margin-top: 20px;;
		text-align: center;
		overflow: hidden;
		border: 2px solid #4CAF50;
		<!-- box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); -->

	}

	#text{
		float: left;
		width: 75%;
		background-color: #4CAF50;
		color: white;
		padding-bottom: 100%;
		margin-bottom: -100%;
	}

	#val{
		float: left;
		width: 25%;
		background-color: white;
		padding-bottom: 100%;
		margin-bottom: -100%;
	}

	.wadah{
		overflow: hidden;
		margin-top: 15px;
		margin-left: auto;
		margin-right: auto;
	}

	.chart{
		float: right;
		width: 55%;
		<!-- height: 30px; -->
		<!-- background-color: rgba(240, 240, 240, 0.7); -->

	}

	#myChart{
		width: 100%;
		height: 100%;
		font-size: 22px;
	}


	#jml_lap{
		float: left;
		width: 25%;
		height: 180px;
		margin-top: 25px;
		padding: 10px;
		margin-left: 100px;
		background-color: orange;
		font-size: 80px;
		text-align: center;
	}

	<!-- #lapNumb{
		width: 70%;
		overflow: hidden;
		padding: 5px;
		margin-left: auto;
		margin-right: auto;
		height: 120px;
		background-color: lightblue;
	} -->

	#lap{
		margin-top: 200px;
		width: 90%;
	}

	table{
		display: block;
		border: 1px solid grey;
		width:100%;
	}

	tbody{
		display: block;
		overflow-y: scroll;
		height: 150px;
	}

	th{
		width: 700px;
		background-color: grey; 
		color:white;
		font-size: 16px;
	}

	td{
		width:700px;
	}

	.lines{
		width: 80%;
		height: 380px;
		overflow: hidden;
		margin-left: auto;
		margin-right: auto;
	}

	#line{	
		width: 100%;
		height: 100%;
	}

	.statusLap{
		margin-top: 30px;
		overflow: hidden;
		width: 80%;
		height: 250px;
	}

	#hbar{
		width: 100%;
		height: 100%;
	}

@endsection

@if($us->id_role == 1)
	@section('beranda') /admin/{{$us->id}} @endsection
	@section('pengumuman') /admin/{{$us->id}}/pengumuman @endsection
	@section('Laporan') /admin/{{$us->id}}/laporan @endsection
	@section('Statistika') /admin/{{$us->id}}/statistika @endsection
	@section('data profil')
		<a href="/admin/{{$us->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
		255, 204, 0);"></span>Data Pengguna</a>
	@endsection

@elseif($us->id_role == 2)
	@section('beranda') /warga/{{$us->id}} @endsection
	@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
	@section('Laporan') /warga/{{$us->id}}/laporan @endsection
	@section('statistika') # @endsection
	@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a> 
	@endsection

@elseif($us->id_role == 3)
	@section('beranda') /perdes/{{$us->id}} @endsection
	@section('pengumuman') /perdes/{{$us->id}}/pengumuman @endsection
	@section('Laporan') /perdes/{{$us->id}}/laporan @endsection
	@section('Statistika') /perdes/{{$us->id}}/statistika @endsection
	@section('data profil')
		<a href="/perdes/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(255, 204, 0);"></span>Profil</a>
	@endsection

@elseif($us->id_role == 4)
	@section('beranda') /kades/{{$us->id}} @endsection
	@section('pengumuman') /kades/{{$us->id}}/pengumuman @endsection
	@section('Laporan') /kades/{{$us->id}}/laporan @endsection
	@section('statistika') # @endsection

	@section('data profil')
		<a href="/kades/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
		255, 204, 0);"></span>Profil</a>
	@endsection

@endif

@section('isi1')
	<div class="body">
		
		<div class="nav">
			<ol class="breadcrumb" style="background-color: white;">
				<li class="active">Statistika</li>
			</ol>	
		</div>

		<div class="wrapper">
			<div id="w2">

				<div class="top">

					<div id="lapAll">
						<div id="text">
							<h3>Total Laporan</h3>
						</div>
						<div id="val">
							<h3 style="font-size: 27px;" id="allCount"></h3>
						</div>
					</div>

					<div class="statusLap">
						<canvas id="hbar"></canvas>
					</div>
				</div>

				<div class="card12">
					<div class="lines">
						<canvas id="line"></canvas>
					</div>
				</div>

				<div class="card12">
					<div class="form-inline" id="pilihan">

						<!-- <div class="form-group sel">
							<label for="tag">Tag</label>
							<select class="form-control tg" id="tags">
								<option value="semua">Semua</option>
								@foreach($tagAll as $tag)
									<option value="$tag->nama">{{$tag->nama}}</option>
								@endforeach
							</select>
						</div> -->

						<div class="form-group sel">
							<label for="waktu">Pilih Waktu</label>
							<select class="form-control wk" id="waktu">
								<option value="week">Minggu ini</option>
								<option value="month">Bulan ini</option>
								<option value="year">Tahun ini</option>
							</select>
						</div>

						<!-- <div class="form-group sel">
							<label for="status">Pilih Status</label>
							<select class="form-control ch" id="status">
								<option value="semua">Semua</option>
								<option value="Belum ditangani">Belum ditangani</option>
								<option value="Sudah ditangani">Sudah ditangani</option>
							</select>
						</div> -->
					</div>
					
					<div class="wadah">
						<div id="jml_lap">
							<div style="font-size: 20px;">
								Total Laporan <br>
								<span id="waktuSelected">Minggu ini</span>
							</div>
							<span id="lapCount"></span>
							
						</div>

						<div class="chart">
							<canvas id="myChart"></canvas>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('/js/Chart.bundle.js')}}"></script>
<script type="text/javascript">
	var kes_week = {{count($kes_week)}} ;
	var pend_week = {{count($pend_week)}} ;
	var krim_week = {{count($krim_week)}} ;

	var kes_month = {{count($kes_month)}} ;
	var pend_month = {{count($pend_month)}} ;
	var krim_month = {{count($krim_month)}} ;

	var kes_year = {{count($kes_year)}} ;
	var pend_year = {{count($pend_year)}} ;
	var krim_year = {{count($krim_year)}} ;

	var lap_belum = {{count($lap_belum)}};
	var lap_sudah = {{count($lap_sudah)}};

	var kesAllYear = @json($kesAllYear) ;
	var pendAllYear = @json($pendAllYear);
	var krimAllYear = @json($krimAllYear);
	console.log(kesAllYear);

	$(window).on('load', function () {
		// alert(kesAllYear);
		counting({{count($laporanAll)}}, '#allCount');

		polar(kes_week, pend_week, krim_week);
		horiBar(lap_belum, lap_sudah);
		lineChart();

		var jml = {{count($lap_week)}};
		var kapan = $('#waktu option:selected').text();
		$('#waktuSelected').text(kapan);
		if (jml == 0) {
			$('#lapCount').text(jml);
		}else{
			counting(jml, '#lapCount');
		}

	});

	$('.form-control.wk').on('change', function(event) {
		event.preventDefault();
		var d = new Date();
		var jml=0;

		if ($(this).val() == "week") {
			$("#myChart").remove();
			$('.chart').append('<canvas id="myChart"></canvas>');
			polar(kes_week, pend_week, krim_week);

			jml = {{count($lap_week)}};
			$('#waktuSelected').text($("#waktu option:selected").text());
			if (jml == 0) {
				$('#lapCount').text(jml);
			}else{
				counting(jml, '#lapCount');
			}

		}
		else if($(this).val() == "month"){
			$("#myChart").remove();
			$('.chart').append('<canvas id="myChart"></canvas>');
			polar(kes_month, pend_month, krim_month);

			jml = {{count($lap_month)}};
			$('#waktuSelected').text($("#waktu option:selected").text());
			counting(jml, '#lapCount');
			if (jml == 0) {
				$('#lapCount').text(jml);
			}else{
				counting(jml, '#lapCount');
			}

		}
		else if($(this).val() == "year"){
			$("#myChart").remove();
			$('.chart').append('<canvas id="myChart"></canvas>');
			polar(kes_year, pend_year, krim_year);

			jml = {{count($lap_year)}};
			$('#waktuSelected').text($("#waktu option:selected").text());
			counting(jml, '#lapCount');
			if (jml == 0) {
				$('#lapCount').text(jml);
			}else{
				counting(jml, '#lapCount');
			}

		}

	});

	$('.form-control.tg').on('change', function(event) {
		event.preventDefault();
		var kapan="";
		if ($(this).val() == "semua" && $('#waktu').val() == "week") {
			
		}
		else if($(this).val() == "semua" && $('#waktu').val() == "month"){

		}
		else if($(this).val() == "semua" && $('#waktu').val() == "month"){

		}
	});

		function polar(dt1, dt2, dt3) {
		var ctx = $("#myChart");
		var polarChart = new Chart(ctx, {
		    type: 'polarArea',
		    data: {
		    	labels:["kesehatan", "Pendidikan", "Kriminalitas"],
		    	datasets: [{
		    		data: [dt1, dt2, dt3],
			    	backgroundColor:[
			    	"rgba(0, 172, 230, 0.7)", 
			    	"rgba(102, 255, 51, 0.7)", 
			    	"rgba(255, 0, 64, 0.7)"
			    	],
			    	borderColor: "rgb(255, 255, 255)",
			    	hoverBackgroundColor:[
			    	"rgba(0, 191, 255, 0.7)",
			    	"rgba(121, 255, 77, 0.7)", 
			    	"rgba(255, 26, 83, 0.7)"
			    	]
		    	}]
		    },
		    // options: options
		});
	}

	function horiBar(belum, sudah) {
		var bar = $("#hbar");
		var myBarChart = new Chart(bar, {
		    type: 'horizontalBar',
		    data: {
		      labels: ["Belum ditangani", "Sudah ditangani"],
		      datasets: [
		        {
		          label: "Total",
		          backgroundColor: ["#e64219", "#24a8a8"],
		          data: [belum, sudah],
		        }
		      ]
		    },
		    options: {
		    	scales: {
			        yAxes: [{
			        	barThickness: 1
			        }]
			    },
		    	legend: { display: false },
		    	title: {
		    		display: true,
        			text: 'Penglompokan data berdasar status'
		    	},
		      	scales: {
			    	xAxes: [{
			        	ticks: {
			          	min: 0
			        	}
			      	}],
			 	}
		    }
		    // options: options
		});
	}

	function counting(target, element) {
		var number = 0;
		if (number < target) {
			var interval = setInterval(function () {
				$(element).text(number);
				if (number >= target) {
					clearInterval(interval);
					return;
				}
				number++;

			}, 85);
		}
		
	}

	function lineChart() {
		var ln = $('#line');
		var myLineChart = new Chart(ln, {
		    type: 'line',
		    data: {
		    	labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
		    	datasets: [
		    		{
		    			data: [
			    			<?php
			    			foreach ($kesAllYear as $kes){
			    				echo count($kes).",";
			    			}
			    			?>
		    			],
		    			label: "Kesehatan",
		    			borderColor: "rgba(0, 220, 0, 0.7)",
		    			pointBackgroundColor: "rgba(0, 220, 0, 0.7)",
		    			pointBorderWidth: 5,
		    			fill: false
		    		},

		    		{
		    			data: [
			    			<?php
			    			foreach ($pendAllYear as $pend){
			    				echo count($pend).",";
			    			}
			    			?>
		    			],
		    			label: "Pendidikan",
		    			borderColor: "rgba(0, 0, 220, 0.7)",
		    			pointBackgroundColor: "rgba(0, 0, 220, 0.7)",
		    			pointBorderWidth: 5,
		    			fill: false
		    		},
		    		
		    		{
		    			data: [
		    				<?php
			    			foreach ($krimAllYear as $krim){
			    				echo count($krim).",";
			    			}
			    			?>
		    			],
		    			label: "Kriminalitas",
		    			borderColor: "rgba(220, 0, 0, 0.7)",
		    			pointBackgroundColor: "rgba(250, 0, 0, 0.7)",
		    			pointBorderWidth: 5,
		    			fill: false
		    		}
		    	]
		    },
		    options: {
		    	title: {
		    		display: true,
        			text: 'Grafis Laporan Tahun Ini'
		    	}
		    }
		});
	}

</script>

@endsection


