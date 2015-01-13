@extends('layouts.admin')

@section('content')

@if($template->exists)
<h1>Edit {{{ $template->name }}} template</h1>
@else
<h1>Add zone template</h1>
@endif

<div class="row">

    {{ Form::model($template, ['class'=>'form-horizontal']) }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Template name</label>
            <div class="col-sm-10">
                {{ Form::text('name', null, ['class'=>'form-control', 'id'=>'name']) }}
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                {{ Form::text('description', null, ['class'=>'form-control', 'id'=>'description']) }}
            </div>
        </div>

        <div class="form-group">
            <span class="col-md-2 control-label"><label>Template records</label></span>
            <div class="col-md-10">

                <table class="table records-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Content</th>
                        <th>Priority</th>
                        <th>TTL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($template->records as $record)
                        @include('zones._record-row', ['record' => $record])
                    @endforeach
                    @include('zones._record-row', ['record' => new ZoneTemplateRecord(['ttl'=>86400])])
                    </tbody>
                </table>
                <button class="btn btn-sm btn-default add-record"><span class="glyphicon glyphicon-plus"></span> One more record</button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Save', ['class'=>'btn btn-success']) }}
            </div>
        </div>
    {{ Form::close() }}

    <div class="bs-callout bs-callout-info">
        <h4>Template hint</h4>
        <p>The following placeholders can be used in template records:</p>
        <ul>
            <li>[ZONE] - substituted with current zone name</li>
            <li>[SERIAL] - substituted with current date and 2 numbers (YYYYMMDD + 00)</li>
        </ul>
    </div>

</div>

@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){

    if($('.record-row').length>1) {
        $('.delete-record').show();
    }

    // adding new record table row
    $('.add-record').click(function(){
        var table_row = $('.record-row:last').clone();

        // clearing fields
        $(table_row).find('input').val('');
        $(table_row).find('input:last').val('86400');

        $('table.records-table').append(table_row);

        $('.delete-record').show();

        return false;
    });

    $('.records-table').on('click', '.delete-record', function(){
        $(this).closest('tr').remove();

        if($('.delete-record').length==1) {
            $('.delete-record').hide();
        }

        return false;
    });

});
</script>
@stop
