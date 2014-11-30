<?php

class UsersController extends BaseController
{
    public function getIndex()
    {
        $userRepo = App::make('UserRepository');

        $users = $userRepo->getAll();

        return View::make('users.index')
            ->withUsers($users);
    }
}
