<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Pages - Guest

Route::group(['prefix' => '/'], function () {
    Route::get('/', [
        'uses' => 'PagesGuestController@index',
        'as' => 'pages-guest.index'
    ]);

    Route::get('/list', [
        'uses' => 'PagesGuestController@listPages',
        'as' => 'pages-guest.list-pages'
    ]);

    Route::get('/page/{page}', [
        'uses' => 'PagesGuestController@show',
        'as' => 'pages-guest.show'
    ]);

    Route::post('/subpage/contact/send_email', [
        'uses' => 'PagesGuestController@sendEmail',
        'as' => 'pages-guest.send-email'
    ]);

    Route::post('/subpage/contact/get_subpage_by_id', [
        'uses' => 'PagesGuestController@getSubpageById',
        'as' => 'pages-guest.send-email'
    ]);
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [
        'uses' => 'PagesAdminController@index',
        'as' => 'pages-admin.index'
    ]);
});

Route::group(['prefix' => 'admin/page'], function () {
    Route::get('/create', [
        'uses' => 'PagesAdminController@create',
        'as' => 'pages-admin.create'
    ]);

    Route::post('/store', [
        'uses' => 'PagesAdminController@save',
        'as' => 'pages-admin.save'
    ]);

    Route::get('/edit/{page}', [
        'uses' => 'PagesAdminController@edit',
        'as' => 'pages-admin.edit'
    ]);

    Route::put('/{page}', [
        'uses' => 'PagesAdminController@update',
        'as' => 'pages-admin.update'
    ]);

    Route::delete('/{page}', [
        'uses' => 'PagesAdminController@destroy',
        'as' => 'pages-admin.destroy'
    ]);

    Route::get('/{page}', [
        'uses' => 'PagesAdminController@show',
        'as' => 'pages-admin.show'
    ]);
});

Route::group(['prefix' => 'admin/subpage'], function () {
    Route::get('/{page}/create', [
        'uses' => 'SubpagesAdminController@create',
        'as' => 'subpages-admin.create'
    ]);

    Route::post('/{page}/store', [
        'uses' => 'SubpagesAdminController@store',
        'as' => 'subpages-admin.store'
    ]);

    Route::get('/edit/{subpage}', [
        'uses' => 'SubpagesAdminController@edit',
        'as' => 'subpages-admin.edit'
    ]);

    Route::put('/{subpage}', [
        'uses' => 'SubpagesAdminController@update',
        'as' => 'subpages-admin.update'
    ]);

    Route::delete('/{subpage}', [
        'uses' => 'SubpagesAdminController@destroy',
        'as' => 'subpages-admin.destroy'
    ]);

    Route::post('/update_order', [
        'uses' => 'SubpagesAdminController@updateOrder',
        'as' => 'subpages-admin.update-order'
    ]);

    Route::get('/get_bibtex_files_list', [
        'uses' => 'SubpagesAdminController@getBibtexFilesList',
        'as' => 'subpages-admin.get-bibtex-files-list'
    ]);

    Route::get('/get_bibtex_content_from_file', [
        'uses' => 'SubpagesAdminController@getBibtexContentFromFile',
        'as' => 'subpages-admin.get-bibtex-content-from-file'
    ]);

    Route::get('/get_subpages_by_page_id', [
        'uses' => 'SubpagesAdminController@getSubpagesByPageId',
        'as' => 'subpages-admin.get-subpages-by-page-id'
    ]);

    Route::get('/test', [
        'uses' => 'SubpagesAdminController@test',
        'as' => 'subpages-admin.test'
    ]);
});

Route::group(['prefix' => 'admin/settings'], function () {
    Route::get('/', [
        'uses' => 'SettingsAdminController@index',
        'as' => 'settings-admin.index'
    ]);

    Route::put('/', [
        'uses' => 'SettingsAdminController@update',
        'as' => 'settings-admin.update'
    ]);
});

Route::group(['prefix' => 'admin/menu'], function () {
    Route::get('/', [
        'uses' => 'MenuAdminController@index',
        'as' => 'menu-admin.index'
    ]);

    Route::get('/create', [
        'uses' => 'MenuAdminController@create',
        'as' => 'menu-admin.create'
    ]);

    Route::post('/store', [
        'uses' => 'MenuAdminController@store',
        'as' => 'menu-admin.store'
    ]);

    Route::get('/edit/{menuLink}', [
        'uses' => 'MenuAdminController@edit',
        'as' => 'menu-admin.edit'
    ]);

    Route::put('/{menuLink}', [
        'uses' => 'MenuAdminController@update',
        'as' => 'menu-admin.update'
    ]);

    Route::delete('/{menuLink}', [
        'uses' => 'MenuAdminController@destroy',
        'as' => 'menu-admin.destroy'
    ]);

    Route::post('/update_order', [
        'uses' => 'MenuAdminController@updateOrder',
        'as' => 'menu-admin.update-order'
    ]);
});

Route::group(['prefix' => 'admin/upload'], function () {
    Route::get('/', [
        'uses' => 'UploadAdminController@index',
        'as' => 'upload-admin.index'
    ]);

    Route::get('/create', [
        'uses' => 'UploadAdminController@create',
        'as' => 'upload-admin.create'
    ]);

    Route::post('/store', [
        'uses' => 'UploadAdminController@storeFile',
        'as' => 'upload-admin.store-file'
    ]);

    Route::get('/edit/{file}', [
        'uses' => 'UploadAdminController@edit',
        'as' => 'upload-admin.edit'
    ]);

    Route::put('/{file}', [
        'uses' => 'UploadAdminController@update',
        'as' => 'upload-admin.update'
    ]);

    Route::delete('/{file}', [
        'uses' => 'UploadAdminController@destroy',
        'as' => 'upload-admin.destroy'
    ]);
});

Route::group(['prefix' => 'admin/user_settings'], function () {
    Route::get('/', [
        'uses' => 'UserSettingsAdminController@index',
        'as' => 'user-settings-admin.index'
    ]);

    Route::put('/change_password', [
        'uses' => 'UserSettingsAdminController@changePassword',
        'as' => 'user-settings-admin.change-password'
    ]);

    Route::put('/change_name', [
        'uses' => 'UserSettingsAdminController@changeName',
        'as' => 'user-settings-admin.change-name'
    ]);
});

Route::group(['prefix' => 'admin/users'], function () {
    Route::get('/', [
        'uses' => 'UsersAdminController@index',
        'as' => 'users-admin.index'
    ]);

    Route::get('/edit/{user}', [
        'uses' => 'UsersAdminController@edit',
        'as' => 'users-admin.edit'
    ]);

    Route::put('/{user}', [
        'uses' => 'UsersAdminController@update',
        'as' => 'users-admin.update'
    ]);

    Route::delete('/{user}', [
        'uses' => 'UsersAdminController@destroy',
        'as' => 'users-admin.destroy'
    ]);
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::get('/home', 'HomeController@index')->name('home');