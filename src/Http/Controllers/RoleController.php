<?php

namespace Iboinas\Backoffice\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Sentinel;
use \Iboinas\Backoffice\Http\Requests\Roles\RolePermissionManageRequest;



class RoleController extends Controller
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
        $roles = Sentinel::getRoleRepository()->all();

        return view('Backoffice::roles.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role = Sentinel::getRoleRepository()->findById($id);
        return view('Backoffice::roles.show')->with('role',$role);
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
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( \Input::get('name') , \Input::get('permission_type'), true)->save();
                break;

            case 'true':
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( $permission , 'true' , true)->save();
                break;

            case 'false':
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( $permission , 'false' , true)->save();
                break;

            case 'delete':
                $role = Sentinel::findRoleById($id);
                $sucess = $role->removePermission($permission)->save();
                break;

            default:
                $sucess = false;
        }

        if ($sucess)
        {
            \Session::flash('message','Permission added sucessfully!');
            return back();
        }

        else
        {
            \Session::flash('notice','Error while saving!');
            return back();
        }



    }
}
