<tr class="record-row">
    <td class="col-md-1 text-right">
        {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', ['class'=>'btn btn-sm btn-default delete-record']) }}
    </td>
    <td class="col-md-3">
        {{ Form::text('record_names['.$record->id.']', $record->name, ['class'=>'form-control', 'placeholder'=>'Name']) }}
    </td>
    <td class="col-md-2">
        {{ Form::select('record_types['.$record->id.']', array_combine(Record::$types, Record::$types), $record->type, ['class'=>'form-control']) }}
    </td>
    <td class="col-md-3">
        {{ Form::text('record_contents['.$record->id.']', $record->content, ['class'=>'form-control', 'placeholder'=>'Content']) }}
    </td>
    <td class="col-md-2">
        {{ Form::text('record_priorities['.$record->id.']', $record->prio, ['class'=>'form-control', 'placeholder'=>'Priority']) }}
    </td>
    <td class="col-md-2">
        {{ Form::text('record_ttls['.$record->id.']', $record->ttl, ['class'=>'form-control', 'placeholder'=>'TTL']) }}
    </td>
</tr>
