@extends('layouts.admin')

@section('content')

<h1>Add new role</h1>

{{ Form::open() }}

<div class="form-group">
    <label for="inputRoleName">Name</label>
    {{ Form::text('name', null, ['class'=>'form-control', 'id'=>'inputRoleName', 'placeholder'=>'Name of role']) }}
</div>

<div class="form-group">
    <label for="inputRoleDescription">Description</label>
    {{ Form::text('description', null, ['class'=>'form-control', 'id'=>'inputRoleDescription', 'placeholder'=>'Role description']) }}
</div>

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
            <td>{{ Form::checkbox('perm['.$permission->id.']', 1, null, ['id'=>'perm_'.$permission->name]) }}</td>
            <td><label for="perm_{{ $permission->name }}">{{ $permission->name }}</label></td>
            <td>{{ $permission->display_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ Form::submit('Save', ['class'=>'btn btn-success']) }}

{{ Form::close() }}
@stop
