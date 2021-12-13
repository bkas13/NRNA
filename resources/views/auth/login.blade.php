<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>NRN - Login Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('panel/assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('panel/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('panel/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('panel/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/assets/css/forms/switches.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.min.css"
        integrity="sha512-HPSfJxnyVYJb4v9afT3fXvs0mXvdg/C7eYxBl1EYS7uQHuCU/0lSGhaH9o23Tw8FofBiGQfFWzMYD9TqK8tv/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="form">


    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="___class_+?6___">Sign In</h1>
                        <p class="___class_+?7___">Log in to your account to continue.</p>
                        <form class="text-left" action="{{ route('auth.loginSubmit') }}" method="POST">
                            @csrf
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="email"> EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="e.g johndoe123@gmail.com">
                                    @error('email')
                                        <span class="alert alert-danger">{{ $messages }}</span>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        {{-- <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">Forgot
                                            Password?</a> --}}
                                    </div>
                                    @error('password')
                                        <span class="alert alert-danger">{{ $messages }}</span>
                                    @enderror
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------------TOASTR SCRIPT------------------------ --}}
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.min.js"
        integrity="sha512-i5xofbBta9oP3xclkdj0jO68kXE1tPeN8Jf3rwzsbwNrpFVifjhklWi8zMOOUscuMQaCPyIXl0TMWFjGwBaJxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> {!! Toastr::message() !!}
    {{-- ----------------------------END OF TOASTR SCRIPT------------------------ --}}

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('panel/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('panel/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('panel/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!} --}}
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('panel/assets/js/authentication/form-2.js') }}"></script>

</body>

</html>
