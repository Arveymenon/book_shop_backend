<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserManagementController extends Controller
{
    // Users Section
    public function view(){
        $inject['title'] = 'User Management';

        $inject['roles'] = Role::all();

        return view('pages.user-management.users',$inject);
    }

    public function usersDatatable(){
        $users = User::with('roles');
        // dd($users);
        try {
            return datatables()->of($users)
            ->editColumn('roles', function($query){
                $roles = '';
                foreach($query->roles as $key => $role){
                    $roles = $roles.($key+1).') '.$role->name.'<br>';
                }
                return $roles;
            })
            ->addColumn('edit', function($user){
                return '<button type="button" class="c-btn c-btn--info" data-toggle="modal" onclick="edit('.$user->id.')" data-target="#create-user">Edit </button>';
            })
            ->rawColumns(['edit'])
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function updateUser(Request $request){
        return ($request);
    }

    public function getUser($id){
        $role = User::where('id',$id)->with(['roles' => function ($query){
            $query->select('id');
        }])->first();

        return \Response::json([
            'error' => false,
            'response' => $role
            ]);
    }


    // Roles Section
    public function rolesView(){
        $inject['title'] = 'Roles Management';

        $inject['permissions'] = Permission::all();

        return view('pages.user-management.roles',$inject);
    }

    public function rolesDatatable(){
        $roles = Role::with('permissions')->get();
        // dd($users);
        try {
            return datatables()->of($roles)
            ->editColumn('permissions', function($query){
                $permissions = '';
                foreach($query->permissions as $key => $permission){
                    $permissions = $permissions.($key+1).') '.$permission->name.'<br>';
                }
                return $permissions;
            })
            ->addColumn('edit', function($user){
                return '<button type="button" class="c-btn c-btn--info" data-toggle="modal" onclick="edit('.$user->id.')" data-target="#create-user">Edit</button>';
            })
            ->rawColumns(['permissions','edit'])
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function getRole($id){
        $role = Role::where('id',$id)->with(['permissions' => function ($query){
            $query->select('id');
        }])->first();

        return \Response::json([
            'error' => false,
            'response' => $role
            ]);
    }

    public function updateRole(Request $request){
        $role = Role::firstOrNew(['id' => $request['role_id']]);
        $role->name = $request['role'];
        $role->guard_name = "web";
        $role->save();

        $permissions = Permission::whereIn('id',$request['permissions'])->get();
        if($role->exists){
            $role_with_old_permissions = Role::where('id',$role->id)->with('permissions')->first();
            foreach($role_with_old_permissions->permissions as $permission){
                $role->revokePermissionTo($permission->name);
            }
            // $role_with_old_permissions->permissions->delete();
        }
        $role->givePermissionTo($permissions);
        return redirect()->back();

    }
}
