<?php



Route::group( [ 'prefix' => 'backoffice' , 'namespace' => 'Iboinas\Backoffice\Http\Controllers' ] , function(){


    Route::get('/', [ 'as' => 'backoffice.home', 'uses' => 'WelcomeController@index']  );

    Route::get('/welcome', [ 'as' => 'backoffice.welcome', 'uses' => 'WelcomeController@welcome']  );

    Route::get('/reg', function ()
    {
        echo Sentinel::registerAndActivate([
            'email'         => 'iboinas@gmail.com',
            'password'      => 'sentinel',
            'permissions'   => [ 'admin' => true ]
        ]);
    });


    Route::get('login', [ 'as' => 'backoffice.login', 'uses' => 'Authority\AuthoritySessionController@login']  );
    Route::post('login', [ 'as' => 'backoffice.authenticate', 'uses' => 'Authority\AuthoritySessionController@authenticate']  );
    Route::get('logout', [ 'as' => 'backoffice.logout' , 'uses' => 'Authority\AuthoritySessionController@logout' ] );

    Route::resource('role','RoleController');
    Route::any('role/{id}/permission/{action}/{permission?}', [ 'as' => 'backoffice.role.permission.manage', 'uses' => 'RoleController@managePermissions']  );

    Route::resource('user','UserController');

});

