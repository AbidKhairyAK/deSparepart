<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-secondary">Detail Daftar Stok Limit</h6>
	</div>
	<div class="card-body">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Part NO</th>
					<th>Nama</th>
					<th>Stok</th>
					<th>Limit</th>
					<th>Hrg Beli Standar</th>
					<th>Hrg Jual Standar</th>
					<th width="50">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($limit as $l)
				<tr>
					<td>{{ $l->part_no }}</td>
					<td>{{ $l->nama }}</td>
					<td class="text-{{ $l->stok > 0 ? 'warning' : 'danger' }}">{{ $l->stok }}</td>
					<td>{{ $l->limit }}</td>
					<td>Rp {{ number_format($l->harga_beli, 0, '', '.') }}</td>
					<td>Rp {{ number_format($l->harga_jual, 0, '', '.') }}</td>
					<td>
						<a class="btn btn-sm btn-info" href="{{ route('barang.show', $l->id) }}">
							<i class="fas fa-eye"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>