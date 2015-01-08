<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    //
});

App::after(function ($request, $response) {
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::guest('/');
        }
    }
});

Route::filter('auth.basic', function () {
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) {
        return Redirect::to('/');
    }
});

/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/
Entrust::routeNeedsPermission('users*', ['user_view_others'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/edit*', ['user_edit_others'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/add*', ['user_add_new'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/delete*', ['user_edit_others'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/roles*', ['user_edit_templ_perm'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/role*', ['user_edit_others'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('users/add-role*', ['templ_perm_edit'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('supermaster*', ['supermaster_view'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('supermaster/add*', ['supermaster_add'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('supermaster/edit*', ['supermaster_edit'], Redirect::to('/dashboard'));
Entrust::routeNeedsPermission('zones*', ['zone_master_add'], Redirect::to('/dashboard'));

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() !== Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException();
    }
});
