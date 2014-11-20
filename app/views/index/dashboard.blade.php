@extends('layouts.admin')

@section('content')

<h1>Domains list</h1>

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
                <button type="button" class="btn btn-success btn-xs">Edit</button>
                <button type="button" class="btn btn-danger btn-xs">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
