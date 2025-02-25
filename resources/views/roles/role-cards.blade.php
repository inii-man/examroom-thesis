@foreach ($roles as $role)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-normal mb-0 text-body">Total {{ count($role['users']) }} users</h6>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        @if (count($role['users']) <= 4)
                            @foreach ($role['users'] as $user)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    data-bs-original-title="{{ $user['name'] }}" class="avatar pull-up">
                                    <img class="rounded-circle" src="{{ profilePicture($user) }}" alt="Avatar" />
                                </li>
                            @endforeach
                        @else
                            @foreach (collect($role['users'])->take(3) as $user)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    data-bs-original-title="{{ $user['name'] }}" class="avatar pull-up">
                                    <img class="rounded-circle" src="{{ profilePicture($user) }}" alt="Avatar" />
                                </li>
                            @endforeach
                            <li class="avatar">
                                <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    data-bs-original-title="{{ count($role['users']) - 3 }} more">+{{ count($role['users']) - 3 }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="role-heading">
                        <h5 class="mb-1">{{ $role['name'] }}</h5>
                        @can('role.manage')
                            <a class="text-primary" href="javascript:void(0);" onclick="edit($(this))" data-id="{{ $role->id }}">
                                <span>Edit Role</span>
                            </a>
                        @endcan
                    </div>
                    @can('role.manage')
                        <a href="javascript:void(0);" onclick="copyRole($(this))" data-id="{{ $role->id }}"><i class="ti ti-copy ti-md text-heading"></i></a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endforeach

@can('role.manage')
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card h-100">
            <div class="row h-100">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4">
                        <img src="../../assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0"
                            alt="add-new-roles" width="83" />
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-bs-target="#modal-add" data-bs-toggle="modal"
                            class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                            Add New Role
                        </button>
                        <p class="mb-0">
                            Add new role, <br />
                            if it doesn't exist.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan