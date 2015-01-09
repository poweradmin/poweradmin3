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
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Records</th>
            <th>Updated at</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($templates as $template)
            <tr>
                <td>
                    <a href="{{ URL::to('/zones/edit-template/'.$template->id) }}" class="btn btn-success btn-xs">Edit</a>
                    <a href="{{ URL::to('/zones/delete-template/'.$template->id) }}" class="btn btn-danger btn-xs xconfirm">Delete</a>
                </td>
                <td>{{{ $template->name }}}</td>
                <td>{{{ $template->description }}}</td>
                <td>{{ $template->records->count() }}</td>
                <td>{{ $template->updated_at }}</td>
                <td>{{ $template->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-warning" role="alert">No templates</div>
@endif

@stop
