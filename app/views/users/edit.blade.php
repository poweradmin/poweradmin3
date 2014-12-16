@extends('layouts.admin')

@section('content')

@if($user->exists)
<h1>Edit user "{{{ $user->username }}}"</h1>
@else
<h1>Add new user</h1>
@endif

<div class="row">

    {{ Form::model($user, ['class'=>'form-horizontal']) }}
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                {{ Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username', 'id'=>'username']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email address</label>
            <div class="col-sm-10">
                {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email address', 'id'=>'email']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="permission" class="col-sm-2 control-label">Permission template</label>
            <div class="col-sm-10">
                @foreach($roles as $roleId=>$roleName)
                <div class="checkbox">
                    <label>{{ Form::checkbox('permission[]', $roleId, $user->hasRole($roleName)) }} {{{ $roleName }}}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                {{ Form::password('password', ['class'=>'form-control', 'id'=>'password']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="password2" class="col-sm-2 control-label">Password confirmation</label>
            <div class="col-sm-10">
                {{ Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'password2']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                {{ Form::text('description', null, ['class'=>'form-control', 'placeholder'=>'Description', 'id'=>'description']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>{{ Form::checkbox('confirmed') }} Enabled</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Save', ['class'=>'btn btn-default']) }}
            </div>
        </div>
    {{ Form::close() }}

</div>

@stop
