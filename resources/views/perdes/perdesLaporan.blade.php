@extends ('layouts.laporan')

@section('beranda') /perdes/{{$us->id}} @endsection
@section('pengumuman') /perdes/{{$us->id}}/pengumuman @endsection
@section('Laporan') /perdes/{{$us->id}}/laporan @endsection
@section('statistika') # @endsection

@section('data profil')
	<a href="/perdes/{{$us->id}}/profil" style="font-size: 20px;"><span class="far fa-id-card" style="margin-right: 20px; color: rgb(255, 204, 0);"></span>Profil</a>
@endsection

@section('laporan_baru')
	/perdes/{{$us->id}}/laporan/baru
@endsection

@section('tbody')
<div class="table-responsive">
	<table class="table table-hover table-bordered" id="data">
		<tr>
			<th>No</th>
			<th>Judul</th>
			<th>tanggal</th>
			<th>Penulis</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
		<tbody id="body-tab">
			<?php $no=0;
			foreach ($laporan as $lap): ?>
				<?php $no = $no + 1; ?>
				<tr>
					<td><?php echo $no ?></td>
					<td>
						<a href="/perdes/{{$us->id}}/laporan/{{$lap->id}}">{{$lap->judul}}</a>
						@if ($data > 0)
							@foreach ($data as $d)
								@if ($lap->id == $d)
									<span class="fas fa-circle" style="color: rgb(83, 255, 26); font-size: 13px;"></span>

									<?php $lap_prof = App\Models\laporan::find($lap->id)->profesi()->get();  ?>
									@if ($lap_prof->isNotEmpty())
										@foreach ($lap_prof as $lp)
											@if ($lp->id_prof == $us->profesi_id)
												<span class="fas fa-circle" style="color: rgb(255, 71, 26); font-size: 13px;"></span>
											@endif
										@endforeach
									@endif
								@endif
							@endforeach
						@endif
					</td>
					<td>{{$lap->created_at}}</td>
					<td>{{$lap->nama}}</td>
					<td>{{$lap->status}}</td>
					<td style="text-align: center;">
						<form method="POST" action="/perdes/{{$us->id}}/laporan/{{$lap->id}}/status">
							{{csrf_field()}}
							@if("$lap->status" == "Belum ditangani")
								<button name="selesai" class="btn btn-success" type="button" data-toggle="modal" data-target="#modalA{{$lap->id}}">Selesai</button>
							@elseif("$lap->status" == "Sudah ditangani")
								<button name="batal" class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalB{{$lap->id}}">Batal</button>
							@endif
							
							<input class="status" type="hidden" name="status" value="">
							<div id="modalA{{$lap->id}}" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Konfirmasi</h4>
										</div>

										<div class="modal-body">
											<p>Apakah anda yakin ingin mengubah status laporan menjadi Sudah ditangani ?</p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" >Tidak</button>
											
											<button class="btn btn-success" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
										</div>
									</div>
								</div>
							</div>
							<div id="modalB{{$lap->id}}" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Konfirmasi</h4>
										</div>

										<div class="modal-body">
											<p>Apakah anda yakin ingin membatalkan laporan yang telah ditangani ?</p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" >Tidak</button>
											
											<button class="btn btn-danger" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
										</div>
									</div>

								</div>
							</div>
							<input type="hidden" name="_method" value="PUT">
						</form>
					</td>
				</tr>
				
			<?php endforeach ?>
		</tbody>
	</table>	

	
</div>

@endsection