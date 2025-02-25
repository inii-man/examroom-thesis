<?php

namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use App\Http\Requests\ShipRequest;
use App\Models\Ship;


class ShipController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ship.list|ship.manage', ['only' => ['index', 'show']]);
        $this->middleware('permission:ship.manage', ['only' => ['store', 'edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $list = $this->list();
        return view(
            'ships.index',
            [
                'list' => $list
            ]
        );
    }

    public function list()
    {
        $ships = new Ship;

        if (request()->has('status')) {
            $ships = $ships->where('status', request()->status);
        }

        return $ships->get();

        // return datatables()->of($ships->get())
        //     ->addIndexColumn()
        //     ->editColumn('status', function ($ship) {
        //         if ($ship->status == 1) {
        //             return '<span class="badge rounded-pill bg-label-success">Active</span>';
        //         } else {
        //             return '<span class="badge rounded-pill bg-label-danger">Inactive</span>';
        //         }
        //     })
        //     ->addColumn('action', function ($row) {
        //         if (auth()->user()->hasPermissionTo('ship.manage')) {
        //             $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
        //             $color = ($row->status) ? "danger" : "success";

        //             $url = route('ships.update-status', $row->ship_id);

        //             $btn = "<div class='d-flex justfiy-content-center'>
        //                 <a data-bs-toggle='modal' data-id='{$row->ship_id}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'>
        //                     <i class='tf-icons ti ti-edit' ></i>
        //                 </a>
        //                 <a title='Activate' data-url='{$url}' data-function='afterUpdateStatus' class='update-status cursor-pointer mx-1  text-{$color}'>
        //                     <i class='tf-icons ti {$icon}'></i>
        //                 </a>
        //             </div>";
        //         } else {
        //             $btn = "<i>No Permission</i>";
        //         }

        //         return $btn;
        //     })
        //     ->rawColumns(['status', 'action'])
        //     ->make(true);
    }

    public function store(ShipRequest $request)
    {
        try {
            DB::beginTransaction();
            $ship = Ship::create($request->all());
            DB::commit();
            return Response::success(null, 'Data successfully created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function edit(Ship $ship)
    {
        return $ship;
    }

    public function update(ShipRequest $request, Ship $ship)
    {
        try {
            DB::beginTransaction();
            $ship->update($request->all());
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
            $data = Ship::where('ship_id', $id)->first();
            if (!$data) return Response::error(null, 'Data not found!');

            $data->status = !$data->status;
            $data->save();

            return Response::success(null, 'Status successfully changed!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function destroy(Ship $ship)
    {
        //
    }
}
