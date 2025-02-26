{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('perusahaan.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-8 mb-3 form-group">
                            <label for="ship_name" class="form-label">Pertanyaan</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Pertanyaan" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-4 mb-3 form-group">
                            <label for="ship_type" class="form-label">Level Pertanyaan</label>
                            <input type="text" id="ship_type" name="ship_type" class="form-control"
                                placeholder="Level Pertanyaan" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
