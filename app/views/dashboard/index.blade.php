@extends('layouts.admin')

@section('content')

<h1>Domains list</h1>

@if(count($domains)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Records</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($domains as $domain)
        <tr>
            <td>{{ intval($domain->id) }}</td>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->type }}</td>
            <td>{{ $domain->records->count() }}</td>
            <td>
                <a href="{{ URL::to('/domain/edit/'.$domain->id) }}" class="btn btn-success btn-xs">Edit</a>
                <a href="{{ URL::to('/domain/delete/'.$domain->id) }}" class="btn btn-danger btn-xs">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-warning" role="alert">No domains</div>
@endif

@stop
