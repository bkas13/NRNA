@extends('front.layouts.master')

@push('styles')

@endpush

@section('content')


    <div class="main_content">
        <section class="about_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="about_page_title">Who we are</div>
                        <div class="about_page_description">
                            <p>
                                {!! isset($siteSettings['about']) ? $siteSettings['about'] : '' !!}
                            </p>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="img_container">
                            {{-- @dd($siteSettingImages['about_logo']) --}}
                            <img src="{{ getMediaUrl($siteSettingImages->about_image->path ?? '') }}"
                                alt="About image" />
                        </div>
                    </div>
                </div>
            </div>
            <section class="all_events">
                <div class="all_events_title">News & Events</div>
                <div class="container">
                    <div class="row">
                        @if (isset($recentNews) && $recentNews->count() > 0)
                            @foreach ($recentNews as $news)
                                <div class="col-md-6">
                                    <div class="event_card_title">{{ $news->title }}</div>
                                    <div class="event_card">
                                        <div class="event_card_content">
                                            <div class="event_card_date">
                                                {{ $news->created_date() }}
                                            </div>
                                            <div class="event_card_description">
                                                {{ $news->excerpt }}
                                                {{ $news->moreText ? '....' : '' }}
                                            </div>
                                            <a class="btn-sm"
                                                href="{{ route('front.singleNews', [$currentUser->username, $news->slug]) }}">
                                                Read More </a>
                                        </div>
                                        <div class="img_wrapper">
                                            <img src="{{ getMediaUrl($news->featureImage->path ?? 'front/images/news1.jpg') }}"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection

@push('scripts')

@endpush
