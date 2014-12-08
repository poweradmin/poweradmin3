@extends('layouts.admin')

@section('content')

<h1>{{ $role->name }} role</h1>

{{ Form::open() }}
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>{{ Form::checkbox('perm['.$permission->id.']', 1, in_array($permission->id, $rolePermissions), ['id'=>'perm_'.$permission->name]) }}</td>
            <td><label for="perm_{{ $permission->name }}">{{ $permission->name }}</label></td>
            <td>{{ $permission->display_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ Form::submit('Save', ['class'=>'btn btn-success']) }}

{{ Form::close() }}
@stop
