@extends('layouts.backend')
@section('content')

    <div class="layout-px-spacing">

        <div class=" layout-top-spacing">
            <form class="form-vertical" enctype="multipart/form-data" action="{{ url('admin/authors') }}" method="POST">
                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group mb-4">
                    <label class="control-label">Yazar Adı:</label>
                    <input type="text" name="name" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <label class="control-label">Aktif/Pasif</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <input type="submit" name="submit" value="Ekle" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection

@push('customJs')
@endpush

@push('customCss')
@endpush
