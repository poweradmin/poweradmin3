<?php

namespace Helpers;

class View
{
    /**
     * Get an string from flash session container
     *
     * @param string $sessionKey
     *
     * @return string
     */
    public static function sessionString($sessionKey)
    {
        $return = '';

        /**
         * @var \Illuminate\Support\ViewErrorBag
         */
        $sessionContent = \Session::get($sessionKey, []);

        if ($sessionContent instanceof \Illuminate\Support\ViewErrorBag) {
            $messages = $sessionContent->toArray();
            $return = implode('<br>', $messages[0]);
        } elseif (is_array($sessionContent)) {
            $return = implode('<br>', $sessionContent);
        } elseif (is_string($sessionContent)) {
            $return = $sessionContent;
        }

        return $return;
    }

    /**
     * Returning an string represent (un)active state of a link/resource
     *
     * @param string $sLink        a link in SomeController@getAction statement for specify RESTful actions or SomeController@*Action for all RESTful actions
     * @param string $sMatchReturn OPTIONAL: a text to return on success match
     *
     * @uses Helpers\View::activeLaravelLink('UserController@getRegister')
     * Helpers\View::activeLaravelLink('UserController@*Register')
     * Helpers\View::activeLaravelLink('UserController@getRegister', ' selected')
     *
     * @return string
     */
    public static function activeLaravelLink($sLink, $sMatchReturn = ' active')
    {
        $sControllerAction = \Route::getCurrentRoute()->getActionName();
        $sReturn = '';

        if (substr($sLink, -2) == '@*') {
            $explodedControllerAction = explode('@', $sControllerAction);
            $sControllerAction = $explodedControllerAction[0].'@*';
            unset($explodedControllerAction);
        } elseif (str_contains($sLink, '@*')) {
            // ::get, ::post, ::put, ::delete, ::patch
            $sControllerAction = str_replace(['@get', '@post', '@put', '@delete', '@patch'], '@*', $sControllerAction);
        }

        if ($sLink == $sControllerAction) {
            $sReturn = $sMatchReturn;
        }

        return $sReturn;
    }
}
