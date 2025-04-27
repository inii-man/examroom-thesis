@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endsection

@section('content')
    <div class="row g-6">
        <div class="col-12">
            <div class="row mb-4">
                <div class="col-md-10 col-12">
                    <h4 class="fw-bold mb-0">Pengelolaan Assesment</h4>
                </div>
            </div>
            <div class="col-md-12 col-12 ">
                <table class="datatable" id="table-assesment">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                {{-- <div class="card">
                    <div class="card-header text-center">
                        <img class="" width="100" src="{{ app_config('sidebar_logo') }}" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">ABC</h5>
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <div>
                                <p class="mb-0">Total Assessment</p>
                                <h5 style="color: #5A77DF" class="mb-0">3 Assessment</h5>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0">Total Karyawan</p>
                                <h5 style="color: #5A77DF" class="mb-0">3 Karyawan</h5>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="/konfigurasi-assesment" style="border-radius: 50px; width: 100%; background-color: #1D41D3; color: #fff" class="btn">Buka Perusahaan</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!--/ Content -->
@endsection

@section('page-js')
    <script>
        // datatable
        $(document).ready(function() {
            let dataTa = [{
                    id: 1,
                    image: '{{ app_config('sidebar_logo') }}',
                    card: '{{ app_config('sidebar_logo') }}',
                    nama_departemen: 'ABC',
                    total_assessment: '3 Assessment',
                    total_karyawan: '3 Karyawan',
                },
            ];
            $('#table-assesment').DataTable({
                data: dataTa,
                columns: [{
                        data: 'card',
                        render: function(data, type, row) {
                            return `<a class="card" href="/konfigurasi-assesment-monitoring">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <img class="" width="80" src="${data}" />
                                            <div>
                                               <p class="mb-0">Nama Perusahaan</p>
                                                <h3 class="card-title">${row.nama_departemen}</h3>
                                            </div>
                                            <div>
                                                <p class="mb-0">Jumlah Assessment</p>
                                                <h5 style="color: #5A77DF" class="mb-0">${row.total_assessment}</h5>
                                               
                                            </div>
                                            <div>
                                                 <p class="mb-0">Jumlah Karyawan</p>
                                                <h5 style="color: #5A77DF" class="mb-0">${row.total_karyawan}</h5>
                                            </div>
                                        </div>
                                    </div></a>`;
                        }
                    },
                ]
            });
        });
    </script>
@endsection
