@extends ('layouts.dash')

@section('link ref')
	<link rel="stylesheet" type="text/css" href="{{asset('/DataTables/datatables.min.css')}}"/>
@endsection

@section('judul')
	Ecosys-Data Warga Desa
@endsection

@section('gaya')

	.form-control{
		 width:25%;

	}

	.nav{
		padding: 15px;
		padding-top: 0;
	}

	.table-responsive{
		padding: 80px;
		padding-top: 30px;
		<!-- margin-top: 10px; -->
	}

	.table.table-hover.table-bordered {
		background-color:white;
		font-size: 18px;
	}

@endsection

@section('nama-user')
	{{$ad->nama}}
@endsection

@section('peran')
	{{$role->nama_role}}
@endsection

@section('side-bawah')
	<p style="font-size: 18px;">MENU</p>
	<a href="/admin/{{$ad->id}}" style="font-size: 20px;"><span class="glyphicon glyphicon-home" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Beranda</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-bullhorn" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Pengumuman</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-list-alt" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Laporan</a>

	<a href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-stats" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>	Statistika</a>

	<a href="/admin/{{$ad->id}}/data" style="font-size: 20px;"><span class="fas fa-users" style="margin-right: 20px; color: rgb(
	255, 204, 0);"></span>Data Pengguna</a>
	
@endsection

@section('isi1')
	<div class="nav">
		<p style="font-size: 14px;"><h3 style="text-align: left;">Data Pengguna > Warga Desa</h3></p>
		<div class="table-responsive">
			<input class="form-control" type="text" id="myInput" onkeyup="filter()" placeholder="Pencarian...">
			<br>
			<table class="table table-hover table-bordered" id="data">
	        	<tr>
	                <th>No</th>
	                <th>Nama</th>
	                <th>Profesi</th>
	            </tr>
	            <tbody id="body-tab">
		            <?php
		            $no = 0; 
		            foreach ($list as $key): ?>
		            	<?php  $no = $no + 1; ?>
				            <tr>
				            	<td><?php echo $no ?></td>
				            	<td><a href="/admin/{{$ad->id}}/data/warga/{{$key->id}}" style="text-decoration: none;">{{$key->nama}}</a></td>
				           		<td>{{$key->nama_profesi}}</td>
				            </tr>
		            <?php endforeach ?>
	            </tbody>
	    	</table>

		</div>
		
	</div>
@endsection

@section('script')
	
	<!-- pencarian /filter dg jquary -->
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

	<!-- pencarian/filter dg js munri -->
	<!-- <script type="text/javascript">
		function filter() {
			var input, filter, table, tr, td, i;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("data");
			tr = table.getElementsByTagName("tr");

			for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[0];
			    if (td) {
			      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    } 
			}
		}
	</script> -->
	
@endsection