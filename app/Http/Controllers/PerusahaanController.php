<?php

namespace App\Http\Controllers;

//Controller Import
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Response;
use Exception;

//Additional Import
use App\Http\Requests\LightHouseRequest;
use App\Models\LightHouse;
use App\Models\Perusahaan;

class PerusahaanController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:light_house.list|light_house.manage', ['only' => ['index', 'show']]);
        // $this->middleware('permission:light_house.manage', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $data = $this->createEditData();
        $list = $this->list();
        $data['list'] = $list;
        return view('perusahaan.index', $data);
    }

    public function detail_perusahaan()
    {
        $data = $this->createEditData();
        $list = $this->list();
        $data['active_menu'] = 'detail_perusahaan';
        $data['list'] = $list;
        return view('perusahaan.detail-perusahaan', $data);
    }

    public function detail_departemen()
    {
        $data = $this->createEditData();
        $list = $this->list();
        $data['active_menu'] = 'detail_departemen';
        $data['list'] = $list;
        return view('perusahaan.detail-departemen', $data);
    }

    public function list()
    {
        $perusahaan = new Perusahaan();

        return datatables()->of($perusahaan->get())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $url = route('perusahaan.update-status', $row->id);

                $btn = "<div class='d-flex justfiy-content-center'>
                        <a href='" . route('perusahaan.edit', $row->id) . "' class='cursor-pointer mx-1 text-warning'>
                            <i class='tf-icons ti ti-edit' ></i>
                        </a>
                    </div>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $data = $this->createEditData();
        return view('perusahaan.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            Perusahaan::create($request->all());
            DB::commit();
            return Response::success(null, 'Data successfully created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::errorCatch($th);
        }
    }

    public function edit(LightHouse $light_house)
    {
        $data = $this->createEditData();
        $data['light_house'] = $light_house;
        return view('perusahaan.create', $data);
    }

    public function update(Perusahaan $request, Perusahaan $perusahaan)
    {
        try {
            DB::beginTransaction();
            // $perusahaan->update($request->all());
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
            $data = LightHouse::where('light_house_id', $id)->first();
            if (!$data) return Response::error(null, 'Data not found!');

            $data->status = !$data->status;
            $data->save();

            return Response::success(null, 'Status successfully changed!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function destroy(LightHouse $light_house)
    {
        //
    }

    private function createEditData()
    {
        $data = [
            'light_house_structure' => [
                'Round',
                'Pyramidal',
                'Skeletal',
                'Conical',
                'Square/Integral',
            ],
        ];

        return $data;
    }
}
