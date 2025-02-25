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
            <a href="{{ route('perusahaan.index') }}" class="btn btn-primary">
                <i class="tf-icons ti ti-arrow-left"></i>&nbsp;<span>Back</span>
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Master Data / Light House /</span> Create</h4>
        </div>
    </div>
    <div class="col-xxl">
        <div class="card mb-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Light House</h5>
                <small class="text-muted float-end">{{ $light_house->light_house_name ?? '' }}</small>
            </div>
            <div class="card-body">
                @if (isset($light_house))
                <form action="{{ route('perusahaan.update', ['light_house' => $light_house->light_house_id]) }}"
                    class="default-form" function-callback="afterAction">
                    @method('PUT')
                    <input type="hidden" id="id" name="light_house_id"
                        value="{{ $light_house->light_house_id ?? '' }}" />
                @else
                    <form action="{{ route('perusahaan.store') }}" class="default-form"
                        function-callback="afterAction">
                        <input type="hidden" name="_method" value="POST">
                @endif
                @csrf
                <div class="row mb-6 form-group">
                    <label class="col-sm-2 col-form-label">Light House Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="light_house_name" placeholder="Mercusuar Cikoneng"
                            value="{{ $light_house->light_house_name ?? '' }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-6 form-group">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">Light House Type</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline mt-4">
                            <input class="form-check-input" type="radio" name="light_house_type" value="Land"
                                id="landRadio" @if (isset($light_house) && $light_house->light_house_type == 'Land') checked @endif />
                            <label class="form-check-label" for="landRadio">Land</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="light_house_type" value="Offshore"
                                id="offshoreRadio" @if (isset($light_house) && $light_house->light_house_type == 'Offshore') checked @endif />
                            <label class="form-check-label" for="offshoreRadio">Offshore</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-6 form-group">
                    <label class="col-sm-2 col-form-label">Light House Structure</label>
                    <div class="col-sm-10">
                        <select class="form-select select2" name="light_house_structure"
                            data-placeholder="Select Structure">
                            <option></option>
                            @foreach ($light_house_structure as $structure)
                                <option @if (isset($light_house) && $light_house->light_house_structure == $structure) selected @endif>
                                    {{ $structure }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-6 form-group">
                    <label class="col-sm-2 col-form-label">Light House Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="light_house_address" placeholder="Jln Mars Sel. X No. 19B">{{ $light_house->light_house_address ?? '' }}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function afterAction(response) {
            setTimeout(() => {
                window.location.href = "{{ route('perusahaan.index') }}";
            }, 1500);
        }
    </script>
@endsection
