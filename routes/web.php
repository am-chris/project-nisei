<?php
Route::get('/', function () { return view('pages/home'); });
Route::get('/about', function() { return redirect('/about/netrunner'); });
Route::get('/about/netrunner', function () { return view('pages/about/netrunner'); });
Route::get('/about/nisei', function () { return view('pages/about/nisei'); });
// Route::get('/about/nisei', ['uses' => 'Web\AboutController@show', 'as' => 'render.about-nisei']);

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', function() { return redirect('/admin/home'); });
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('blogs', 'Admin\BlogsController');
    Route::post('blogs_mass_destroy', ['uses' => 'Admin\BlogsController@massDestroy', 'as' => 'blogs.mass_destroy']);
    Route::post('blogs_restore/{id}', ['uses' => 'Admin\BlogsController@restore', 'as' => 'blogs.restore']);
    Route::delete('blogs_perma_del/{id}', ['uses' => 'Admin\BlogsController@perma_del', 'as' => 'blogs.perma_del']);
    Route::resource('events', 'Admin\EventsController');
    Route::post('events_mass_destroy', ['uses' => 'Admin\EventsController@massDestroy', 'as' => 'events.mass_destroy']);
    Route::post('events_restore/{id}', ['uses' => 'Admin\EventsController@restore', 'as' => 'events.restore']);
    Route::delete('events_perma_del/{id}', ['uses' => 'Admin\EventsController@perma_del', 'as' => 'events.perma_del']);



 
});