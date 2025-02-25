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
                        <label class="form-label">Type</label>
                        <br>
                        <div class="form-check form-check-inline mt-4">
                            <input class="form-check-input" type="radio" name="light_house_type" value="Land"
                                id="landRadio"/>
                            <label class="form-check-label" for="landRadio">Land</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="light_house_type" value="Offshore"
                                id="offshoreRadio"/>
                            <label class="form-check-label" for="offshoreRadio">Offshore</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 pb-4 mb-4 border-bottom">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Structure</label>
                        <select class="form-select select2" name="light_house_structure" data-placeholder="Select Structure">
                            <option value="">All</option>
                            @foreach ($light_house_structure as $structure )
                                <option>{{ $structure }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
