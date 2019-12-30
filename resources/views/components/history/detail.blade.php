@extends('app')

@section('title', $title)

@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Tabel Detail History</h6>
        @if(auth()->user()->can('index-history'))
            <a href="{{ route('history.index') }}" class="btn btn-sm btn-warning">
                <i class="fas fa-list"></i> <b>Daftar History</b>
            </a>
        @else
            <a href="#" class="btn btn-sm btn-warning disabled">
                <i class="fas fa-list"></i> <b>Daftar History</b>
            </a>
        @endif
	</div>
	<div class="card-body">
        <ul>
            <li>
                On <u>{{$value->created_at}}</u>, <b>{{$value->user->username}}</b> [{{$value->ip_address}}] <b>{{$value->event}}</b> this record via [{{$value->url}}]
                <ul>
                    <li>
                        Old Values :
                        <ul>
                            @foreach (json_decode($value->old_values) as $key => $row)
                                <li>{{$key.': '.$row}}</li>
                            @endforeach
                        </ul>
                    </li>
                    <li>New Values :
                        <ul>
                            @foreach (json_decode($value->new_values) as $key => $row)
                                <li>{{$key.': '.$row}}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
	</div>
</div>

@endsection
