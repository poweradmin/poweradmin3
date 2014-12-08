<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany('Permission', 'permission_role');
    }
}
