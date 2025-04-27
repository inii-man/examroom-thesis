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
    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
        Saat ini aplikasi masih dalam tahap semi-prototipe. Data yang Anda Input tidak akan tersimpan karena belum terhubung ke database. Anda tetap dapat mencoba mengisi form dan menekan tombol "Simpan Data"
    </div>  
    <div class="card" style="border: 0.5px solid; border-radius: 5px;">
        <div class="card-header" style="border-bottom: 0.5px solid">
            <h4 class="fw-bold mb-0">Tambah Asesmen</h4>
        </div>
        <div class="card-body mt-5">
            <!-- Repeater container -->
            <div id="asesmen-repeater">
                <!-- Repeatable section -->
                <div class="repeater-item card mb-3" style="border-bottom: 0.5px solid">
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
                        
                        <!-- Remove button for each repeater item -->
                        <button type="button" class="btn btn-danger remove-repeater-item mt-3">Hapus</button>
                    </div>
                </div>
            </div>
            
            <!-- Add new repeater item button -->
            <div class="d-flex mt-3 justify-content-between">
                <button type="button" class="btn btn-outline-success" id="add-repeater-item">+ Data Assesment</button>
                <button type="button" id="modal-button" class="btn btn-primary">Simpan Data</button>
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

        document.addEventListener('DOMContentLoaded', function() {
    const repeaterContainer = document.getElementById('asesmen-repeater');
    const addButton = document.getElementById('add-repeater-item');

    // Function to create a new repeater item
    function createRepeaterItem() {
        const template = repeaterContainer.querySelector('.repeater-item');
        const newItem = template.cloneNode(true);
        
        // Clear input values in the new item
        newItem.querySelectorAll('input, select').forEach(input => {
            input.value = '';
        });

        // Add event listener to remove button
        newItem.querySelector('.remove-repeater-item').addEventListener('click', function() {
            newItem.remove();
        });

        repeaterContainer.appendChild(newItem);
    }

    // Add event listener to add button
    addButton.addEventListener('click', createRepeaterItem);

    // Add event listener to initial remove button
    repeaterContainer.querySelector('.remove-repeater-item').addEventListener('click', function(e) {
        if (repeaterContainer.children.length > 1) {
            e.target.closest('.repeater-item').remove();
        }
    });
});


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
      }).then((result) => {
          window.location.href = "{{ url('konfigurasi-assesment') }}";
      })
            })
    </script>
@endsection
