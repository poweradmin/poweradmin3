@extends('layouts.admin')

@section('content')

<h1>Users list</h1>

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
        @foreach($users as $user)
        <tr>
            <td>{{ intval($user->id) }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->description }}</td>
            <td>
                <button type="button" class="btn btn-success btn-xs">Edit</button>
                <button type="button" class="btn btn-danger btn-xs">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
