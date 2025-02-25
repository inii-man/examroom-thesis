<!-- Add Role Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="modal-title mb-2">Add New Role</h4>
                    <p>Set role permissions</p>
                </div>
                <form action="{{ route('roles.store') }}" class="default-form" autocomplete="off"
                    function-callback="afterAction">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" id="id" name="id" />
                    <div class="col-12 mb-4 form-group">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" id="role-name" name="name" class="form-control"
                            placeholder="Enter a role name" tabindex="-1"/>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-2">Role Permissions</h5>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium text-heading">
                                            Administrator Access
                                            <i class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Allows a full access to the system"></i>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <div class="form-check mb-0 me-4 me-lg-12">
                                                    <input class="form-check-input" type="checkbox" id="checkAll"/>
                                                    <label class="form-check-label" for="selectAll"> Select All </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach($permissions as $group => $perm)
                                    <tr>
                                        <td class="text-nowrap fw-medium text-heading">{{ ucwords($group) }} Management</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @foreach($perm as $p)
                                                <div class="form-check mb-0 me-4 me-lg-12">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        id="check-{{$group}}-{{$p}}" value="{{ $group }}.{{ $p }}"/>
                                                    <label class="form-check-label" for="check-{{$group}}-{{$p}}">{{ ucwords($p) }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
