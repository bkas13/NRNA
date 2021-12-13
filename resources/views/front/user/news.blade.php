@extends('front.layouts.master')

@push('styles')

@endpush

@section('content')

    <div class="main_content">

        <section class="all_events">
            <div class="all_events_title">News & Events</div>
            <div class="container">

                <div class="row">
                    @if (isset($allNews) && $allNews->count() > 0)
                        @foreach ($allNews as $news)
                            <div class="col-md-6">
                                <div class="event_card_title">{{ $news->title }}</div>
                                <div class="event_card">
                                    <div class="event_card_content">
                                        <div class="event_card_date">{{ $news->created_date() }}</div>
                                        <div class="event_card_description">
                                            {{ $news->excerpt }}
                                            {{ $news->moreText ? '....' : '' }}
                                        </div>
                                        <a class="btn-sm"
                                            href="{{ route('front.singleNews', [$currentUser->username, $news->slug]) }}">
                                            Read More </a>
                                    </div>
                                    <div class="img_wrapper">
                                        <img src="{{ $news->featureImage ? getMediaUrl($news->featureImage->path) : asset('front/images/news1.jpg') }}"
                                            alt="" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 mt-5 mb-5">
                            <h3 class="text-center">No news available</h3>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')

@endpush
