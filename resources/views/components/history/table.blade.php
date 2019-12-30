<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Daftar {{ $title }}</h6>
		<div>
			{{-- @if(auth()->user()->can('create-'.$main))
			<a href="{{ route($main.'.create') }}" class="btn btn-sm btn-primary">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@else
			<a href="#" class="btn btn-sm btn-primary disabled">
				<i class="fas fa-plus"></i> <b>Tambah {{ $title }}</b>
			</a>
			@endif --}}
			<a href="#" class="btn btn-sm btn-primary filter-history">
				<i class="fas fa-list"></i> <b>Filter {{ $title }}</b>
			</a>
		</div>
	</div>
	<div class="card-body">

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Pengguna</th>
					<th>Tabel</th>
					<th>Event</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
