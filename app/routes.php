<?php

Route::group(array('before' => ['auth']), function () {
    Route::controller('dashboard', 'DashboardController');
    Route::controller('users', 'UsersController');
    Route::controller('user', 'UserController');
});

Route::controller('/', 'IndexController');
