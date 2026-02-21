<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
		

        return view('roles.index', compact('roles'));

    }
	public function edit(Request $request)
    {
		
        $roles = Role::where('id', $request->id)->first();
		if($request->permissions){
			foreach($request->permissions as $p){
				$permission_already_exists = DB::select("SELECT * from role_has_permissions where role_id = '".$request->id."' and permission_id = '".$p."'"); 
				if(empty($permission_already_exists)){
					$insert =DB::insert('insert into role_has_permissions (role_id, permission_id) values ("'.$request->id.'","'.$p.'")');
				}
			}
		}
		$permissions = DB::select("SELECT permissions.*, role_has_permissions.permission_id FROM permissions LEFT JOIN role_has_permissions ON permissions.id = role_has_permissions.permission_id and role_has_permissions.role_id='".$request->id."' "); 
		return view('roles.edit', compact('roles','permissions'));

    }
	
	public function create(Request $request)
    {
		if($request->permissions && $request->role){
			$insert =DB::insert('insert into roles (name, guard_name) values ("'.$request->role.'","web")');
			$role_id =DB::select('Select id from roles where name ="'.$request->role.'"');
			foreach($request->permissions as $p){
				$insert =DB::insert('insert into role_has_permissions (role_id, permission_id) values ("'.$role_id[0]->id.'","'.$p.'")');
				
			}
			$roles = Role::all();
			 return view('roles.index', compact('roles'));
		}
        $permissions = DB::select("SELECT permissions.* FROM permissions "); 
        return view('roles.create', compact('permissions'));

    }

    
}
