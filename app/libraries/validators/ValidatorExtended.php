<?php

namespace Validators;

use Illuminate\Validation\Validator as IlluminateValidator;

class ValidatorExtended extends IlluminateValidator
{
    private $_custom_messages = [
        "alpha_dash_spaces" => "The :attribute may only contain letters, spaces, and dashes.",
        "alpha_num_spaces" => "The :attribute may only contain letters, numbers, and spaces.",
        "hostname" => "The :attribute is not valid hostname",
    ];

    public function __construct($translator, $data, $rules, $messages = [], $customAttributes = [])
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);

        $this->_set_custom_stuff();
    }

    /**
     * Setup any customizations etc
     *
     * @return void
     */
    protected function _set_custom_stuff()
    {
        //setup our custom error messages
        $this->setCustomMessages($this->_custom_messages);
    }

    /**
     * Allow only alphabets, spaces and dashes (hyphens and underscores)
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    protected function validateAlphaDashSpaces($attribute, $value)
    {
        return (bool) preg_match("/^[A-Za-z\s-_]+$/", $value);
    }

    /**
     * Allow only alphabets, numbers, and spaces
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    protected function validateAlphaNumSpaces($attribute, $value)
    {
        return (bool) preg_match("/^[A-Za-z0-9\s]+$/", $value);
    }

    /**
     * Allow only correct hostname DNS
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    protected function validateHostname($attribute, $value)
    {
        return (bool) preg_match("/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/", $value);
    }
}
