{{-- Create and Edit Modal --}}
<div class="modal fade modal-lg" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bank Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div style="border: 1px solid #F09625; background-color: #FFF3CD; color: #F09625; padding: 15px; margin: 20px 0; border-radius: 5px; display: flex; align-items: center;">  
                        <span style="margin-right: 10px;"><i class="ti ti-alert-circle"></i></span>  
                        Saat ini aplikasi masih dalam tahap semi-prototype. Data yang Anda input tidak akan tersimpan karena belum terhubung ke database. Anda dapat tetap mengisi form dan menekan tombol "Simpan Data".  
                    </div>  
                    <div class="col-12 mb-3 form-group">
                        <label for="bank_soal_name" class="form-label">Nama Bank Soal</label>
                        <input type="text" id="bank_soal_name" name="bank_soal_name" class="form-control"
                            placeholder="Nama Bank Soal" />
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <!-- Repeater container -->
                    <div id="bank-soal-repeater">
                        <!-- Repeatable section -->
                        <div class="repeater-item mb-3">
                            <div class="row mx-1" style="border: 0.5px solid; border-radius: 5px; padding: 10px">
                                <div class="col-11 text-end" style="position: absolute;">
                                    <button type="button" style="background-color:red" class="btn-close remove-repeater-item"></button>
                                </div>
                                <div class="col-8 mb-3 form-group">
                                    <label for="kompetensi_name" class="form-label">Nama Kompetensi</label>
                                    <select name="kompetensi_name" class=" form-control" data-placeholder="Nama Kompetensi">
                                        <option value="" disabled selected></option>
                                        <option value="1">Kompetensi 1</option>
                                        <option value="2">Kompetensi 2</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-4 mb-3 form-group">
                                    <label for="jumlah_pertanyaan" class="form-label">Jumlah Pertanyaan</label>
                                    <input type="text" name="jumlah_pertanyaan" class="form-control"
                                        placeholder="25 Pertanyaan" disabled />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between modal-footer">
                    <button type="button" class="btn btn-outline-success" id="add-bank-soal">+ Data Bank Soal</button>
                    <button type="button" id="modal-button" class="btn btn-primary">Simpan Data</button>
                </div>
        </div>
    </div>
</div>
