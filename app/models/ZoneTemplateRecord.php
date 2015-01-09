<?php

class ZoneTemplateRecord extends Eloquent
{
    protected $guarded = [];

    private static $createRules = [
        'template_id' => 'required|exists:zone_templates,id',
        'name'  => 'required',
        'type' => 'required',
        'content' => 'required',
        'ttl' => 'required|integer',
        'priority' => 'required|integer',
    ];

    public static function getCreateRules()
    {
        $createRules = self::$createRules;
        $createRules['type'] .= '|in:'.implode(',', Record::$types);

        return $createRules;
    }
}
