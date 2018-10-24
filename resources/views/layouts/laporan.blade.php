@extends ('layouts.dash')

@section('judul')
	Ecosys-Laporan
@endsection

@section('gaya')
	.body{
		padding: 10px;
	}

	.nav{
		padding: 15px;
		<!-- padding-top: 0; -->
	}

	.atas{
		padding: 30px; 
		padding-top: 5px;
		<!-- display: inline-block; -->
	}

	.cari{
		float: left;
	}

	.add{
		float: right;
	}

	.table-responsive {
		padding: 15px;
		padding-top: 20px;
		width: 100%;
		margin: auto;
	}

	.table.table-hover.table-bordered {
		background-color:white;
		font-size: 17px;
	}

	table th{
		background-color: rgb(90,90,90);
		color: white;
		text-align: center;
	}

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('isi1')
	<div class="body">
		
		<div class="nav">
			<ol class="breadcrumb" style="background-color: white;">
				<li class="active">Laporan</li>
			</ol>	
		</div>

		<div class="atas" style="padding-bottom: 10px;">
			<form class="form-inline" method="POST" action="#">
				{{csrf_field()}}
				<div class="cari">
					<input class="form-control" name="cari" type="text" id="myInput" placeholder="Pencarian...">
					<!-- <button class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-search"></span></button> -->
				</div>
			</form>
		
			<div class="add">
				<a href="@yield('laporan_baru')" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>	Buat Laporan</a>
			</div>
		</div>

		@yield('tbody')
		
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#body-tab tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

	<script type="text/javascript">

		$('button[name="selesai"]').click(function() {
			$('.status').val("Sudah ditangani");
		});

		$('button[name="batal"]').click(function() {
			$('.status').val("Belum ditangani");
		});

	</script>
@endsection