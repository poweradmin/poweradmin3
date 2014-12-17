<?php

class SupermasterController extends BaseController
{
    public function getIndex()
    {
        $supermaster = Supermaster::all();

        return View::make('supermaster.index')
            ->withSupermasters($supermaster);
    }

    public function getAdd()
    {
        $supermaster = new Supermaster();
        $usersList = User::all()->lists('username', 'username');

        return View::make('supermaster.edit')
            ->withSupermaster($supermaster)
            ->with('usersList', $usersList);
    }

    public function postAdd()
    {
        $validator = Validator::make(Input::all(), Supermaster::$createRules);

        if ($validator->passes()) {
            $supermaster = new Supermaster();
            $supermaster->ip = Input::get('ip');
            $supermaster->nameserver = Input::get('nameserver');
            $supermaster->account = Input::get('account');
            $saved = $supermaster->save();

            if (is_array($saved)) {
                return Redirect::to('/supermaster')
                    ->withSuccess('Supermaster added');
            } elseif($saved instanceof Supermaster) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('The supermaster (ip and hostname) exists');
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('Cant save the supermaster :/');
            }
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->errors()->all());
        }
    }

    public function getEdit()
    {

    }
}
