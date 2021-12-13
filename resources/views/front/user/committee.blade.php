@extends('front.layouts.master')

@push('styles')

@endpush

@section('content')

    <div class="main_content">
        <div class="container">
            <div class="candidate_page">
                <div class="candidate_page_banner" style="
                background-image: url('{{getMediaUrl($candidate->candidateBanner->path ??"front/images/banner.jpg")}}');
                background-position: center;
                background-size: cover;
              "></div>
                <div class="candidate_page_lower_banner">
                    <div class="candidate_page_lower_banner_wrapper">
                        <div class="img_container">
                            <img src="{{getMediaUrl($candidate->profileImage->path ?? 'front/images/candidate1.png')}}" alt="" />
                        </div>
                        <div class="candidate_name">{{$candidate->fullName()}}</div>
                        <div class="candidate_designation">{{$candidateData['designation'] ?? ''}}</div>
                    </div>
                </div>
                <div class="candidate_page_wrapper">
                    <div class="candidate_page_sidebar">
                        <ul class="contact_list">
                            <li>
                                <i class="fa fa-map-marker-alt"></i>
                                <span class="contact_list_item">{{$candidateData['address'] ?? ''}}</span>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <span class="contact_list_item">{{$candidateData['phone'] ?? $candidate->phone}}</span>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <span class="contact_list_item">{{$candidateData['email'] ?? $candidate->email}}</span>
                            </li>
                        </ul>
                        <div class="social_links">
                            <a href="{{$candidateData['facebook'] ?? '#'}}" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="{{$candidateData['instagram'] ?? '#'}}" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="{{$candidateData['twitter'] ?? '#'}}" target="_blank"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="recent_events">
                            <div class="recent_events_title">Recent Events</div>
                            @if(isset($recentNews) && $recentNews->count() > 0)
                                @foreach($recentNews as $news)
                                    <a href="{{route('front.singleNews',[$currentUser->username, $news->slug])}}" class="recent_events_item">
                                        <div class="img_wrapper">
                                            <img src="{{$news->featureImage ? getMediaUrl($news->featureImage->path) : asset('front/images/news1.jpg')}}" alt="" />
                                        </div>
                                        <div class="item_content">
                                            <div class="item_content_title">{{$news->title}}</div>
                                            <div class="item_content_date">{{ $news->created_date() }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <h5 class="text-center">No recent news.</h3>
                            @endif
                            <div class="button_wrap">
                                <a href="{{route('front.news',[$currentUser->username])}}" class="btn-sm">View More</a>
                            </div>
                        </div>
                    </div>

                    <div class="candidate_page_content">
                        @if(isset($candidateData['dynamic_description']))
                            @foreach($candidateData['dynamic_description'] as $data)
                                <div class="candidate_page_content_title">{{$data->title}}</div>
                                <div class="candidate_page_content_description">
                                    {!!$data->description!!}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

@endpush
