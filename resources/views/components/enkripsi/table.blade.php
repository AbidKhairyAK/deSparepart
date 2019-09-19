<div class="card shadow mb-4">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar Enkripsi</h6>
	</div>
	<div class="card-body">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Angka</th>
					<th>Huruf</th>
					<th width="50">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$list = ['M','A','N','I','S','B','E','T','U','Huruf Selain Diatas'];
				@endphp
				@foreach($list as $i => $val)
				<tr>
					<td>{{ $i == 9 ? 0 : $i+1 }}</td>
					<td>{{ $val }}</td>
					<td>
						@if($i != 9)
						<div class="dropdown no-arrow">
							<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
								<i class="fas fa-cogs"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow">
								<a class="dropdown-item" href="#">Edit</a>
							</div>
						</div>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>