<div class="Navbar {{ checkFixed() }}" id="nav">
    <div class="container">
        <div class="Navbar_wrapper">
            @if (isHomePage())
                <div class="logo_wrapper">
                    <img style="height:70px; width:auto;"
                        src="{{ isset($context->siteSettingImages->region_logo) ? getMediaUrl($context->siteSettingImages->region_logo->path) : '' }}">
                </div>

                <ul class="nav_wrapper">
                    <li class="d-none d-lg-block"><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="d-none d-lg-block"><a href="{{ url('/') }}#about_main">About</a></li>
                    <li class="d-none d-lg-block">
                        <a href="{{ url('/') }}#contact_main">Contact</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.login') }}"
                            class="btn-md">{{ Auth::check() ? 'Dashboard' : 'Sign In' }}</a>
                    </li>
                    <li class="d-block d-lg-none">
                        <span onclick="openNav()"><i class="fas fa-bars fa-bars-color"></i></span>
                    </li>
                </ul>
            @else
                <div class="logo_wrapper">
                    <img style="height:70px; width:auto;" src="{{ getMediaUrl(personal_logo($currentUser) ?? '') }}"
                        alt="logo">
                </div>
                <ul class="nav_wrapper">

                    <li class="d-none d-lg-block">
                        <a href="{{ route('front.userHome', [$currentUser->username]) }}">Home</a>
                    </li>
                    <li class="d-none d-lg-block"><a
                            href="{{ route('front.userAbout', [$currentUser->username]) }}">About</a></li>
                    <li class="d-none d-lg-block">
                        <a href="{{ route('front.news', [$currentUser->username]) }}">News & Events</a>
                    </li>
                    @if ($currentUser->is_individual == true)
                        <li class="d-none d-lg-block">
                            <a href="{{ route('front.individualProfile', [$currentUser->username]) }}">Profile</a>
                        </li>
                    @endif
                    <li class="d-none d-lg-block">
                        <a href="{{ route('front.userContact', [$currentUser->username]) }}">Contact</a>
                    </li>
                    <li class="d-none d-lg-block">
                        <a href="{{ getUserSettingMeta($currentUser, 'delegate_url') ?? '#' }}">Delegates</a>
                    </li>
                    <li><a href="{{ route('auth.login') }}"
                            class="btn-md">{{ Auth::check() ? 'Dashboard' : 'Sign In' }}</a></li>

                    <li class="d-block d-lg-none">
                        <span onclick="openNav()"><i class="fas fa-bars fa-bars-color"></i></span>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @if (isHomePage())
        <a href="{{ route('front.home') }}">Home</a>
        <a href="#about_main">About</a>
        <a href="#contact_main">Contact</a>
    @else
        <a href="{{ route('front.userHome', [$currentUser->username]) }}">Home</a>
        <a href="{{ route('front.userAbout', [$currentUser->username]) }}">About</a></li>
        <a href="{{ route('front.news', [$currentUser->username]) }}">News & Events</a>
        <a href="{{ route('front.userContact', [$currentUser->username]) }}">Contact</a>
        @if ($currentUser->is_individual == true)
            <a href="{{ route('front.individualProfile', [$currentUser->username]) }}">Profile</a>
        @endif

        <a href="{{ getUserSettingMeta($currentUser, 'delegate_url') ?? '#' }}">Delegates</a>
    @endif
</div>
