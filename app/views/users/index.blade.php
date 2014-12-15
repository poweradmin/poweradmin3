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
            <th>Roles</th>
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
            <td>
                @foreach($user->roles()->get() as $userRole)
                    {{ $userRole->name }}<br>
                @endforeach
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->description }}</td>
            <td>
                <a href="{{ URL::to('users/edit/'.$user->id) }}" class="btn btn-success btn-xs">Edit</a>
                @if($user->id!=1)
                <a href="{{ URL::to('users/delete/'.$user->id) }}" class="btn btn-danger btn-xs">Delete</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
