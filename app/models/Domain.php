<?php

class Domain extends Eloquent
{
    protected $table = 'domains';

    /**
     * records relationship
     */
    public function records()
    {
        return $this->hasMany('Record', 'domain_id', 'id');
    }
}
