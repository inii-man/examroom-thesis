{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('users.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction"> --}}
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="id" />
                <div class="modal-body">
                    <div class="row">
                        <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
                            <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                            Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
                        </div>  
                        <div class="col-12 mb-3 form-group">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Nama Pengguna" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="email" class="form-label">Email Perusahaan</label>
                            <input type="text" id="email" name="email" class="form-control"
                                placeholder="info@technoinfinity.co.id" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="role" class="form-label">Pilih Role</label>
                            <select id="role" name="role" class="select2 form-select"
                                data-placeholder="Pilih Role">
                                <option value="" disabled selected>Choose Role</option>
                                @foreach ($roles as $item)
                                    <option>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="role" class="form-label">Pilih Perusahaan</label>
                            <select id="company" name="role" class="select2 form-select"
                                data-placeholder="Pilih Perusahaan">
                                <option value="" disabled selected>Pilih Perusahaan </option>
                                <option value="1">Perusahaan A</option>
                                <option value="2">Perusahaan B</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="role" class="form-label">Pilih Departemen</label>
                            <select id="department" name="role" class="select2 form-select"
                                data-placeholder="Pilih Departemen">
                                <option value="" disabled selected>Pilih Departemen </option>
                                <option value="3">Departemen A</option>
                                <option value="4">Departemen B</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between modal-footer">
                    {{-- <button class="btn btn-outline-success" data-bs-dismiss="modal">+ Data Pertanyaan</button> --}}
                    <button id="modal-button" class="btn btn-primary">Simpan Data</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

{{-- Filter Modal --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="modal-filter" aria-labelledby="offcanvasfilter">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasfilter" class="offcanvas-title">Filter By</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="filter_form">
            <div class="col-12 pb-4 mb-4 border-bottom">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Roles</label>
                        <select class="form-select select2" name="role" data-placeholder="Select Roles">
                            <option value="">All</option>
                            @foreach ($roles as $item)
                                <option>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status</label>
                        <select class="form-select select2" name="status" data-placeholder="Select Status">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" id="reset-filter">Reset</button>
        </form>
    </div>
</div>
