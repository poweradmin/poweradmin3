<?php

namespace Helpers;

class View
{
    public static function sessionString($sessionKey)
    {
        $return = '';

        /**
         * @var \Illuminate\Support\ViewErrorBag
         */
        $sessionContent = \Session::get($sessionKey, []);

        if ($sessionContent instanceof \Illuminate\Support\ViewErrorBag) {
            $messages = $sessionContent->toArray();
            $return = join('<br>', $messages[0]);
        } elseif (is_array($sessionContent)) {
            $return = join('<br>', $sessionContent);
        } elseif (is_string($sessionContent)) {
            $return = $sessionContent;
        }

        return $return;
    }
}
