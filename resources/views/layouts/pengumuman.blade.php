@extends ('layouts.dash')

@section('judul')
Ecosys-Pengumuman
@endsection

@section('gaya')
	.body{
		padding: 10px;
	}

	.atas{
		padding: 35px; 
		padding-top: 10px;
		<!-- display: inline-block; -->
	}

	.cari{
		float: left;
	}

	.add{
		float: right;
	}

	.row1{
		padding: 35px;
		margin-top: 20px;
		<!-- text-align: center; -->
	}

	.col-sm-6{
		<!-- background-color: lightgreen; -->
		<!-- padding: 5px; -->
		margin: auto;
		<!-- margin-right: 20px; -->
		<!-- margin-top: 5px; -->
		min-height: 230px;
		max-height: 260px;
	}

	#link{
		color: black;
	}

	#wadah{
		font-weight:normal;
	}

	#wadah:hover{
		cursor: pointer;
		background-color: rgb(230, 230, 230);
	}

	.page{
		position: absolute;
		right: 50px;;
		bottom: 0px;
		<!-- margin-right: 70px; -->
		<!-- padding: 20px; -->
		<!-- text-align: right; -->
	}

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="@yield('beranda')" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="@yield('pengumuman')" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	@yield('profil')
@endsection

@section('isi1')
<div class="body">

	<div class="nav">
		<ol class="breadcrumb" style="background-color: white;">
			<li class="active">Pengumuman</li>
			<li></li>
		</ol>	
	</div>

	<div class="atas" style="padding-bottom: 10px;">
		<div class="cari">
			<input class="form-control" type="text" id="myInput" onkeyup="filter()" placeholder="Pencarian...">
		</div>
		<div class="add">
			@yield('add')
			<!-- <a href="/perdes/{{$us->id}}/pengumuman/baru" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span>	Buat Pengumuman</a> -->
		</div>
	</div>

	<div class="row1" id="card">
		<?php foreach ($ann as $key): ?>
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<label><h4 class="panel-title">
							<a href="@yield('link1')" style="">{{$key->judul}}</a></h4>
						</label>
					</div>
					<a href="@yield('link2')" id="link">
						<label id="wadah">
							<div class="panel-body" style="padding: 5px;" id="badan"> 
						
								{{substr($key->isi, 0, 90)}}...
								<div class="kaki" style="text-align: right; margin-top: 20px;">
									{{$key->created_at}} <br>
									{{$key->nama}}
								</div>
							</div>
						</label>
					</a>
				</div>
			</div>
		<?php endforeach ?>
	</div>

	<!-- <div class="panel panel-primary">
			<div class="panel-heading">
			    <h3 class="panel-title">Daftar Pengumuman</h3>
			</div>

			<div class="panel-body">
	  			<table class="table table-hover table-bordered">
	  				<tr>
						<th>ID</th>		
						<th>Judul</th>
						<th>Tanggal ditulis</th>
						<th>Penulis</th>
						<th>Status</th>
					</tr>
					<tbody>
						<?php
			            $no = 0; 
			            foreach ($ann as $key): ?>
			            	<?php  $no = $no + 1; ?>
					            <tr>
					            	<td><?php echo $no ?></td>
					            	<td><a href="/perdes/{{$us->id}}/pengumuman/{{$key->id}}" style="text-decoration: none;">{{$key->judul}}</a></td>
					            	<td>{{$key->created_at}}</td>
					           		<td>{{$key->nama}}</td>
					           		<td>{{$key->status}}</td>
					            </tr>
			            <?php endforeach ?>
					</tbody>
				</table>
				<p>buat paging</p>
			</div>	
	</div> -->
	<div class="page">
		{{$ann->links()}}
	</div>
</div>
	
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#card *").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});
	</script>
@endsection