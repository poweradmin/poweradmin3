@extends('layouts.admin')

@section('content')

<h1>Edit {{{ $domain->name }}}</h1>

<div class="row">

    {{ Form::model($domain, ['class'=>'form-horizontal']) }}
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
                    @foreach($domain->records as $record)
                        @include('domain._record-row', ['record' => $record])
                    @endforeach
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
</div>

@stop

@section('js')
<script type="text/javascript">
$(document).ready(function(){

    var table_row = "{{ str_replace(["\n", "\r", "\r\n", '[]'], ['', '', '', '_new[]'], addslashes(View::make('domain._record-row', ['record' => new Record(['ttl'=>86400])]))) }}";

    // adding new record table row
    $('.add-record').click(function(){
        $('table.records-table').append(table_row);

        return false;
    });

    $('.records-table').on('click', '.delete-record', function() {
        $(this).closest('tr').remove();

        return false;
    });

});
</script>
@stop
