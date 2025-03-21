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
            <h4 class="fw-bold mb-0">Konfigurasi Perusahaan</h4>
        </div>
        <div class="col-md-2 col-12 text-end">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-add"><i
                    class="tf-icons me-3 ti ti-plus"></i>Perusahaan</button>
        </div>
    </div>
    <div class="card" style="border: 0.5px solid; 
        border-radius: 5px;">
        <div class="card-datatable border-bottom table-responsive">
            <table class="table" id="perusahaan-table">
                <thead class="border-top">
                    <tr>
                        <th>No</th>
                        <th>Perusahaan</th>
                        <th>Jumlah Departemen</th>
                        <th>Logo perusahaan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ url('/') }}" class="btn btn-sm btn-icon btn-edit"><i
                                        class="tf-icons ti ti-pencil"></i></a>
                                <a href="{{ url('/') }}" class="btn btn-sm btn-icon btn-delete"><i
                                        class="tf-icons ti ti-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
    @include('perusahaan.modal')
@endsection

@section('page-js')
    <script>
        // @php
        //     $managePermission = 'perusahaan.manage';
        // @endphp
        const routeList = "{{ route('perusahaan.list') }}";
        const routeStore = "{{ route('perusahaan.store') }}";
        const routeUpdate = "{{ route('perusahaan.update', ['perusahaan' => ':perusahaan']) }}";
        const routeEdit = "{{ route('perusahaan.edit', ['perusahaan' => ':perusahaan']) }}";
        const routeParam = "perusahaan"
        const dataTableId = "#perusahaan-table";
        const AddTitle = "Add perusahaan";
        const EditTitle = "Edit perusahaan";
        const searchPlaceholder = "Search Perusahaan";
        const addButtonTitle = "perusahaan";
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
            $(dataTableId).DataTable({
                ajax: "{{ route('perusahaan.list') }}",
                // data: dataTa,
                // url: routeList,
                serverSide: false,
                processing: true,
                destroy: true,
                scrollX: true,
                columns: [
                    // {
                    //     data: 'id'
                    // },
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_perusahaan'
                    },
                    {
                        data: 'nama_perusahaan'
                    },
                    {
                        data: 'nama_perusahaan'
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
