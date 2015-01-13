<?php

class DashboardController extends BaseController
{
    public function getIndex()
    {
        $domains = Domain::all();

        return View::make('dashboard.index')
            ->withDomains($domains);
    }
}
