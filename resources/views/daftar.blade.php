<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
</head>
<body>
	<h2>Daftarlah!</h2>
	
	<form method="POST" action="/daftar">
		{{csrf_field()}}
		nama: <input type="text" name="nama"><br><br>
		password: <input type="password" name="password"><br><br>
		jenis kelamin: <input type="radio" name="jenis_kelamin" value="Laki-laki">Laki-laki
						<input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan<br><br>
		alamat tinggal: <input type="text" name="alamat_tinggal"><br><br>
		alamat asal: <input type="text" name="alamat_asal"><br><br>

		provinsi asal: <select id="prov" name="id_prov_asal">
			<?php foreach ($provinsis as $prov): ?>
				<option value="{{$prov->id}}">{{$prov->name}}</option>
			<?php endforeach ?>
		</select><br><br>

		kabupaten asal: <select id="kabupaten" name="id_kab_asal">
			<?php foreach ($kabs as $kab): ?>
				<option value="{{$kab->id}}">{{$kab->name}}</option>
			<?php endforeach ?>
			<!-- <option value="coba" selected>dicoba</option> -->
		</select><br><br>

		profesi: <select name="profesi_id">
			<?php foreach ($profs as $prof): ?>
				<option value="{{$prof->id_prof}}">{{$prof->nama_profesi}}</option>
			<?php endforeach ?>
		</select><br><br>

		tempat_lahir: <input type="text" name="tempat_lahir"><br><br>
		tanggal_lahir: <input type="date" name="tanggal_lahir"><br><br>
		no_hp: <input type="text" name="no_hp"><br><br>
		email: <input type="email" name="email"><br><br>
		nik: <input type="text" name="nik"><br><br>
		role: <select name="id_role">
			<?php foreach ($roles as $peran): ?>
				<option value="{{$peran->id}}">{{$peran->nama_role}}</option>
			<?php endforeach ?>
		</select><br><br>
		<!-- <input type="role" name="role"><br><br> -->

		<input type="submit" name="submit" value="daftar!">
		
	</form>
<!-- 	<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
			
		$(document).ready(function() {

			$("select[name='id_prov_asal']").change(function() {
				alert("pilih");
				if ($(this).val() != '') {
					var nilai = $(this).val();
   					$.$.ajax({
   						url: '/daftar/select',
   						type: 'POST',
   						dataType: 'json',
   						data: {param1: nilai},
   						success:function(result)
   						{
   							$('#kabupaten').html(result);
   						}
   					});
   					
				}
			});				
		});

	</script> -->
</body>
</html>