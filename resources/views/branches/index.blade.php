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
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Master Data /</span> Branches</h4>
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
            <table class="table" id="branches-table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th>Branch Name</th>
                        <th>Branch Type</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('branches.modal')
@endsection

@section('page-js')
    <script>
        @php
            $managePermission = 'branch.manage';
        @endphp
        const routeList = "{{ route('branches.list') }}";
        const routeStore = "{{ route('branches.store') }}";
        const routeUpdate = "{{ route('branches.update', ['branch' => ':branch']) }}";
        const routeEdit = "{{ route('branches.edit', ['branch' => ':branch']) }}";
        const routeParam = "branch"
        const dataTableId = "#branches-table";
        const AddTitle = "Add Branch";
        const EditTitle = "Edit Branch";
        const searchPlaceholder = "Search Branch";
        const addButtonTitle = "Branches";
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
                ajax: routeList,
                serverSide: false,
                processing: true,
                destroy: true,
                scrollX: true,
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'branch_name'
                    },
                    {
                        data: 'branch_type'
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
            $('#modal-add').find('button[data-repeater-create]').attr('disabled', false);

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
