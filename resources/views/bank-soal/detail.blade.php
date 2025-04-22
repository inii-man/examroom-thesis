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
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Bank Soal</span> / Data Kompetensi</h4>
        </div>
        {{-- <div class="col-md-2 col-12 text-end">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-add"><i
                    class="tf-icons me-3 ti ti-plus"></i>Kompetensi</button>
        </div> --}}
    </div>
    <div class="card" style="border: 0.5px solid; 
        border-radius: 5px;">
        <div class="card-datatable border-bottom table-responsive">
            <table class="table" id="ships-table">
                <thead class="border-top">
                    <tr>
                        <th>No</th>
                        <th>Kode Kompetensi</th>
                        <th>Nama Kompetensi</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Pertanyaan</th>
                        <th>status</th>
                        <th>Action</th>
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
    @include('kompetensi.modal')
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
                    kode_kompetensi: 'IT01',
                    nama_kompetensi: 'Good Governance',
                    deskripsi: 'Pengetahuan, kemampuan dan keahlian terkait identiﬁkasi, penerapan, dan pengukuran.',
                    jumlah_pertanyaan: '10 Soal',
                    status: '<span class="badge bg-label-success">Acive</span>',
                    action: `
                        <div class="d-flex align-items-center gap-2">
                            <a href="/bank-soal/question_detail" class="btn btn-sm btn-icon btn-primary"><i class="ti ti-file-text"></i></a>
                            
                        </div>
                        `
                },
                {
                    id: 2,
                    kode_kompetensi: 'IT02',
                    nama_kompetensi: 'Good Governance',
                    deskripsi: 'Pengetahuan, kemampuan dan keahlian terkait identiﬁkasi, penerapan, dan pengukuran.',
                    jumlah_pertanyaan: '10 Soal',
                    status: '<span class="badge bg-label-success">Acive</span>',
                    action: `
                        <div class="d-flex align-items-center gap-2">
                            <a href="/bank-soal/question_detail" class="btn btn-sm btn-icon btn-primary"><i class="ti ti-file-text"></i></a>
                            
                        </div>
                        `}
            ];
            $(dataTableId).DataTable({
                // ajax: routeList,
                data: dataTa,
                // serverSide: false,
                // processing: true,
                destroy: true,
                scrollX: true,
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'kode_kompetensi'
                    },
                    {
                        data: 'nama_kompetensi'
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: 'jumlah_pertanyaan'
                    },
                    {
                        data: 'status',
                        
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
    </script>
@endsection
