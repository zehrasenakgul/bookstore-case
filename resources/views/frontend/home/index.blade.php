@extends('layouts.frontend')
@section('content')

    <section class="section section-padding-equal project-column-4 pt_md--80 pt_sm--60">
        <div class="container">
            <div class="section-heading heading-left">
                <h2 class="title">Tüm Kitaplar</h2>
            </div>
            @if (count($books) > 0)
                <div class="axil-isotope-wrapper">
                    <div class="row isotope-list">
                        @foreach ($books as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 project branding">
                                <div class="project-grid">
                                    <div class="thumbnail">
                                        <a href="{{ url('books/' . $item->slug) }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a
                                                href="{{ url('books/' . $item->slug) }}">{{ $item->name }}</a>
                                        </h5>
                                        <span class="subtitle">{{ $item->author->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h6>Kayıtlı kitap bulunamadı</h6>
            @endif

        </div>
    </section>
@endsection

@push('customJs')
@endpush

@push('customCss')
@endpush
