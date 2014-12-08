<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'description'];

    private $errors;

    public static $createRules = array(
        'name' => 'required|unique:roles',
        'description'  => 'required',
    );

    public function permissions()
    {
        return $this->belongsToMany('Permission', 'permission_role');
    }

    public function validation($data, $rules)
    {
        // make a new validator object
        $v = Validator::make($data, $rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }
}
