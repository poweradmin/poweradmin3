@extends('layouts.admin')

@section('content')

<h1>Change password</h1>

<div class="row">

    {{ Form::open(['class'=>'form-horizontal']) }}
        <div class="form-group">
            <label for="password_current" class="col-sm-2 control-label">Current password</label>
            <div class="col-sm-10">
                {{ Form::password('password_current', ['class'=>'form-control', 'id'=>'password_current']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">New password</label>
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
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Save', ['class'=>'btn btn-default']) }}
            </div>
        </div>
    {{ Form::close() }}

</div>

@stop
