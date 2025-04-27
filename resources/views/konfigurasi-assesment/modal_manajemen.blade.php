{{-- Create and Edit Modal --}}
<div class="modal fade modal-lg" id="modal-add-kompetensi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kompetensi di Asesmen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
                    </div>  
                    
                    <!-- Repeater container -->
                    <div id="kompetensi-repeater">
                        <!-- Repeatable section -->
                        <div class="repeater-item d-flex justify-content-between align-items-center mb-4">
                            <div class="row col-10">
                                <div class="col-4 mb-4 form-group">
                                    <label for="ship_name" class="form-label">Kompetensi</label>
                                    <select class="form-select select2" name="ship_name" data-placeholder="Kompetensi">
                                        <option value="" disabled selected></option>
                                    </select>
                                </div>
                                <div class="col-4 mb-4 form-group">
                                    <label for="ship_type" class="form-label">Tingkatan Pertanyaan</label>
                                    <input type="text" id="ship_type" name="ship_type" class="form-control"
                                        placeholder="Tingkatan Pertanyaan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-4 mb-4 form-group">
                                    <label for="ship_type" class="form-label">Level of Requirement</label>
                                    <input type="text" id="ship_type" name="ship_type" class="form-control"
                                        placeholder="Level of Requirement" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-danger remove-repeater-item"><i class="ti ti-trash"></i></button>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between modal-footer">
                    <button type="button" class="btn btn-outline-success" id="add-kompetensi">+ Kompetensi</button>
                    <button type="button" id="modal-button" class="btn btn-primary">Simpan Data</button>
                </div>
        </div>
    </div>
</div>