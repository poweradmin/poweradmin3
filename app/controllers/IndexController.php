<?php

class IndexController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('except' => array('getIndex','postIndex')));
    }

	public function getIndex()
	{
		if( Auth::check() ) {
            return Redirect::to('dashboard');
        }

        return View::make('index.index');
	}

    public function postIndex()
    {
        if (Auth::attempt(['username'=>Input::get('username'), 'password'=>Input::get('password'), 'status'=>1])) {
            return Redirect::to('dashboard')->with('message', 'You are now logged in!');
        } else {
            return Redirect::back()
                ->with('error', 'Incorrect login or password')
                ->withInput();
        }
    }

    public function getDashboard()
    {
        $domains = Domain::all();

        return View::make('index.dashboard')
            ->withDomains($domains);
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

}
