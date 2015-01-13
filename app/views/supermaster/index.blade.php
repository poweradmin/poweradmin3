@extends('layouts.admin')

@section('content')

<h1>Supermasters list</h1>

@if(count($supermasters)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>IP address</th>
            <th>Hostname</th>
            <th>Account</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($supermasters as $supermaster)
        <tr>
            <td>{{ $supermaster->ip }}</td>
            <td>{{ $supermaster->nameserver }}</td>
            <td>{{ $supermaster->account }}</td>
            <td>
                <a href="{{ URL::to('/supermaster/delete/'.$supermaster->ip.'/'.$supermaster->nameserver) }}" class="btn btn-danger btn-xs">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-warning" role="alert">No supermasters</div>
@endif

@stop
