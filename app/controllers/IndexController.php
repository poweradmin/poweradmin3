<?php

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('except' => array('getIndex', 'postIndex')));
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function getIndex()
    {
        if (Confide::user()) {
            return Redirect::to('dashboard');
        }

        return View::make('index.index');
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function postIndex()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            return Redirect::intended('dashboard')
                ->with('message', 'You are now logged in!');
        }
        else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::back()
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }
}
