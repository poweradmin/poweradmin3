@extends('layouts.admin')

@section('content')

<h1>Permission templates</h1>

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
                <a href="" class="btn btn-success btn-xs">Edit</a>
                <a href="" class="btn btn-danger btn-xs">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
