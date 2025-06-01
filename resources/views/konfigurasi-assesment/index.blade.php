@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-9 col-12">
            <h4 class="fw-bold mb-0">Pengelolaan Assesment</h4>
        </div>
        <div class="col-md-3 col-12 text-end">
            {{-- <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-add"><i
                    class="tf-icons me-3 ti ti-plus"></i>Data Assesment</button> --}}
            <a href="/konfigurasi-assesment/detail-konfigurasi" class="btn btn-primary"><i
                class="tf-icons me-3 ti ti-plus"></i>Tambah Assesment</a>
        </div>
    </div>
    <div class="card" style="border: 0.5px solid; 
        border-radius: 5px;">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                    Data Aktif
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                    Data Tidak Aktif
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="card-datatable border-bottom table-responsive">
                    <table class="table" id="ships-table">
                        <thead class="border-top">
                            <tr>
                                <th>No</th>
                                <th>Nama Assesment</th>
                                <th>Departemen</th>
                                <th>Posisi/Jabatan</th>
                                <th>Waktu Assesment</th>
                                <th>Rate Penilaian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                <div class="card-datatable border-bottom table-responsive">
                    <table class="table" id="ships-table1">
                        <thead class="border-top">
                            <tr>
                                <th>No</th>
                                <th>Nama Assesment</th>
                                <th>Departemen</th>
                                <th>Posisi/Jabatan</th>
                                <th>Waktu Assesment</th>
                                <th>Rate Penilaian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('perusahaan.modal')
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
        const searchPlaceholder = "Search Perusahaan";
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
                nama_assesment: 'Assesment 1',
                departemen: 'Departemen 1',
                posisi: 'Posisi 1',
                waktu_assesment: 'Waktu Assesment 1',
                rate_penilaian: 'Rate Penilaian 1',
                status: '<span class="badge bg-label-success">Active</span>',
                action: `
                         <div class="d-flex align-items-center gap-2">
                            <a href="/konfigurasi-assesment/detail-manajemen" class="btn btn-sm btn-icon btn-info"><i class="ti ti-settings"></i></a>
                            <a id="button-edit" href="#" class="btn btn-sm btn-icon btn-warning"><i class="ti ti-edit"></i></a>
                            <a href="javascript:void(0)" class="nonaktif btn btn-sm btn-icon btn-danger"><i class="ti ti-circle-x"></i></a>
                        </div>
                        `
            }, ];
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
                        data: 'nama_assesment'
                    },
                    {
                        data: 'departemen'
                    },
                    {
                        data: 'posisi'
                    },
                    {
                        data: 'waktu_assesment'
                    },
                    {
                        data: 'rate_penilaian'
                    },
                    {
                        data: 'status'
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
                    
                        {
                            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">' +
                                addButtonTitle + '</span>',
                            className: 'add-new btn btn-primary ms-4 waves-effect waves-light',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modal-add'
                            }
                        }
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

        $(document).on('click', '.nonaktif', function(e) {
            Swal.fire({
        title: 'Apakah Anda Yakin ingin Non-Aktifkan Data?',
        text: 'You clicked the button!',
        icon: 'warning',
        html:
          ` <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 0px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Ini hanya simulasi. Data tidak benar-benar dinonaktifkan karena aplikasi masih dalam tahap semi-prototipe.  
                    </div>  
                    `,
        customClass: {
          confirmButton: 'btn btn-primary waves-effect waves-light'
        },
        confirmButtonText: 'Ok, Saya Mengerti',
        buttonsStyling: false
      });
            })

            $(document).on('click', '#button-edit', function(e) {
            Swal.fire({
       
        html:
          ` <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 0px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                       Button yang Anda klik merupakan Button Untuk Mengedit Asesmen.
                    </div>  
                    `,
        customClass: {
          confirmButton: 'btn btn-primary waves-effect waves-light'
        },
        confirmButtonText: 'Ok, Saya Mengerti',
        buttonsStyling: false
      });
            })


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
