<?php

class Domain extends Eloquent
{
    public $timestamps = false;

    public static $createSlaveRules = [
        'name'  => 'required|hostname',
        'master' => 'required|ip',
        'account' => 'required|exists:users,username',
    ];

    /**
     * records relationship
     */
    public function records()
    {
        return $this->hasMany('Record', 'domain_id', 'id');
    }

    /**
     * Save the model to the database.
     *
     * @param  array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->exists) {
            // checking for unique keys
            $lookRecord = self::whereName($this->name)->first();

            if (!is_null($lookRecord)) {
                return $lookRecord;
            }
        }

        $saved = parent::save($options);

        return $saved;
    }
}
