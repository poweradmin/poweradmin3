<tr class="record-row">
    <td class="col-md-1 text-right">
        {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', ['class'=>'btn btn-sm btn-default delete-record', 'style'=>'display:none;']) }}
    </td>
    <td class="col-md-3">
        {{ Form::text('record_names[]', $record->name, ['class'=>'form-control', 'placeholder'=>'Name']) }}
    </td>
    <td class="col-md-2">
        {{ Form::select('record_types[]', array_combine(Record::$types, Record::$types), $record->type, ['class'=>'form-control']) }}
    </td>
    <td class="col-md-3">
        {{ Form::text('record_contents[]', $record->content, ['class'=>'form-control', 'placeholder'=>'Content']) }}
    </td>
    <td class="col-md-2">
        {{ Form::text('record_priorities[]', $record->priority, ['class'=>'form-control', 'placeholder'=>'Priority']) }}
    </td>
    <td class="col-md-2">
        {{ Form::text('record_ttls[]', $record->ttl, ['class'=>'form-control', 'placeholder'=>'TTL']) }}
    </td>
</tr>
