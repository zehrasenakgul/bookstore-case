@extends('layouts.frontend')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-6 text-right">
                <strong>{{ __('lang.switch') }}</strong>
            </div>
            <div class="col-md-4 mb--50">
                <select class="form-control changeLang">
                    @foreach ($langs as $item)
                        <option value="{{ $item->code }}" {{ session()->get('locale') == $item->code ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <section class="section project-column-4 pt_md--80 pt_sm--60">
        <div class="container">
            <div class="section-heading heading-left">
                <h2 class="title">{{ __('lang.title') }}</h2>
            </div>
            @if (count($books) > 0)
                <div class="axil-isotope-wrapper">
                    <div class="row isotope-list">
                        @foreach ($books as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 project branding">
                                <div class="project-grid">
                                    <div class="thumbnail">
                                        <a href="{{ url('books/' . $item->translation[0]->slug) }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a
                                                href="{{ url('books/' . $item->translation[0]->slug) }}">{{ $item->translation[0]->name }}</a>
                                        </h5>
                                        <span class="subtitle">{{ $item->author->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h6>{{ __('lang.not-found') }}</h6>
            @endif

        </div>
    </section>
@endsection

@push('customJs')
    <script type="text/javascript">
        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function() {
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script>
@endpush

@push('customCss')
@endpush
