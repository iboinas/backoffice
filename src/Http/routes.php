<?php


Route::get('test',function ()
{
    dd("test closure");
});


Route::get('test-ctl','Iboinas\Backoffice\Http\Controllers\TestController@index');