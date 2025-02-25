{{-- Create and Edit Modal --}}
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" class="default-form" autocomplete="off"
                function-callback="afterAction">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3 form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Cahyo Tri Satrio" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                placeholder="info@technoinfinity.co.id" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="role" class="form-label">Role</label>
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
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password123!" />
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
