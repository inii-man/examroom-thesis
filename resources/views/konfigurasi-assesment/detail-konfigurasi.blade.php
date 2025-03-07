@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row mb-4">
        {{-- <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0"></h4>
        </div> --}}
        {{-- <div class="col-md-2 col-12 text-end">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-add"><i
                    class="tf-icons me-3 ti ti-plus"></i>Departemen</button>
        </div> --}}
    </div>
    <div class="card" style="border: 0.5px solid; 
        border-radius: 5px;">
        <div class="card-header" style="border-bottom: 0.5px solid">
            <h4 class="fw-bold mb-0">Tambah Asesmen</h4>
        </div>
        <div class="card-body mt-5">
            <div class="card" style="border-bottom: 0.5px solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3 form-group">
                            <label for="ship_name" class="form-label">Nama Asessmen</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Nama Asessmen" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-4 mb-3 form-group">
                            <label for="ship_name" class="form-label">Pertanyaan yang digunakan</label>
                            <select type="text" id="ship_name" data-placeholder="Pertanyaan yang digunakan" name="ship_name" class="select2 form-control"
                                placeholder="Pertanyaan yang digunakan">
                                <option value="" disabled selected></option>
                                <option value="1">Pertanyaan 1</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-4 mb-3 form-group">
                            <label for="ship_name" class="form-label">Tingkat kemahiran pertanyaan</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Tingkat kemahiran pertanyaan" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 form-group">
                            <label for="ship_name" class="form-label">Batas Rating Penilaian Peserta</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Batas Rating Penilaian Peserta" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 form-group">
                            <label for="ship_name" class="form-label">Batas Rating Penilaian Asesor</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Batas Rating Penilaian Asesor" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 form-group">
                            <label for="ship_name" class="form-label">Departement</label>
                            <select type="text" data-placeholder="Departement" id="ship_name" name="ship_name" class="select2 form-control"
                                placeholder="Departement">
                                <option value="" disabled selected></option>
                                <option value="1">Departement 1</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 form-group">
                            <label for="ship_name" class="form-label">Posisi/Jabatan</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Posisi/Jabatan" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-3 mb-3 form-group">
                            <label for="ship_name" class="form-label">Mulai Asesmen</label>
                            <input type="time" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Mulai Asesmen" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 form-group">
                            <label for="ship_name" class="form-label"></label>
                            <input type="date" id="ship_name" name="ship_name" class="form-control"
                                placeholder="" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 form-group">
                            <label for="ship_name" class="form-label">Asesmen Berakhir</label>
                            <input type="time" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Asesmen Berakhir" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 form-group">
                            <label for="ship_name" class="form-label"></label>
                            <input type="date" id="ship_name" name="ship_name" class="form-control"
                                placeholder="" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('perusahaan.modal-departemen')
@endsection

@section('page-js')
    <script>
        @php
            $managePermission = 'ship.manage';
        @endphp
        const routeList = "{{ route('ships.list') }}";
        const routeStore = "{{ route('ships.store') }}";
        const routeUpdate = "{{ route('ships.update', ['ship' => ':ship']) }}";
        const routeEdit = "{{ route('ships.edit', ['ship' => ':ship']) }}";
        const routeParam = "ship"
        const dataTableId = "#ships-table";
        const AddTitle = "Add Ship";
        const EditTitle = "Edit Ship";
        const searchPlaceholder = "Search Departemen";
        const addButtonTitle = "Ships";
        //Change above const value for faster development

        $(document).ready(function() {
            datatables();
            tooltip();
        })

        // Callback Function

        function afterAction(response) {
            $('#modal-add').modal('hide');
            filterData();
        }

        function afterUpdateStatus(response) {
            filterData();
        }



        // Datatable Function

        function datatables() {
            let dataTa = [{
                    id: 1,
                    nama_departemen: 'Departemen 1',
                    jumlah_karyawan: '10',
                    action: `
                        <div class="d-flex align-items-center gap-2">
                            <a href="/perusahaan/detail-departemen" class="btn btn-sm btn-icon btn-detail"><i class="ti ti-file-text"></i></a>
                        </div>
                        `
                },
            ];
            $(dataTableId).DataTable({
                // ajax: routeList,
                data: dataTa,
                // serverSide: false,
                // processing: true,
                destroy: true,
                scrollX: true,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'nama_departemen'
                    },
                    {
                        data: 'jumlah_karyawan'
                    },
                    {
                        data: 'action'
                    },
                ],
                dom: '<"row"' +
                    '<"col-md-2"<"ms-n2"l>>' +
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"f>>' +
                    '>t' +
                    '<"row"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                language: {
                    sLengthMenu: '_MENU_',
                    search: '',
                    searchPlaceholder: searchPlaceholder,
                    paginate: {
                        next: '<i class="ti ti-chevron-right ti-sm"></i>',
                        previous: '<i class="ti ti-chevron-left ti-sm"></i>'
                    }
                },
                buttons: [
                    @if (auth()->user()->hasPermissionTo($managePermission))
                        {
                            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">' +
                                addButtonTitle + '</span>',
                            className: 'add-new btn btn-primary ms-4 waves-effect waves-light',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modal-add'
                            }
                        }
                    @endif
                ],
            });
        }

        // Modal Function

        function edit(e) {
            let id = e.attr('data-id');

            let action = routeUpdate.replace(`:${routeParam}`, id);
            var url = routeEdit.replace(`:${routeParam}`, id);
            let modal = $('#modal-add');

            modal.find(".modal-title").html(EditTitle);
            modal.find('form').attr('action', action);
            modal.find('input[name="_method"]').val("PUT");
            modal.find('input[id="id"]').val(id);
            modal.find('button[data-repeater-create]').attr('disabled', true);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    insertEditValue(response, modal);
                }
            });
        }

        $('#modal-add').on('hide.bs.modal', function() {
            $('#modal-add').find('input[name="_method"]').val("POST");
            $('#modal-add').find('input[id="id"]').val(null);

            $('#modal-add').find(".modal-title").html(AddTitle);
            $('#modal-add').find('form').attr('action', routeStore);
        });


        // Filter Function

        function filterData() {
            let data = $('#filter_form').serialize();

            //clean empty data
            data = data.replace(/[^&]+=\.?(?:&|$)/g, '');

            let url = `${routeList}?${data}`;
            $(dataTableId).DataTable().ajax.url(url).load();
            $('#modal-filter').offcanvas('hide');
            tooltip();
        }

        $('#filter_form').on('submit', function(e) {
            e.preventDefault();
            filterData();
        });

        $('#reset-filter').on('click', function() {
            $('#filter_form').trigger('reset');
            $('#filter_form').find('select').trigger('change');
            $(dataTableId).DataTable().ajax.url(routeList).load();
            $('#modal-filter').offcanvas('hide');
            tooltip();
        });
    </script>
@endsection
