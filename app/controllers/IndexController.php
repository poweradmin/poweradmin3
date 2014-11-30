<?php

class IndexController extends BaseController
{
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
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function getForgotPassword()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function postForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::to('/')
                ->with('notice', $notice_msg);
        }
        else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::back()
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function getResetUserPassword($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
            ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function postResetUserPassword()
    {
        $repo = App::make('UserRepository');
        $input = [
            'token'                 => Input::get('token'),
            'password'              => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        ];

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::to('/')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('IndexController@getResetUserPassword', ['token'=>$input['token']])
                ->withInput()
                ->with('error', $error_msg);
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
