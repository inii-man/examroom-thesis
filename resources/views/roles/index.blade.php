@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Configuration /</span> Roles & Permission</h4>
        </div>
    </div>
    <p class="mb-6">
        A role provided access to predefined menus and features so that depending on <br />
        assigned role an administrator can have access to what user needs.
    </p>

    <div class="row g-6 mb-6" id="role-container">
        {{-- Role Cards --}}
    </div>
    @include('roles.modal')
@endsection

@section('page-js')
    <script>
        //Routes
        @php
            $managePermission = 'role.manage';
        @endphp
        const routeCard = "{{ route('roles.card') }}";
        const routeStore = "{{ route('roles.store') }}";
        const routeUpdate = "{{ route('roles.update', ['role' => ':role']) }}";
        const routeEdit = "{{ route('roles.edit', ['role' => ':role']) }}";
        const routeParam = "role"
        //Modal
        const AddTitle = "Add New Role";
        const EditTitle = "Edit Role";
        //Cards
        const cardContainerId = "#role-container";
        //Change above const value for faster development

        $(document).ready(function() {
            cards();
        })

        // Callback Function

        function afterAction(response) {
            $('#modal-add').modal('hide');
            cards();
        }

        // Cards Function

        function cards() {
            $.ajax({
                type: 'GET',
                url: routeCard,
                success: function(response) {
                  $(cardContainerId).html(response);
                  $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        }

        // Modal Function

        function edit(e) {
            let id = e.attr('data-id');

            let action = routeUpdate.replace(`:${routeParam}`, id);
            var url = routeEdit.replace(`:${routeParam}`, id);
            let modal = $('#modal-add');

            modal.find(".modal-title").html(EditTitle);
            modal.find('form').attr('action', action);
            modal.find('input[name="_method"]').val("PUT");
            modal.find('input[id="id"]').val(id);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#role-name').val(response.name);
                    $.each(response.permissions, function(key, value) {
                        $(`#check-${value.name.replace(/\./g, '-')}`).prop('checked', true);
                    });
                }
            });
        }

        function copyRole(e) {
            let id = e.attr('data-id');
            let url = routeEdit.replace(`:${routeParam}`, id);
            let modal = $('#modal-add');

            modal.find(".modal-title").html(AddTitle);
            modal.find('form').attr('action', routeStore);
            modal.find('input[name="_method"]').val("POST");
            modal.find('input[id="id"]').val(null);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#role-name').val(response.name);
                    $.each(response.permissions, function(key, value) {
                        $(`#check-${value.name.replace(/\./g, '-')}`).prop('checked', true);
                    });
                }
            });
        }

        $('#checkAll').on('change', function() {
            let checked = $(this).prop('checked');
            $('input[name="permissions[]"]').prop('checked', checked);
        });

        $('#modal-add').on('hide.bs.modal', function() {
            $('#modal-add').find('input[name="_method"]').val("POST");
            $('#modal-add').find('input[id="id"]').val(null);

            $('#modal-add').find(".modal-title").html(AddTitle);
            $('#modal-add').find('form').attr('action', routeStore);
        });
    </script>
@endsection
