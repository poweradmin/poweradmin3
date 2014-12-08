@extends('layouts.admin')

@section('content')

<h1>Roles templates</h1>

<div class="btn-group" role="group" aria-label="...">
    <a href="{{ URL::to('users/add-role') }}" class="btn btn-default btn-success">Add new role</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>Description</th>
            <th>Created at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ intval($role->id) }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td>{{ $role->created_at }}</td>
            <td>
                <a href="{{ URL::to('users/role/'.$role->id) }}" class="btn btn-success btn-xs">Edit</a>
                <a href="{{ URL::to('users/delete-role/'.$role->id) }}" class="btn btn-danger btn-xs">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
