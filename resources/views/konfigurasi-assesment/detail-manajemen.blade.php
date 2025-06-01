@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0">Pengelolaan Asesmen / Konfigurasi Asesmen</h4>
        </div>
    </div>
    <div class="card" style="border: 0.5px solid; 
        border-radius: 5px;">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h4>Informasi Asesmen</h4>
            </div>
            {{-- <div>
                <button class="btn btn-outline-primary"><span class="tf-icons ti ti-download"></span>Download Recapitulation</button>
            </div> --}}
        </div>
        <div class="card-body mt-5 row">
            <div class="col-md-4 col-12">
                <div>
                    <span class="text-muted">Nama Asesmen</span>
                    <h5>Assesment 1</h5>
                </div>
                <div>
                    <span class="text-muted">Departemen</span>
                    <h5>Departemen 1</h5>
                </div>
                <div>
                    <span class="text-muted">Posisi/Jabatan</span>
                    <h5>Senior</h5>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div>
                    <span class="text-muted">Pertanyaan Yang Digunakan</span>
                    <h5>Pertanyaan untuk perusahaan ABC</h5>
                </div>
                <div>
                    <span class="text-muted">Mulai Assesment</span>
                    <h5>13:01:00, 24 Agustus 2024</h5>
                </div>
                <div>
                    <span class="text-muted">Berakhir Assesment</span>
                    <h5>13:01:00, 25 Agustus 2024</h5>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div>
                    <h5>Tingkat Kemahiran Pertanyaan: 5</h5>
                    <h5>Batas Rating Penilaian Peserta: 5</h5>
                    <h5>Batas Rating Penilaian Assesor: 5</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3" style="border: 0.5px solid; 
        border-radius: 5px;">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                    Kompetensi
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                    Peserta Assesment
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
                                <th>Kode</th>
                                <th>Kompetensi</th>
                                <th>Tingkatan</th>
                                <th>Total Pertanyaan</th>
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
                                <th>Nama Karyawan</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @include('konfigurasi-assesment.modal_manajemen')
    @include('konfigurasi-assesment.modal_manajemen2')
    @include('konfigurasi-assesment.modal_manajemen3')
        
    </div>
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
        const dataTableIdd = "#ships-table1";
        const AddTitle = "Add Ship";
        const EditTitle = "Edit Ship";
        const searchPlaceholder = "Search";
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
                nama_assesment: 'HMR201',
                departemen: 'Business Process Knowledge',
                posisi: '1',
                waktu_assesment: '24 Questions',
                action: `
                         <div class="d-flex align-items-center gap-2">
                            
                            <a data-bs-toggle="modal" data-bs-target="#modal-add-kompetensi1" href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary"><i class="ti ti-file-text"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning"><i class="ti ti-edit"></i></a>
                        </div>
                        `
            }, ];
            let dataTaa = [{
                id: 1,
                nama_assesment: 'Samuel Alfredo',
                departemen: 'Samalfred@gmail.com',
                action: `
                         <div class="d-flex align-items-center gap-2">
                            
                            <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-icon btn-danger"><i class="ti ti-trash"></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#modal-add-kompetensi2"  href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary"><i class="ti ti-mail"></i></a>
                        </div>
                        `
            }, ];
            $(dataTableId).DataTable({
                // ajax: routeList,
                data: dataTa,
                // serverSide: false,
                // processing: true,
                destroy: true,
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
                        data: 'action'
                    },
                ],
                dom: '<"row"' +
                    '<"col-md-2"<"ms-n2"l>>' +
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"fB>>' +
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
                            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Kompetensi di Asesment</span>',
                            className: 'add-new btn btn-primary ms-4 waves-effect waves-light',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modal-add-kompetensi'
                            }
                        },
                        
                ],
            });

            $(dataTableIdd).DataTable({
                // ajax: routeList,
                data: dataTaa,
                // serverSide: false,
                // processing: true,
                destroy: true,
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
                        data: 'action'
                    },
                ],
                dom: '<"row"' +
                    '<"col-md-2"<"ms-n2"l>>' +
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0"fB>>' +
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
                            text: '<i class="ti ti-send me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Send Email</span>',
                            className: 'add-new btn btn-outline-primary ms-4 waves-effect waves-light',
                            attr: {
                                'data-bs-toggle': 'modal',
                                'data-bs-target': '#modal-add'
                            }
                        },{
                            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Users</span>',
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

        $(document).on('click', '#btn-delete', function(e) {
            Swal.fire({
        html:
          ` <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 0px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                       Button yang Anda klik merupakan Button Hapus untuk Menghapus Peserta Asesmen,
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

        document.addEventListener('DOMContentLoaded', function() {
    const repeaterContainer = document.getElementById('kompetensi-repeater');
    const addButton = document.getElementById('add-kompetensi');

    function createRepeaterItem() {
        const template = repeaterContainer.querySelector('.repeater-item');
        const newItem = template.cloneNode(true);
        
        newItem.querySelectorAll('input, select').forEach(input => {
            input.value = '';
        });

        newItem.querySelector('.remove-repeater-item').addEventListener('click', function() {
            if (repeaterContainer.children.length > 1) {
                newItem.remove();
            }
        });

        repeaterContainer.appendChild(newItem);
    }

    addButton.addEventListener('click', createRepeaterItem);

    repeaterContainer.querySelector('.remove-repeater-item').addEventListener('click', function(e) {
        if (repeaterContainer.children.length > 1) {
            e.target.closest('.repeater-item').remove();
        }
    });
});
    </script>
@endsection


