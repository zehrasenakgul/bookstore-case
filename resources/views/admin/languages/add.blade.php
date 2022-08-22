@extends('layouts.backend')
@section('content')

    <div class="layout-px-spacing">

        <div class=" layout-top-spacing">
            <form class="form-vertical" enctype="multipart/form-data" action="{{ url('admin/languages') }}" method="POST">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group mb-4">
                    <label class="control-label">Dil:</label>
                    <input type="text" name="name" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label class="control-label">Kod:</label>
                    <input type="text" name="code" class="form-control">
                    @if ($errors->has('code'))
                        <span class="text-danger text-left">{{ $errors->first('code') }}</span>
                    @endif
                </div>
                <div class="form-group custom-file-container mb-4" data-upload-id="myFirstImage">
                    <label class="control-label">İkon </label><br>
                    <label class="custom-file-container__custom-file">
                        <input type="file" name="icon" class="custom-file-container__custom-file__custom-file-input"
                            accept="image/*">
                        @if ($errors->has('icon'))
                            <span class="text-danger text-left">{{ $errors->first('icon') }}</span>
                        @endif
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                </div>
                <input type="submit" name="submit" value="Ekle" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection

@push('customJs')
    <script src="{{ asset('assets/backend/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
@endpush

@push('customCss')
    <link href="{{ asset('assets/backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
