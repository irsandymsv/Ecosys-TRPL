@extends ('layouts.warga')

@section('judul')
Ecosys-Pengumuman
@endsection

@section('gaya')
	.body{
		padding: 10px;
	}

	.atas{
		padding: 35px; 
		padding-top: 0px;
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
		width: 100%;
	}

	#wadah:hover{
		cursor: pointer;
		background-color: rgb(230, 230, 230);
	}

	.page{
		position: absolute;
		right: 80px;;
		bottom: 0px;
		<!-- margin-right: 70px; -->
		<!-- padding: 20px; -->
		<!-- text-align: right; -->
	}

	.tanda{
		float:right;
	}

@endsection

@section('nama-user')
	{{$us->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

<!-- @section('beranda') /warga/{{$us->id}} @endsection
@section('pengumuman') /warga/{{$us->id}}/pengumuman @endsection
@section('laporan') # @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/warga/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Profil</a>
@endsection -->

@section('isi1')
<div class="body">

	<div class="nav">
		<ol class="breadcrumb" style="background-color: white;">
			<li class="active">Pengumuman</li>
			<li></li>
		</ol>	
	</div>

	<div class="atas" style="padding-bottom: 10px;">
		<!-- <div class="cari">
			<input class="form-control" type="text" id="myInput" onkeyup="filter()" placeholder="Pencarian...">
		</div> -->
		<form class="form-inline" method="POST" action="/warga/{{$us->id}}/pengumuman">
			{{csrf_field()}}
			<div class="cari">
				<input class="form-control" name="cari" type="text" id="myInput" onkeyup="" placeholder="Pencarian..." value="<?php echo isset($_POST['cari']) ? $_POST['cari'] : '' ?>">
				<button class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</form>
	</div>

	<div class="row1" id="card">
		<?php foreach ($ann as $key): ?>
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<label><h4 class="panel-title">
							<a href="/warga/{{$us->id}}/pengumuman/{{$key->id}}" style="">{{$key->judul}}</a></h4>
						</label>
						<span class="tanda">
							<!-- <?php if ($key->status == "disimpan"): ?>
								<span class="glyphicon glyphicon-edit"></span>
								
							<?php elseif ($key->status == "dipublikasi"): ?>
								<span class="glyphicon glyphicon-globe"></span>
							<?php endif ?> -->
							
							<?php if ($data > 0): ?>
								<?php foreach ($data as $d): ?>
									<?php if ($key->id == $d): ?>
										<span class="fas fa-circle" style="color: rgb(83, 255, 26); font-size: 16px;"></span>
									<?php endif ?>
								<?php endforeach ?>
							<?php endif ?>
						</span>
					</div>
					<a href="/warga/{{$us->id}}/pengumuman/{{$key->id}}" id="link">
						<label id="wadah">
							<div class="panel-body" style="padding: 5px;" id="badan"> 
						
								{{substr($key->isi, 0, 90)}}...
								<div class="kaki" style="text-align: right; margin-top: 20px;">
									{{$key->published_at}} <br>
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
		// $(document).ready(function(){
		//   $("#myInput").on("keyup", function() {
		//     var value = $(this).val().toLowerCase();
		//     $("#card *").filter(function() {
		//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		//     });
		//   });
		// });
	</script>
@endsection