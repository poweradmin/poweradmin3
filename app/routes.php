<?php

Route::group(array('before' => ['auth']), function () {
    Route::controller('dashboard', 'DashboardController');
    Route::controller('users', 'UsersController');
    Route::controller('user', 'UserController');
    Route::controller('supermaster', 'SupermasterController');
    Route::controller('zones', 'ZonesController');
    Route::controller('domain', 'DomainController');
});

Route::controller('/', 'IndexController');
