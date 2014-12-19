<?php

class ZonesController extends BaseController
{
    public function getAddSlave()
    {
        $domain = new Domain();
        $usersList = User::all()->lists('username', 'username');

        return View::make('zones.edit')
            ->withDomain($domain)
            ->with('usersList', $usersList);
    }

    public function postAddSlave()
    {
        $post = Input::all();

        $validator = Validator::make($post, Domain::$createSlaveRules);

        if ($validator->passes()) {
            $domain = new Domain();
            $domain->name = $post['name'];
            if (!empty($post['master'])) {
                $domain->master = $post['master'];
            }
            $domain->type = 'SLAVE';
            $domain->account = $post['account'];
            $saved = $domain->save();

            if ($saved === true) {
                return Redirect::to('/dashboard')
                    ->withSuccess('Slave zone added');
            } elseif ($saved instanceof Domain) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('The slave zone (ip and hostname) exists');
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('Cant save the slave zone :/');
            }
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->errors()->all());
        }
    }

}
