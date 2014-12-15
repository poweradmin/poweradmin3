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

    public function getEdit($userId)
    {
        $user = User::findOrFail($userId);

        $roleRepo = App::make('RoleRepository');
        $roles = $roleRepo->getAll()->lists('name', 'id');

        return View::make('users.edit')
            ->withUser($user)
            ->withRoles($roles);
    }

    public function postEdit($userId)
    {
        $user = User::findOrFail($userId);

        $user->detachAllRoles();
        $permissions = Input::get('permission', []);
        foreach($permissions as $permission) {
            $user->attachRole($permission);
        }

        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->description = Input::get('description');
        $user->confirmed = Input::get('confirmed', 0);
        if (Input::has('password') && Input::has('password_confirmation')) {
            $user->password = Input::get('password');
            $user->password_confirmation = Input::get('password_confirmation');
        }
        $edited = $user->save();

        if ($edited) {
            return Redirect::to('users')
                ->withSuccess('User changed');
        }
        else {
            return Redirect::back()
                ->withInput()
                ->withErrors($user->errors()->all());
        }
    }

    public function getAdd()
    {
        $user = new User();

        $roleRepo = App::make('RoleRepository');
        $roles = $roleRepo->getAll()->lists('name', 'id');

        return View::make('users.edit')
            ->withUser($user)
            ->withRoles($roles);
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
        if (Input::get('perm', []) != []) {
            $role->permissions()->attach(array_keys(Input::get('perm', [])));
        }

        return Redirect::to('users/roles')
            ->withSuccess('Roles changed');
    }

    public function getAddRole()
    {
        $permissionRepo = App::make('PermissionRepository');

        $permissions = $permissionRepo->getAll();

        return View::make('users.add-role')
            ->withPermissions($permissions);
    }

    public function postAddRole()
    {
        $role = new Role();

        if ($role->validation(Input::all(), Role::$createRules)) {
            $role->name = Input::get('name');
            $role->description = Input::get('description');
            $role->save();

            if (Input::get('perm', []) != []) {
                $role->permissions()->attach(array_keys(Input::get('perm', [])));
            }

            return Redirect::to('users/roles')
                ->withSuccess('Roles changed');
        }

        $errors = $role->errors();

        return Redirect::back()
            ->withInput()
            ->withErrors($errors->all());
    }
}
