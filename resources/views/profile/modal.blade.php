<div class="modal fade" id="modal-profile-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Confirm Change</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="confirm_password_form" onsubmit="return false;" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-input">
                        <label class="form-label" for="confirm_password">Current Password</label>
                        <input type="password" id="confirm_password" class="form-control" placeholder="Current Password"
                            name="confirm_password" />
                        <div id="if" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                        aria-label="close">Cancel</button>
                    <button id="btnConfirmPassword" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
