<?php
namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user.list|user.manage', ['only' => ['index', 'show']]);
        $this->middleware('permission:user.manage', ['only' => ['store', 'edit', 'update', 'destroy', 'update_status']]);
    }

    public function index()
    {
        $data['users'] = User::all();
        $data['roles'] = Role::all();
        return view('users.index', $data);
    }

    public function list()
    {
        $users = new User();

        if (request()->has('status')) {
            $users = $users->where('status', request()->status);
        }

        if (request()->has('role')) {
            $users = $users->whereHas('roles', function ($query) {
                $query->where('name', request()->role);
            });
        }

        return datatables()
            ->of($users->get())
            ->addIndexColumn()
            ->editColumn('status', function ($user) {
                if ($user->status == 1) {
                    return '<span class="badge rounded-pill bg-label-success">Active</span>';
                } else {
                    return '<span class="badge rounded-pill bg-label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                if (auth()->user()->hasPermissionTo('user.manage')) {
                    $icon = $row->status ? 'ti-circle-x' : 'ti-circle-check';
                    $color = $row->status ? 'danger' : 'success';

                    $url = route('users.update-status', $row->id);

                    $btn = "<div class='d-flex justify-content-center'>
                        <a data-bs-toggle='modal' data-id='{$row->id}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'>
                            <i class='tf-icons ti ti-edit' ></i>
                        </a>
                        <a title='Activate' data-url='{$url}' data-function='afterUpdateStatus' class='update-status cursor-pointer mx-1  text-{$color}'>
                            <i class='tf-icons ti {$icon}'></i>
                        </a>
                    </div>";
                } else {
                    $btn = '<i>No Permission</i>';
                }

                return $btn;
            })
            ->addColumn('role', function ($user) {
                return $user->roles()->value('name');
            })
            ->editColumn('profile_pic', function ($user) {
                return "<img src='" . profilePicture($user) . "' class='rounded-circle' width='50' height='50'>";
            })
            ->rawColumns(['status', 'action', 'profile_pic'])
            ->make(true);
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();

            $request['password'] = bcrypt('password');
            $data = $request->validated();

            $user = User::create($data);

            $user->assignRole($request->role);
            DB::commit();
            return Response::success(null, 'Data successfully created!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function edit(User $user)
    {
        $user->role = $user->roles()->value('name');
        return $user;
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $validated = $request->validated();
            DB::beginTransaction();

            if ($request->password) {
                $validated['password'] = bcrypt($request->password);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);
            $user->syncRoles($request->role);
            DB::commit();
            return Response::success(null, 'Data successfully updated!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function update_status(string $id)
    {
        try {
            $data = User::where('id', $id)->first();
            if (!$data) {
                return Response::error(null, 'Data not found!');
            }

            $data->status = !$data->status;
            $data->save();

            return Response::success(null, 'Status successfully changed!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function destroy(User $user)
    {
        //
    }

    public function get_profile()
    {
        $profile = Auth::user();
        return view('profile.index', compact('profile'));
    }

    public function update_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $validatedData = $request->validate(
            [
                'email' => ['required', Rule::unique('users')->ignore($user->id), 'email'],
                'name' => ['required'],
                'profile_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'new_password' => ['nullable', 'confirmed', Password::min(6)],
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email is already taken',
                'email.email' => 'Email is not valid',
                'password.required' => 'Password is required',
                'password.confirmed' => 'Password confirmation is not match',
                'password.min' => 'Password must be at least 6 characters',
            ],
        );

        if (!$request->exists('confirm_password')) {
            return response()->json([
                'error' => false,
                'message' => 'Confirmation!',
                'view' => view('profile.modal')->render(),
            ]);
        } else {
            $request->validate([
                'confirm_password' => ['required', 'current_password'],
            ]);
        }

        try {
            if ($request->file('profile_pic')) {
                if ($user->profile_pic != null) {
                    if (File::exists(public_path('storage/' . $user->profile_pic))) {
                        File::delete(public_path('storage/' . $user->profile_pic));
                    }
                }
                $dir = '/profile';
                $name = 'profile_pic_' . auth()->user()->id . '.' . $request->file('profile_pic')->getClientOriginalExtension();

                $request->file('profile_pic')->storeAs($dir, $name, 'public');
                $validatedData['profile_pic'] = $name;
            }

            DB::beginTransaction();
            if (!empty($request->new_password)) {
                $validatedData['password'] = Hash::make($request->new_password);
            }
            $user->update($validatedData);
            DB::commit();
            return Response::success(null, 'Data successfully updated!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function deactivate_profile()
    {
        $user = Auth::user();
        $user->status = 0;
        $user->save();
        Auth::logout();
        return redirect('/');
    }
}
