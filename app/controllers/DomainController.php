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
}
