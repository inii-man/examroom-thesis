{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('perusahaan.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction"> --}}
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
        Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
    </div>  
    
    <!-- Repeater container -->
    <div id="departemen-repeater">
        <!-- Repeatable section -->
        <div class="repeater-item mb-3">
            <div class="row" style="align-items: center">
                <div class="col-10 mb-3 form-group">
                    <label for="nama_departemen" class="form-label">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control"
                        placeholder="Nama Departemen" />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-2">
            <button type="button" class="btn btn-outline-danger btn-sm remove-repeater-item"><i class="ti ti-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between modal-footer">
    <button type="button" class="btn btn-outline-success" id="add-departemen">+ Data Departemen</button>
    <button type="button" id="modal-button" class="btn btn-primary">Simpan Data</button>
</div>
            {{-- </form> --}}
        </div>
    </div>
</div>