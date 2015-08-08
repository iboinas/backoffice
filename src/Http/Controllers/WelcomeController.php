<?php

namespace Iboinas\Backoffice\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Sentinel;
use Iboinas\Backoffice\Http\Requests\Authority\AuthorityRequest;

class WelcomeController extends Controller
{


    public function __construct( )
    {
        $this->middleware('backoffice.anyaccess:superuser',['except' => 'index']);

    }


    /**
     * Root access makes the decision to go to welcome route, or if not logged in, go to login
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {

        if ( !Sentinel::check() ) return redirect(route('backoffice.login'));

        else return redirect(route('backoffice.welcome'));


    }



    public function welcome()
    {
        return view('Backoffice::welcome.welcome');
    }






}
