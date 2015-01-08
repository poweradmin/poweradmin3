@extends('layouts.admin')

@section('content')

<h1>Zone templates</h1>

<div class="btn-group margin-bottom-15" role="group">
    <a href="{{ URL::to('/zones/add-template') }}" class="btn btn-info">Add template</a>
</div>

@if(count($templates)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Records</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@else
    <div class="alert alert-warning" role="alert">No templates</div>
@endif

@stop
