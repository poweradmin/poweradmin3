@extends('layouts.admin')

@section('content')

@if($domain->exists)
<h1>Edit zone {{{ $domain->name }}}/{{{ $domain->master }}}</h1>
@else
<h1>Add slave zone</h1>
@endif

<div class="row">

    {{ Form::model($domain, ['class'=>'form-horizontal']) }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Zone name</label>
            <div class="col-sm-10">
                {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Hostname', 'id'=>'name']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="master" class="col-sm-2 control-label">IP address of master NS</label>
            <div class="col-sm-10">
                {{ Form::text('master', null, ['class'=>'form-control', 'placeholder'=>'IP', 'id'=>'master']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="account" class="col-sm-2 control-label">Account</label>
            <div class="col-sm-10">
                {{ Form::select('account', $usersList, null, ['class'=>'form-control']) }}
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
