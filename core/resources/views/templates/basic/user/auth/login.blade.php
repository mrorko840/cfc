@extends($activeTemplate . 'layouts.auth')

@section('content')
    @php
        $authBackground = getContent('auth_page.content', true)->data_values;
    @endphp

    <body class="body-scroll d-flex flex-column h-100 menu-overlay">




        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">

            <!-- Fixed navbar -->
            <header class="header">
                <div class="row">
                    <div class="col-auto px-0">
                        <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                            <span class="material-icons">keyboard_arrow_left</span>
                        </button>
                    </div>
                    <div class="text-left col align-self-center">

                    </div>
                    <div class="ml-auto col-auto align-self-center">
                        <a href="{{ route('user.register') }}" class="text-white">
                            Sign up
                        </a>
                    </div>
                </div>
            </header>

            <form method="POST" action="{{ route('user.login') }}" class="login-form mt-50 verify-gcaptcha">
                @csrf
                <div class="container h-100 text-white">
                    <div class="row h-100">
                        <div class="col-12 align-self-center mb-4">
                            <div class="row justify-content-center">
                                <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                    <h2 class="font-weight-normal mb-5">Login into<br>your account</h2>
                                    <div class="form-group float-label active">
                                        <input type="text" class="form-control text-white" value="{{ old('username') }}"
                                            name="username" required>
                                        <label class="form-control-label text-white">Username/Email</label>
                                    </div>
                                    <div class="form-group float-label position-relative">
                                        <input type="password" class="form-control text-white" name="password" required>
                                        <label class="form-control-label text-white">Password</label>
                                    </div>
                                    <p class="text-right"><a href="{{ route('user.password.request') }}"
                                            class="text-white">Forgot Password?</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </main>

        <!-- footer-->
        <div class="footer no-bg-shadow py-3">
            <div class="row justify-content-center">
                <div class="col">
                    <button type="submit" id="recaptcha"
                        class="btn btn-default rounded btn-block">@lang('Login Now')</button>
                </div>
            </div>
        </div>

        </form>


    </body>






    {{-- <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="{{ route('user.register') }}" class="headerButton">
                <div class="btn btn-sm btn-success">Register</div>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div align="center" class="container">
            <div class="section mt-2 text-center bg-primary rounded-pill p-1 w-75 shadow">
                <h1 class="text-white">Log in</h1>
                <h4 class="text-info">Fill the form to log in</h4>
            </div>
        </div>
        <div class="section mb-5 p-2">

            <form class="action-form mt-50 loginForm" action="{{ route('user.login') }}" method="post">
                @csrf
                <div class="card bg-primary">
                    <div class="card-body pb-1">


                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label text-white">Username</label>
                                <input type="username" name="username" class="form-control text-warning"
                                    placeholder="@lang('Your Username')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label text-white">Password</label>
                                <input type="password" name="password" class="form-control text-warning"
                                    placeholder="@lang('Your Password')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="cmn--form--group form-group mt-3">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="checkgroup text--white d-flex align-items-center">
                                <input type="checkbox" class="border-0 form--checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="m-0 pl-2 text-dark">@lang('Remember Me')</label>
                            </div>
                            <a href="{{ route('user.password.request') }}" class="text--base">@lang('Forget Password?')</a>
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center">

                </div><!-- form-group end -->
                <div class="container bg-dark p-1 rounded">
                    <div class="cmn--form--group form-group col-md-12 google-captcha">
                        @php echo loadReCaptcha() @endphp
                    </div>
                    @include($activeTemplate . 'partials.custom_captcha')
                </div>
                <div class="form-button-group  transparent">
                    <button type="submit" class="btn btn-success btn-block btn-lg cmn-btn">Log in</button>
                </div>



            </form>
        </div>

    </div>
    <!-- * App Capsule --> --}}

@endsection

@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span class="text-danger">@lang('Captcha field is required.')</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
