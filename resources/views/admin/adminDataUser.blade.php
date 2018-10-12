@extends ('layouts.admin')

@section('judul')
Ecosys-Data Pengguna
@endsection

@section('gaya')

.nav{
padding: 15px;
<!-- padding-top: 0; -->
}

.atas{
margin-top: 0px;
padding: 15px; 
padding-top: 0px;

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
<!-- text-align: center; -->
<!-- background-color:white; -->
}

.table.table-hover.table-bordered {
background-color:white;
font-size: 18px;
}

th{
text-align: center;
}

	<!-- .form-inline{
		padding: 15px;
		padding-top: 0;
	} -->
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
	<div class="nav">
		<ol class="breadcrumb" style="background-color: white;">
			<li class="active">Data Pengguna</a></li>
			<li></li>
		</ol>	
	</div>

	<div class="atas" style="">
		<div class="cari">
			<input class="form-control" type="text" id="myInput" onkeyup="filter()" placeholder="Pencarian...">
		</div>

		<div class="add">
			<a href="/admin/{{$ad->id}}/data/baru" class="btn btn-success btn-lg baru" style="padding: 5px 10px;"><span class="glyphicon glyphicon-plus"></span> Buat Baru</a>
		</div>
	</div>

	<div class="table-responsive">

		<table class="table table-hover table-bordered" id="data">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Role</th>
				<th>Profesi</th>
				<th>Aksi</th>
			</tr>
			<tbody id="body-tab">
				<?php
				$no = 0; 
				foreach ($list as $key): ?>
					<?php  $no = $no + 1; ?>
					<tr>
						<td><?php echo $no ?></td>
						<td><a href="/admin/{{$ad->id}}/data/{{$key->id}}" style="text-decoration: none;">{{$key->nama}}</a></td>
						<td>{{$key->nama_role}}</td>
						<td>{{$key->nama_profesi}}</td>
						<td style="text-align: center;">
							<a href="/admin/{{$ad->id}}/data/edit/{{$key->id}}" class="btn btn-warning">Edit</a>
							<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal">Hapus</button>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
		</table>
		<div id="myModal" class="modal fade" role="dialog">
			  	<div class="modal-dialog">
			    	<!-- Modal content-->
				    <div class="modal-content">

				      <div class="modal-header" style="background-color: rgb(255, 77, 77)">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="color: white;">Konfirmasi Penghapusan</h4>
				      </div>

				      <div class="modal-body">
				        <p>Apakah anda ingin Menghapus data?</p>
				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				        <a href="/admin/{{$ad->id}}/data/{{$key->id}}/delete" class="btn btn-danger" type="submit" name="submit" style="padding: 5px 20px;">Ya</a>
				      </div>
				    </div>

			  	</div>
		</div>
	</div>

	<!-- <div class="row" style="text-align: center;">
		<div class="col-md-6">
			<a href="/admin/{{$ad->id}}/data/perdes" class="btn btn-success btn-lg" style="padding: 40px 60px;">Perangkat Desa</a>		
		</div>

		<div class="col-md-6">
			<a href="/admin/{{$ad->id}}/data/warga" class="btn btn-success btn-lg" style="padding: 40px 60px;">Warga Desa</a>
		</div>

		<div class="col-md-12">
			<a href="/admin/{{$ad->id}}/data/admin" class="btn btn-success btn-lg" style="padding: 40px 60px;">Admin</a>
		</div>

		<div class="buatBaru">
			<a href="/admin/{{$ad->id}}/data/baru" class="btn btn-warning btn-lg baru" style="padding: 10px 15px;">Buat Data <br> Pengguna Baru</a>
		</div>
	</div> -->

	<!-- <a href=""></a> -->
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
	@endsection