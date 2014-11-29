<?php

Route::group(array('before' => ['auth']), function() {
    Route::controller('dashboard', 'DashboardController');
});

Route::controller('/', 'IndexController');
