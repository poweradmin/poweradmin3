@extends('layouts.admin')

@section('content')

@if($supermaster->exists)
<h1>Edit supermaster {{{ $supermaster->ip }}}/{{{ $supermaster->nameserver }}}</h1>
@else
<h1>Add new supermaster</h1>
@endif

<div class="row">

    {{ Form::model($supermaster, ['class'=>'form-horizontal']) }}
        <div class="form-group">
            <label for="ip" class="col-sm-2 control-label">IP address of supermaster</label>
            <div class="col-sm-10">
                {{ Form::text('ip', null, ['class'=>'form-control', 'placeholder'=>'ip', 'id'=>'IP address']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="nameserver" class="col-sm-2 control-label">Hostname in NS record</label>
            <div class="col-sm-10">
                {{ Form::text('nameserver', null, ['class'=>'form-control', 'placeholder'=>'Nameserver', 'id'=>'nameserver']) }}
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
