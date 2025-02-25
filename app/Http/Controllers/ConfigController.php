<?php

namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use Illuminate\Support\Facades\File;
use App\Models\Config;

class ConfigController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:config.list|config.manage', ['only' => ['index']]);
        $this->middleware('permission:config.manage', ['only' => ['store', 'reset']]);
    }

    public function index()
    {
        return view('config.index');
    }

    public function store(Request $request)
    {
        $validate = $this->validate(
            $request,
            [
                'app_name' => 'required',
                'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'sidebar_name' => 'required',
                'sidebar_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'primary_hex' => 'required',
            ],
            [
                'app_name.required' => 'App name is required!',
                'app_logo.image' => 'App logo must be an image!',
                'app_logo.mimes' => 'App logo must be a file of type: jpeg, png, jpg, svg!',
                'app_logo.max' => 'App logo may not be greater than 2048 kilobytes!',
                'sidebar_name.required' => 'Sidebar name is required!',
                'sidebar_logo.image' => 'Sidebar logo must be an image!',
                'sidebar_logo.mimes' => 'Sidebar logo must be a file of type: jpeg, png, jpg, svg!',
                'sidebar_logo.max' => 'Sidebar logo may not be greater than 2048 kilobytes!',
                'primary_hex.required' => 'Primary hex is required!',
            ]
        );

        if (!$validate) {
            return Response::errorValidate($validate, 'Validation error!', 422);
        }

        try {
            DB::beginTransaction();
            $data = $request->only('app_home', 'app_name', 'app_logo', 'sidebar_name', 'sidebar_logo', 'primary_hex', 'login_bg', 'login_bg_style', 'show_dummy');
            foreach ($data  as $key => $value) {
                if (in_array($key, ['app_logo', 'sidebar_logo', 'login_bg'])) {
                    if ($request->file($key)) {
                        $file = Config::where('config_name', $key)->first();
                        if ($file != null && File::exists($file->config_value)) {
                            File::delete($file);
                        }
                        $dir = 'config';
                        $name = $key . '.' . $request->file($key)->getClientOriginalExtension();

                        $request->file($key)->move($dir, $name);
                        $value = $dir . '/' . $name;
                    }
                }
                Config::updateOrCreate(['config_name' => $key], ['config_value' => $value]);
            }
            DB::commit();
            return Response::success(null, 'Config successfully changed!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function reset(Request $request)
    {
        try {
            DB::beginTransaction();
            $config = Config::all();
            foreach ($config as $key => $value) {
                if ($value->config_name == 'app_logo' || $value->config_name == 'sidebar_logo') {
                    if (File::exists($value->config_value)) {
                        File::delete($value->config_value);
                    }
                }
                $value->delete();
            }
            DB::commit();
            return Response::success(null, 'Config successfully reset!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }
}
