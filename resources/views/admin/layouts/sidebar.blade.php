<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">

            <li class="nav-item theme-text">
                <a href="/" class="nav-link"> NRNA </a>
                <h5 class="text-white">Admin</h5>
            </li>
        </ul>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu active">
                <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle">
                    <div class="___class_+?12___">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg><span>Apps</span></div>
            </li>

            <li class="menu">
                <a href="{{ route('admin.user.all') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="___class_+?22___">
                        <i data-feather="user"></i>
                        <span>User Management</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('admin.contact.all') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="___class_+?22___">
                        <i data-feather="mail"></i>
                        <span>Contact</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('admin.settings.bannerIndex') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="___class_+?22___">
                        <i data-feather="image"></i>
                        <span>Banner</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('admin.siteSetting') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="___class_+?22___">
                        <i data-feather="settings"></i>
                        <span>Site Setting</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
