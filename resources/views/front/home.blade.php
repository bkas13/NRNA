@extends('front.layouts.master')

@section('content')

    <div class="home-slick">
        @if (isset($context->bannerData) && $context->bannerData->count() > 0)
            @foreach ($context->bannerData as $banner)
                <div>
                    <section class="banner">

                        <div class="banner_item {{$banner->title != '' ? 'overlay' : ''}} " style="
                                                background-image: url('{{ isset($banner->banner_image) ? getMediaUrl($banner->banner_image->path) : asset('front/images/banner.jpg') }}');
                                                background-position: center;
                                                background-size: cover;
                                              ">
                            <div class="container">
                                <div class="banner_wrapper">
                                    <div>
                                        <h1>{{ $banner->title }}</h1>
                                        <div class="description">
                                            {{ $banner->subtitle }}
                                        </div>
                                        @if($banner->link)
                                            <div class="button_wrapper">
                                                <a href="{{$banner->link}}" target="_blank" class="btn-lg">View</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            @endforeach
        @else
            @include('front.defaultSlider')
        @endif
    </div>

    <div id="main">
        <section class="tagline">
            <div class="container">
                <div class="tagline_title">
                    {{ isset($context->siteSettings['tagline']) ? strip_tags($context->siteSettings['tagline']) : '' }}
                </div>
                <div class="tagline_name">-
                    {{ isset($context->siteSettings['tagline_author']) ? $context->siteSettings['tagline_author'] : 'Author' }}
                </div>
            </div>
        </section>
        <section class="about" id="about_main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xl-5">
                        <div class="img_container text-center">
                            {{-- @dd($context->siteSettingImages->about_image->path) --}}
                            <img src="{{ isset($context->siteSettingImages->about_image) ? getMediaUrl($context->siteSettingImages->about_image->path) : asset('front/images/about.png') }}"
                                alt="" />
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-7" id="about-section">
                        <div class="about_title">About</div>
                        <div class="about_description">
                            <p>
                                {!! isset($context->siteSettings['about']) ? $context->siteSettings['about'] : 'About Data Not Added' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="candidate_tabs">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#menu0">Candidates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">News & Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">NCC</a>
                </li>
            </ul>
            <div class="candidate_tabs_wrapper">
                <div class="container">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="menu0">
                            <div class="political_wrapper">
                                <div class="row">
                                    @foreach ($individuals as $candidate)
                                        <div class="col-md-4">
                                            <a href="{{ route('front.userHome', $candidate->username) }}"
                                                class="political_item">
                                                <div class="img_container">
                                                    <img src="{{ $candidate->regionalMaster && $candidate->regionalMaster->feature_image ?
                                                        getMediaUrl($candidate->regionalMaster->feature_image->path) : asset('front/images/politicalparty1.png') }}"
                                                        alt="" />
                                                </div>
                                                <div class="political_item_title text-center">{{ $candidate->name }}</div>
                                                {{-- <div class="political_item_subtitle">
                                                    {{$candidate->}}
                                                </div> --}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <div class="row">
                                @if (isset($context->recentNews) && $context->recentNews->count() > 0)
                                    @foreach ($context->recentNews as $news)
                                        <div class="col-md-6">
                                            <div class="event_card_title">{{ $news->title }}</div>
                                            <div class="event_card">
                                                <div class="event_card_content">
                                                    <div class="event_card_date">
                                                        {{ $news->created_date() }}
                                                    </div>
                                                    <div class="event_card_description">
                                                        {{ $news->excerpt }}
                                                        {{ $news->moreText ? '.....' : '' }}
                                                    </div>
                                                    <a class="btn-sm"
                                                        href="{{ route('front.singleNews', [$news->user->username, $news->slug]) }}">
                                                        Read More
                                                    </a>
                                                </div>
                                                <div class="img_wrapper">
                                                    <img src="{{ $news->featureImage ? getMediaUrl($news->featureImage->path) : asset('front/images/news1.jpg') }}"
                                                        alt="{{ $news->title }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <h3 class="text-center">No News available.</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu2">
                            <div class="political_wrapper">
                                <div class="row">
                                    @foreach ($ncc as $regional)
                                        <div class="col-md-4">
                                            <a href="{{ route('front.userHome', $regional->username) }}"
                                                class="political_item">
                                                <div class="img_container">
                                                    <img src="{{ $regional->regionalMaster && $regional->regionalMaster->feature_image ?
                                                        getMediaUrl($regional->regionalMaster->feature_image->path) : asset('front/images/politicalparty1.png') }}"
                                                        alt="" />
                                                </div>
                                                <div class="political_item_title text-center">{{ $regional->name }}</div>
                                                {{-- <div class="political_item_subtitle">
                                                    The leader of a group of people or an organiztion.
                                                </div> --}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="political">
            <div class="container">
                <div class="political_title">NCC</div>
                <div class="political_wrapper">
                    <div class="row">
                        @foreach ($ncc as $regional)
                            <div class="col-md-4">
                                <a href="{{ route('front.userHome', $regional->username) }}" class="political_item">
                                    <div class="img_container">
                                        <img src="{{asset($regional->regionalMaster->region_logo->path??'front/images/politicalparty1.png')}}" alt="" />
                                    </div>
                                    <div class="political_item_title">{{$regional->name}}</div>
                                    <div class="political_item_subtitle">
                                        The leader of a group of people or an organiztion.
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="contact_page" id="contact_main">
            <div class="contact_page_title">Contact Us</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 offset-md-1">
                        <div class="contact_content">
                            <div class="contact_content_title">Contact Information</div>
                            <div class="contact_content_subtitle">
                                Fill up the form to get in touch with the candidate and fill
                                up the form.
                            </div>
                            <ul class="contact_list">
                                <li>
                                    <i class="fa fa-map-marker-alt"></i>
                                    <span
                                        class="contact_list_item">{{ isset($context->siteSettings['address']) ? $context->siteSettings['address'] : '' }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span class="contact_list_item">
                                        {{ isset($context->siteSettings['phone']) ? $context->siteSettings['phone'] : '' }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span
                                        class="contact_list_item">{{ isset($context->siteSettings['email']) ? $context->siteSettings['email'] : '' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="{{ route('front.homeContact') }}" class="contact_form">
                            @csrf
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name"
                                    required />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter your email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Enter your phone number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="message" class="form-control" id="" cols="30" rows="4"
                                    required></textarea>
                            </div>
                            <div class="btn_container">
                                <button type="submit" class="btn-md">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>


@endsection

@push('scripts')

    <script>
        window.onscroll = function() {
            myFunction();
        };

        // Get the navbar
        var navbar = document.getElementById("nav");

        // Get the offset position of the navbar

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= 700) {
                navbar.classList.add("navbar_sticky");
            } else {
                navbar.classList.remove("navbar_sticky");
            }
        }
    </script>


    <script>
        $('.home-slick').slick({
            dots: false,
            infinite: true,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2500,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    </script>

@endpush
