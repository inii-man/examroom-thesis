{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ship</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ships.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3 form-group">
                            <label for="ship_name" class="form-label">Ship Name</label>
                            <input type="text" id="ship_name" name="ship_name" class="form-control"
                                placeholder="Kapal Laud" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="ship_type" class="form-label">Ship Type</label>
                            <input type="text" id="ship_type" name="ship_type" class="form-control"
                                placeholder="Kapal Pengangkut Barang" />
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
