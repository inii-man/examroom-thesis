{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kompetensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form > --}}
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
                    </div>  
                    <div id="kompetensi-repeater">
                        <!-- Repeatable section -->
                        <div class="repeater-item mb-3">
                    <div class="row" style="border: 0.5px solid; border-radius: 5px; padding: 10px">
                        <div class="col-11 ms-3 text-end" style="position: absolute;">
                            <button type="button" style="background-color:red" class="btn-close remove-repeater-item"></button>
                        </div>
                        <div class="col-5 mb-3 form-group">
                            <label for="ship_name" class="form-label">Kode Kompetensi</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Kode Kompetensi" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-7 mb-3 form-group">
                            <label for="ship_type" class="form-label">Nama Kompetensi</label>
                            <input type="text" id="ship_type" name="ship_type" class="form-control"
                                placeholder="Nama Kompetensi" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="ship_type" class="form-label">Deskripsi Kompetensi</label>
                            <textarea name="ship_type" class="form-control" placeholder="Deskripsi Kompetensi" id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                        </div></div>
                </div>
                <div class="d-flex justify-content-between modal-footer">
                    <button class="btn btn-outline-success"  id="add-kompetensi" >+ Data Kompetensi</button>
                    <button  id="modal-button" class="btn btn-primary">Simpan Data</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
