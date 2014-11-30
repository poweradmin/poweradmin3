@extends('layouts.admin')

@section('content')

<h1>Users list</h1>

<div class="btn-group" role="group" aria-label="...">
    <a href="{{ URL::to('users/add') }}" class="btn btn-default btn-success">Add user</a>
    <a href="{{ URL::to('users/roles') }}" class="btn btn-default btn-info">Edit roles</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Description</th>
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
