<?php

class ZoneTemplate extends Eloquent
{
    public static $createRules = [
        'name'  => 'required',
    ];

    public function records()
    {
        return $this->hasMany('ZoneTemplateRecord', 'template_id');
    }
}
