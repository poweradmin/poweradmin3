<?php

class DomainController extends BaseController
{
    public function getDelete($id)
    {
        /** @var DomainRepository $domainRepo */
        $domainRepo = App::make('DomainRepository');

        $deletedDomain = $domainRepo->deleteDomain($id);

        if ($deletedDomain) {
            return Redirect::back()
                ->withSuccess('Domain deleted');
        } else {
            return Redirect::back()
                ->withErrors('You cant delete the domain');
        }
    }

    public function getEdit($id)
    {
        /** @var DomainRepository $domainRepo */
        $domainRepo = App::make('DomainRepository');

        $domain = $domainRepo->getDomain($id);

        if ($domain === false) {
            return Redirect::back()
                ->withErrors('You cant edit the domain');
        }

        return View::make('domain.edit')
            ->withDomain($domain);
    }

    public function postEdit($id)
    {
        /** @var DomainRepository $domainRepo */
        $domainRepo = App::make('DomainRepository');

        $editedDomain = $domainRepo->editDomain($id, Input::all());

        if ($editedDomain) {
            return Redirect::to('/dashboard')
                ->withSuccess('Domain edited');
        } else {
            return Redirect::back()
                ->withErrors('You cant edit the domain');
        }
    }
}
