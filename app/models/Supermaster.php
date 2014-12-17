<?php

class Supermaster extends Eloquent
{
    protected $primaryKey = ['ip', 'nameserver'];

    public $timestamps = false;

    public static $createRules = [
        'ip' => 'required|ip',
        'nameserver'  => 'required|hostname',
        'account' => 'required|exists:users,username'
    ];

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->exists) {
            // checking for unique keys
            $lookSupermaster = Supermaster::whereIp($this->ip)->whereNameserver($this->nameserver)->first();

            if (!is_null($lookSupermaster)) {
                return $lookSupermaster;
            }
        }

        $saved = false;

        try {
            $saved = parent::save($options);
        } catch(ErrorException $e) {
            if ($e->getMessage()=='PDO::lastInsertId() expects parameter 1 to be string, array given') {
                $saved = [
                    'ip' => $this->ip,
                    'nameserver' => $this->nameserver,
                ];
            }
        }

        return $saved;
    }
}
