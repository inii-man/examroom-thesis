{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('perusahaan.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction"> --}}
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="id" />
                <div class="modal-body">
                    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
                    </div>  
                    <div class="row">
                        <div class="col-12 mb-3 form-group">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control"
                                placeholder="Nama Perusahaan" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="perusahaan_logo" class="form-label">Upload Logo</label>
                            <input type="file" id="perusahaan_logo" class="form-control"
                                placeholder="Upload Logo" accept="image/*" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-primary">Submit</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>