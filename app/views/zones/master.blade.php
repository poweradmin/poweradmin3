@extends('layouts.admin')

@section('content')

@if($domain->exists)
<h1>Edit zone {{{ $domain->name }}}/{{{ $domain->master }}}</h1>
@else
<h1>Add master zone</h1>
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
            <label for="account" class="col-sm-2 control-label">Account</label>
            <div class="col-sm-10">
                {{ Form::select('account', $usersList, null, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="type" class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                {{ Form::select('type', array_combine(Domain::$types, Domain::$types), null, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="template" class="col-sm-2 control-label">Template</label>
            <div class="col-sm-10">
                {{ Form::select('template', [''=>'none']+$templates, null, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Add zone', ['class'=>'btn btn-default']) }}
            </div>
        </div>
    {{ Form::close() }}

</div>

@stop
