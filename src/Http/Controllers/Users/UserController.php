<?php

namespace Iboinas\Backoffice\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Iboinas\Backoffice\Http\Requests\Roles\RolePermissionManageRequest;
use Iboinas\Backoffice\Http\Requests\Users\StoreUserRequest;
use \Sentinel, \Input;


class UserController extends Controller
{

    public function __construct( )
    {
        $this->middleware('backoffice.anyaccess:superuser');

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = Sentinel::getUserRepository()->all();

        return view('Backoffice::users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('Backoffice::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        $save = Sentinel::registerAndActivate(Input::all());

        if($save)
        {
            \Session::flash('message','Successfully added!');
            return redirect(route('backoffice.users.index'));
        }
        else
        {
            \Session::flash('error','Error while saving!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Sentinel::findById($id);
        return view('Backoffice::users.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function managePermissions( RolePermissionManageRequest $request, $id, $action, $permission = null)
    {

        switch ($action){

            case 'add':
                if (\Input::get('permission_type') == 'true') $perm_type = true;
                    else $perm_type = false;
                $role = Sentinel::findById($id);
                $sucess = $role->updatePermission( \Input::get('name'), $perm_type, true)->save();
                $message = 'Permission added sucessfully!';
                break;

            case 'true':
                $role = Sentinel::findById($id);
                $sucess = $role->updatePermission( $permission , true , true)->save();
                $message = 'Permission TRUE applied sucessfully!';
                break;

            case 'false':
                $role = Sentinel::findById($id);
                $sucess = $role->updatePermission( $permission , false , true)->save();
                $message = 'Permission FALSE applied sucessfully!';
                break;

            case 'delete':
                $role = Sentinel::findById($id);
                $sucess = $role->removePermission($permission)->save();
                $message = 'Permission deleted sucessfully!';
                break;

            default:
                $sucess = false;
        }

        if ($sucess)
        {
            \Session::flash('message', $message);
            return back();
        }

        else
        {
            \Session::flash('notice','Error while saving!');
            return back();
        }



    }
}
