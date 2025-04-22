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
            <h4 class="fw-bold mb-0">Konfigurasi Pengguna</h4>
        </div>
        <div class="col-md-2 col-12 text-end">
            <button class="btn btn-primary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#modal-filter"><i
                    class="tf-icons ti ti-filter"></i></button>
        </div>
    </div>
    <p class="text-secondary">Data filtering by : <i class='tf-icons ti ti-alert-circle text-primary pb-1'
            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="" id="tooltip-filter"></i></p>
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="users-table">
                <thead class="border-top">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Perusahaan</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('users.modal')
@endsection

@section('page-js')
    <script>
        //Routes
        @php
            $managePermission = 'user.manage';
        @endphp
        const routeList = "{{ route('users.list') }}";
        const routeStore = "{{ route('users.store') }}";
        const routeUpdate = "{{ route('users.update', ['user' => ':user']) }}";
        const routeEdit = "{{ route('users.edit', ['user' => ':user']) }}";
        const routeParam = "user"
        //Modal
        const AddTitle = "Add User";
        const EditTitle = "Edit User";
        //DataTables
        const dataTableId = "#users-table";
        const searchPlaceholder = "Search User";
        const addButtonTitle = "New User";
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
                    name: 'John Doe',
                    company: 'PT. A',
                    email: 'i7u0I@example.com',
                    role: 'Admin',
                    status: 'Active',
                    action: `
                        <div class="d-flex align-items-center gap-2">
                            <a  class="btn btn-sm btn-icon btn-warning"><i class="ti ti-edit"></i></a>
                            <a href="javascript:void(0)" class="nonaktif btn btn-sm btn-icon btn-danger"><i class="ti ti-circle-x"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-info"><i class="ti ti-repeat"></i></a>
                        </div>
                        `
                },
                {
                    id: 2,
                    name: 'John Doe',
                    company: 'PT. A',
                    email: 'i7u0I@example.com',
                    role: 'Admin',
                    status: 'Active',
                    action: `
                        <div class="d-flex align-items-center gap-2">
                            <a  class="btn btn-sm btn-icon btn-warning"><i class="ti ti-edit"></i></a>
                            <a href="javascript:void(0)" class="nonaktif btn btn-sm btn-icon btn-danger"><i class="ti ti-circle-x"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-info"><i class="ti ti-repeat"></i></a>
                        </div>
                        `
                },
            ];
            $(dataTableId).DataTable({
                // ajax: routeList,
                // serverSide: false,
                // processing: true,
                data: dataTa,
                destroy: true,
                scrollX: true,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'company'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role'
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
                    @if (auth()->user()->hasPermissionTo($managePermission))
                        {
                            extend: 'collection',
                            className: 'btn btn-label-secondary dropdown-toggle ms-4 waves-effect waves-light',
                            text: '<i class="ti ti-upload me-2 ti-xs"></i>Export',
                            buttons: [{
                                    extend: 'print',
                                    text: '<i class="ti ti-printer me-2" ></i>Print',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        // prevent avatar to be print
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item
                                                        .classList.contains('user-name')) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    },
                                    customize: function(win) {
                                        //customize print view for dark
                                        $(win.document.body)
                                            .css('color', headingColor)
                                            .css('border-color', borderColor)
                                            .css('background-color', bodyBg);
                                        $(win.document.body)
                                            .find('table')
                                            .addClass('compact')
                                            .css('color', 'inherit')
                                            .css('border-color', 'inherit')
                                            .css('background-color', 'inherit');
                                    }
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="ti ti-file-text me-2" ></i>Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item
                                                        .classList.contains('user-name')) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item
                                                        .classList.contains('user-name')) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item
                                                        .classList.contains('user-name')) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'copy',
                                    text: '<i class="ti ti-copy me-2" ></i>Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item
                                                        .classList.contains('user-name')) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                }
                            ]
                        }, {
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
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    insertEditValue(response, modal);
                }
            });
        }

        // onclickmodal-button
        $(document).on('click', '#modal-button', function(e) {
            Swal.fire({
        title: 'Data Berhasil Diinput !',
        text: 'You clicked the button!',
        icon: 'success',
        html:
          ` <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 0px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Karena aplikasi ini masih Semi - Prototipe dan belum terkoneksi ke database, data belum dapat ditampilkan pada datatable. Silahkan lanjutkan ke proses berikutnya.  
                    </div>  
                    `,
        customClass: {
          confirmButton: 'btn btn-primary waves-effect waves-light'
        },
        confirmButtonText: 'Ok, Saya Mengerti',
        buttonsStyling: false
      });
            })

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
