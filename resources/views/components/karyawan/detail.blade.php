@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Detail {{ $title }}</h6>
		<a href="{{ route($main.'.index') }}" class="btn btn-sm btn-primary">
			<i class="fas fa-list"></i> <b>Daftar {{ $title }}</b>
		</a>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-7">
				<div class="row pb-2">
					<span class="col-4">Nama</span>
					<span class="col-8">: <b>{{ $model->nama }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Jabatan</span>
					<span class="col-8">: <b>{{ isset($model->jabatan->nama)?$model->jabatan->nama:'-' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Gaji</span>
					<span class="col-8">: <b>Rp {{ number_format($model->gaji, 0, '', '.') }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Email</span>
					<span class="col-8">: <b>{{ ($model->email)?$model->email:'-' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">No. Telefon</span>
					<span class="col-8">: <b>{{ ($model->phone)?$model->phone:'-' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Alamat</span>
					<span class="col-8">: <b>{{ ($model->alamat)?$model->alamat:'-' }}</b></span>
				</div>
				<div class="row pb-2">
					<span class="col-4">Foto</span>
					<span class="col-8"> {!! $foto !!}</span>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
