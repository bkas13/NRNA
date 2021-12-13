@extends('front.layouts.master')

@push('styles')
@endpush

@section('content')

    <div class="main_content">
        <div class="container">
            <div class="single_event_page">
                <div class="single_event_page_content">
                    <div class="single_event_page_title">{{ $news->title }}</div>
                    <div class="single_event_page_date">{{ $news->created_date() }} | By: <a href="{{route('front.userHome',[$currentUser->username])}}">{{$currentUser->name}}</a></div>
                    <div class="single_event_page_imgwrap">
                        <img src="{{ getMediaUrl($news->featureImage->path ?? 'front/images/banner.jpg') }}"
                            alt="{{ $news->title }}" />
                    </div>
                    <div class="single_event_page_short">
                        @if (strpos($news->description, '<p>') !== false)
                            {!! substr($news->description, strpos($news->description, '<p'), strpos($news->description, '</p>') + 4) !!}
                        @else
                            {!! $news->description !!}
                        @endif
                    </div>
                    @if (isset($news->gallery) && $news->gallery->count() > 0)
                        <div class="container">
                            <div class="singleEventSlider">
                                @foreach($news->gallery as $image)
                                    <div>
                                        <div class="slider_imgwrapper">
                                            <img src="{{getMediaUrl($image->path)}}" alt="{{$news->title.'-'.$image->id}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="single_event_page_long">
                        {!! substr($news->description, strpos($news->description, '</p>') + 4) !!}
                    </div>
                </div>
                <div class="single_event_page_sidebar">
                    <div class="recent_events">
                        <div class="recent_events_title">Recent News</div>
                        @if($recentNews->count() > 0)
                            @foreach($recentNews as $news)
                                <a href="{{route('front.singleNews',[$currentUser->username,$news->slug])}}" class="recent_events_item">
                                    <div class="img_wrapper">
                                        <img src="{{ getMediaUrl($news->featureImage->path ?? 'front/images/banner.jpg') }}"
                            alt="{{ $news->title }}" />
                                    </div>
                                    <div class="item_content">
                                        <div class="item_content_title">{{$news->title}}</div>
                                        <div class="item_content_date">{{$news->created_date()}}</div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="button_wrap">
                                <a href="{{route('front.news',[$currentUser->username])}}" class="btn-sm">View All</a>
                            </div>
                        @else
                            <div class="button_wrap">
                                <h3 class="text-center">No News available.</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        // $(".singleEventSlider").slick({
        //     centerMode: true,
        //     centerPadding: "-10px",
        //     autoPlay: true,
        //     slidesToShow: 3,
        //     responsive: [{
        //             breakpoint: 768,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: "40px",
        //                 slidesToShow: 3,
        //             },
        //         },
        //         {
        //             breakpoint: 480,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: "40px",
        //                 slidesToShow: 1,
        //             },
        //         },
        //     ],
        // });
        $('.singleEventSlider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

    </script>
@endpush
