<?php

namespace Iboinas\Backoffice\Http\Controllers\Authority;

use App\Http\Controllers\Controller;

use Iboinas\Backoffice\Http\Requests\Authority\LoginRequest;

use \Sentinel;

class AuthoritySessionController extends Controller
{



    /**
     * Displays the form for account creation
     */
    public function login()
    {
        return view('Backoffice::authority.login');
    }



    /**
     * Receive the request with credentials, and try to authenticate
     */
    public function authenticate(LoginRequest $request)
    {

        $data = $request->input();

        if ( isset($data['remember']) && $data['remember'] == 'on') $remember = true;
            else $remember = false;

        $credentials['password'] = e($data['password']);
        $credentials['email']    = isset($data['email']) ? e($data['email']) : '';

        try
        {
            $try_login = Sentinel::authenticate($credentials, $remember);
        }
        catch (\RuntimeException $e)
        {
            return back()->withErrors($e->getMessage());
        }


        if ($try_login) return redirect(route('backoffice.welcome'));

        else return back()->withErrors('Incorrect credentials!');

    }


    /**
     * Logs out the user
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect(route('backoffice.home'));
    }







    /**
     * Validate an email address
     * http://stackoverflow.com/questions/12026842/how-to-validate-an-email-address-in-php
     */
    private function validEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}
