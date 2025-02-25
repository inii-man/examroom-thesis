<?php

namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use App\Http\Requests\BranchRequest;
use App\Models\Branch;


class BranchController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:branch.list|branch.manage', ['only' => ['index','show']]);
         $this->middleware('permission:branch.manage', ['only' => ['store','edit','update','destroy']]);
    }

    public function index()
    {
        return view('branches.index');
    }

    public function list()
    {
        $branches = new Branch;

        if(request()->has('status')){
            $branches = $branches->where('status', request()->status);
        }

        return datatables()->of($branches->get())
            ->addIndexColumn()
            ->editColumn('status', function ($branch) {
                if ($branch->status == 1) {
                    return '<span class="badge rounded-pill bg-label-success">Active</span>';
                } else {
                    return '<span class="badge rounded-pill bg-label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                if(auth()->user()->hasPermissionTo('branch.manage')){
                    $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                    $color = ($row->status) ? "danger" : "success";
                    
                    $url = route('branches.update-status', $row->branch_id);

                    $btn = "<div class='d-flex justfiy-content-center'>
                        <a data-bs-toggle='modal' data-id='{$row->branch_id}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'>
                            <i class='tf-icons ti ti-edit' ></i>
                        </a>
                        <a title='Activate' data-url='{$url}' data-function='afterUpdateStatus' class='update-status cursor-pointer mx-1  text-{$color}'>
                            <i class='tf-icons ti {$icon}'></i>
                        </a>
                    </div>";
                } else {
                    $btn = "<i>No Permission</i>";
                }

                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store(BranchRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach($request->data as $data) {
                Branch::create($data);
            }
            DB::commit();
            return Response::success(null, 'Data successfully created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function edit(Branch $branch)
    {
        return $branch;
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        try {
            DB::beginTransaction();
            foreach($request->data as $data) {
                $branch->update($data);
            }
            DB::commit();
            return Response::success(null, 'Data successfully updated!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function update_status(string $id)
    {
        try {
            $data = Branch::where('branch_id', $id)->first();
            if (!$data) return Response::error(null, 'Data not found!');

            $data->status = !$data->status;
            $data->save();

            return Response::success(null, 'Status successfully changed!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
    
    public function destroy(Branch $branch)
    {
        //
    }
}