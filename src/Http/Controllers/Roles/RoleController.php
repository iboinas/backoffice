<?php

namespace Iboinas\Backoffice\Http\Controllers\Roles;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Iboinas\Backoffice\Http\Requests\Roles\RolePermissionManageRequest;
use Iboinas\Backoffice\Http\Requests\Roles\StoreRoleRequest;
use \Sentinel, \Input;


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
        return view('Backoffice::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = Input::all();
        $data['slug'] = \Slugify::slugify($data['name']);
        $save = Sentinel::getRoleRepository()->create($data);
        if($save)
        {
            \Session::flash('message','Successfully added!');
            return redirect(route('backoffice.role.index'));
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
                if (\Input::get('permission_type') == 'true') $perm_type = true;
                    else $perm_type = false;
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( \Input::get('name'), $perm_type, true)->save();
                $message = 'Permission added sucessfully!';
                break;

            case 'true':
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( $permission , true , true)->save();
                $message = 'Permission TRUE applied sucessfully!';
                break;

            case 'false':
                $role = Sentinel::findRoleById($id);
                $sucess = $role->updatePermission( $permission , false , true)->save();
                $message = 'Permission FALSE applied sucessfully!';
                break;

            case 'delete':
                $role = Sentinel::findRoleById($id);
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
