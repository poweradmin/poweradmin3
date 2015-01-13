<?php

class Domain extends Eloquent
{
    public $timestamps = false;

    public $fillable = ['name', 'master', 'type', 'account'];

    public static $types = ['master', 'native'];

    public static $createSlaveRules = [
        'name'  => 'required|hostname|unique:domains,name',
        'master' => 'required|ip',
        'type' => 'required|in:slave',
        'account' => 'required|exists:users,username',
    ];

    private static $createMasterRules = [
        'name'  => 'required|hostname|unique:domains,name',
        'type' => 'required',
        'account' => 'required|exists:users,username',
    ];

    /**
     * records relationship
     */
    public function records()
    {
        return $this->hasMany('Record', 'domain_id', 'id');
    }

    public static function getCreateMasterRules()
    {
        $createRules = self::$createMasterRules;
        $createRules['type'] .= '|in:'.implode(',', Domain::$types);

        return $createRules;
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
