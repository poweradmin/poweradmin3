<?php

class UserController extends BaseController
{
    public function getIndex()
    {
        return View::make('user.index');
    }

    public function postIndex()
    {
        if (Hash::check(Input::get('password_current'), Auth::user()->password)) {
            $user = Auth::user();
            $user->password = Input::get('password');
            $user->password_confirmation = Input::get('password_confirmation');
            $saved = $user->save();

            if (!$saved) {
                return Redirect::back()
                    ->withErrors($user->errors()->all());
            } else {
                return Redirect::back()
                    ->withSuccess('Password changed');
            }
        }

        return Redirect::back()
            ->withErrors('Password didnt match');
    }
}
