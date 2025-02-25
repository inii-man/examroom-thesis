<?php
namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Models\User;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role.list|role.manage', ['only' => ['index', 'card']]);
         $this->middleware('permission:role.manage', ['only' => ['store','edit','update','destroy']]);
    }

    public function index()
    {
        $data['roles'] = Role::with(['users' => function($query){
            $query->select('name', 'profile_pic');
        }])->get();

        $data['permissions'] = Permission::all()->mapToGroups(function ($permission) {
            [$group, $action] = explode('.', $permission->name);
            return [$group => $action];
        });

        return view('roles.index', $data);
    }

    public function card(){
        $data['roles'] = Role::with(['users' => function($query){
            $query->select('name', 'profile_pic');
        }])->get();

        $data['permissions'] = Permission::all()->mapToGroups(function ($permission) {
            [$group, $action] = explode('.', $permission->name);
            return [$group => $action];
        });

        return view('roles.role-cards', $data);
    }

    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            return Response::success(null, 'Data successfully created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function edit(Role $role)
    {
        $role->load('permissions');
        
        return $role;
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            return Response::success(null, 'Data successfully updated!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function destroy(Role $role)
    {
        //
    }
}