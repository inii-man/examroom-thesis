@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Configuration /</span> My Profile</h4>
        </div>
    </div>
    <div class="card mb-6">
        <div class="card-body">
            <form id="form_update_profile" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
                <div class="d-flex align-items-start align-items-sm-center gap-6">
                    <img src="{{ profilePicture() }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                        id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="ti ti-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden name="profile_pic"
                                accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <div>Allowed JPG, GIF or PNG. Max size of 2MB</div>
                    </div>
                </div>
                <div class="row pt-4">
                    @csrf
                    <div class="col-6 form-group form-input mb-2">
                        <label class="form-label" for="username">Email</label>
                        <i class="ti ti-info-circle fs-5 text-primary" data-bs-toggle="tooltip" data-bs-html="true"
                            title="Email ini digunakan untuk login dan menerima notifikasi"></i>
                        <input type="text" id="username" class="form-control" placeholder="Email" name="email"
                            value="{{ $profile->email }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-6 form-group form-input mb-2">
                        <label class="form-label" for="pass">Nama</label>
                        <input type="text" id="name" class="form-control" placeholder="Nama" name="name"
                            value="{{ $profile->name }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-6 form-group form-input">
                        <label class="form-label" for="username">Pasword Baru</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="pass" class="form-control" placeholder="Pasword Baru"
                                name="new_password">
                            <span class="input-group-text cursor-pointer"><i onclick="showPass($(this))"
                                    class="ti ti-eye-off"></i></span>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-6 form-group form-input">
                        <label class="form-label" for="pass">Konfirmasi Pasword Baru</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="new_pass" class="form-control" placeholder="Konfirmasi Pasword Baru"
                                name="new_password_confirmation">
                            <span class="input-group-text cursor-pointer"><i onclick="showPass($(this))"
                                    class="ti ti-eye-off"></i></span>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="card-footer text-right ps-0">
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-3" id="btnSubmit">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /Account -->
    </div>

    @if (!auth()->user()->hasRole('Super Admin'))
        <div class="card">
            <h5 class="card-header">Deactivate Account</h5>
            <div class="card-body">
                <div class="mb-6 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h5 class="alert-heading mb-1">Are you sure you want to deactivate your account?</h5>
                        <p class="mb-0">Once you deactivate your account, there is no going back. Please be certain.</p>
                    </div>
                </div>
                <form onsubmit="return false;" autocomplete="off" id="form_deactivate">
                    <div class="form-check my-8">
                        <input class="form-check-input" type="checkbox" name="deactivate" id="deactivate" />
                        <label class="form-check-label" for="deactivate">I confirm my account deactivation</label>
                    </div>
                    <button type="submit" class="btn btn-danger" disabled id="deactivateBtn">
                        Deactivate Account
                    </button>
                </form>
            </div>
        </div>
    @endif

    <div id="container_modal"></div>
@endsection

@section('page-js')
    <script>
        $(document).ready(function() {
            $('#btnSubmit').on('click', function(event) {
                let form = new FormData($('#form_update_profile')[0]);

                const formAction = (form) => {
                    $.ajax({
                        url: "{{ url('update-profile') }}",
                        type: "POST",
                        data: form,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.view) {
                                $('#container_modal').html(null);
                                $('#container_modal').html(response.view);
                                $('#modal-profile-update').modal('show');

                                $('#btnConfirmPassword').on('click', function(event) {
                                    form.append('confirm_password', $(
                                        '#confirm_password').val());
                                    formAction(form);
                                });
                            } else {
                                $('#modal-profile-update').modal('hide');
                                showSweetAlert({
                                    title: response?.data?.title ?? 'Success!',
                                    text: response.message,
                                    icon: response?.data?.icon ?? 'success',
                                    showConfirmButton: response?.data
                                        ?.showConfirmButton
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(response) {
                            for (let form_data in response.responseJSON.errors) {
                                $(`[name="${form_data}"]`)
                                    .addClass("is-invalid")
                                    .parents(".form-input")
                                    .find(".invalid-feedback")
                                    .html(response.responseJSON.errors[form_data][0])
                                    .addClass("d-block");
                            }
                        }
                    });
                }

                formAction(form);
            });

            @if (!auth()->user()->hasRole('Super Admin'))
                $('#form_deactivate').on('submit', function(event) {
                    event.preventDefault();
                    let form = new FormData(this);

                    $.ajax({
                        url: "{{ route('profile.deactivate') }}",
                        type: "POST",
                        data: form,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            showSweetAlert({
                                title: response?.data?.title ?? 'Success!',
                                text: response.message,
                                icon: response?.data?.icon ?? 'success',
                                showConfirmButton: response?.data?.showConfirmButton
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            showSweetAlert({
                                title: response?.data?.title ?? 'Error!',
                                text: response.responseJSON.message,
                                icon: response?.data?.icon ?? 'error',
                                showConfirmButton: response?.data?.showConfirmButton
                            });
                        }
                    });
                });
            @endif
        });

        function showPass(div) {
            let login = div.parents('.input-group').find('input')
            let icon = div

            if (login.attr('type') === "password") {
                login.attr('type', 'text');
            } else {
                login.attr('type', 'password');
            }

            if (icon.hasClass('ti ti-eye-off')) {
                icon.toggleClass('ti-eye-off ti-eye');
            } else {
                icon.toggleClass('ti-eye ti-eye-off');
            }
        }

        $(document).on('hidden.bs.modal', '#modal-profile-update', function(e) {
            $('#container_modal').html(null);
        });

        let accountUserImage = document.getElementById('uploadedAvatar');
        const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

        if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
        }

        $('#deactivate').on('change', function() {
            if ($(this).is(':checked')) {
                $('#deactivateBtn').prop('disabled', false);
            } else {
                $('#deactivateBtn').prop('disabled', true);
            }
        });
    </script>
@endsection
