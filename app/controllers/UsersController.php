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

    public function getAdd()
    {
        return View::make('users.add');
    }

    public function postAdd()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::to('/users')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::back()
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }

    public function getRoles()
    {
        $roleRepo = App::make('RoleRepository');

        $roles = $roleRepo->getAll();

        return View::make('users.roles')
            ->withRoles($roles);
    }

    public function getRole($id)
    {
        $role = Role::findOrFail($id);

        $permissionRepo = App::make('PermissionRepository');

        $permissions = $permissionRepo->getAll();

        return View::make('users.role')
            ->withPermissions($permissions)
            ->withRole($role)
            ->with('rolePermissions', $role->permissions()->lists('permission_id'));
    }

    public function postRole($id)
    {
        $role = Role::findOrFail($id);

        $role->permissions()->detach();
        $role->permissions()->attach(array_keys(Input::get('perm')));

        return Redirect::to('users/roles')
            ->withSuccess('Roles changed');
    }

}
