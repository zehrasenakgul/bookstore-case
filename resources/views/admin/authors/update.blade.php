@extends('layouts.backend')
@section('content')

    <div class="layout-px-spacing">

        <div class=" layout-top-spacing">
            <form class="form-vertical" enctype="multipart/form-data"
                action="{{ url('admin/author/update/' . $author->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">

                {{ csrf_field() }}
                @if ($errors->any())
                    @foreach ($errors->all as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group mb-4">
                    <label class="control-label">Yazar Adı:</label>
                    <input type="text" name="name" value="{{ $author->name }}" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label class="control-label">Aktif/Pasif</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1" required>
                        <option value="1" @if ($author->status == '1') selected @endif>Aktif</option>
                        <option value="0" @if ($author->status == '0') selected @endif>Pasif</option>
                    </select>
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
