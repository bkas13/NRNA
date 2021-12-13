@extends('front.layouts.master')

@push('styles')
    <style>
    .slick-prev{
        left: 30px;
        z-index: 9;
    }
    .slick-next{
        right: 30px;
        left: auto;
        z-index: 9;
    }
    </style>
@endpush

@section('content')


    <!-- The slideshow -->
    <div class="home-slick">
        @if (isset($context->bannerData) && $context->bannerData->count() > 0)
            @foreach ($context->bannerData as $banner)
                <div>
                    <section class="banner">
                        <div class="banner_item {{$banner->title != '' ? 'overlay' : ''}} " style="
                                                background-image: url('{{ getMediaUrl($banner->banner_image->path ?? 'front/images/banner.jpg') }}');
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


    @if(isset($context->siteSettings['tagline']) && $context->siteSettings['tagline'] != "")
    <section class="tagline">
        <div class="container">
            <div class="tagline_title">
                {{ isset($context->siteSettings['tagline']) ? strip_tags($context->siteSettings['tagline']) : 'Tagline' }}
            </div>
            <div class="tagline_name">-
                {!! isset($context->siteSettings['tagline_author']) ? $context->siteSettings['tagline_author'] : 'Author' !!}
            </div>
        </div>
    </section>
    @endif
    <section class="about" id="aboutSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xl-5">
                    <div class="img_container text-center">
                        <img src="{{ getMediaUrl($context->siteSettingImages->about_image->path ?? 'front/images/about.png') }}"
                            alt="" />
                    </div>
                </div>
                <div class="col-lg-7 col-xl-7">
                    <div class="about_title">About</div>
                    <div class="about_description">
                        {{-- @dd($context->siteSettings['about']) --}}
                        <p>
                            {!! isset($context->siteSettings['brief_about']) ? $context->siteSettings['brief_about'] : '' !!}
                        </p>
                        @if(isset($context->siteSettings['brief_about']))
                            <p>
                                <a href="{{route('front.userAbout',$currentUser->username)}}" class="btn btn-sm">Read More</a>
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="candidate_tabs" id="news-section">
        <ul class="nav nav-tabs">
            @if ($currentUser->is_regional == true)
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#menu0">Committee</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ $currentUser->is_individual == true ? 'active' : '' }}" data-toggle="tab"
                    href="#menu1">News & Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">NCC</a>
            </li>
            @if ($currentUser->is_individual == true)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Candidates</a>
                </li>
            @endif
        </ul>
        {{-- @dd($currentUser) --}}
        <!-- Tab panes -->
        <div class="candidate_tabs_wrapper">
            <div class="container">
                <div class="tab-content">
                    @if ($currentUser->is_regional == true)
                        <div class="tab-pane container active" id="menu0">
                            <div class="row">
                                @if (isset($context->committee) && $context->committee->count() > 0)
                                    @foreach ($context->committee as $committee)
                                        @include('front.user.userHomeSection.committeeCard')
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <h3 class="text-center">No member available.</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane container {{ $currentUser->is_individual == true ? 'active' : 'fade' }} "
                        id="menu1">
                        <div class="row">
                            @if (isset($context->featuredNews) && $context->featuredNews->count() > 0)
                                @foreach ($context->featuredNews as $news)
                                    @include('front.user.userHomeSection.newsCard')
                                @endforeach
                            @else
                                <div class="col-12">
                                    <h3 class="text-center">No news available.</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu2">
                        <div class="row">
                            @if ($currentUser->is_regional == true)
                                @php $ncc=$currentUser; @endphp
                                @include('front.user.userHomeSection.nccCard')
                            @endif
                            @if (isset($context->otherNcc) && $context->otherNcc->count() > 0)
                                @foreach ($context->otherNcc as $ncc)
                                    @include('front.user.userHomeSection.nccCard')
                                @endforeach
                            @endif
                        </div>
                    </div>

                    @if ($currentUser->is_individual == true)
                        <div class="tab-pane container fade" id="menu3">
                            <div class="row">
                                @if ($currentUser->is_individual == true)
                                    @php $candidate=$currentUser; @endphp
                                    @include('front.user.userHomeSection.candidateCard')
                                @endif
                                @foreach ($context->otherCandidates as $candidate)
                                    @include('front.user.userHomeSection.candidateCard')
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($currentUser->is_individual == true)
        <section class="contact_page" id="contact-section">
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
                                    <span class="contact_list_item">{{ $context->siteSettings['address'] ?? '' }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span class="contact_list_item"> {{ $context->siteSettings['phone'] ?? '' }} </span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span class="contact_list_item">{{ $context->siteSettings['email'] ?? '' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form method="post" action="{{ route('front.userContact.submit', [$currentUser->username]) }}"
                            class="contact_form">
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
    @endif


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
