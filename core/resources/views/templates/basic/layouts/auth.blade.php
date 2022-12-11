<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> {{ $general->sitename(__($pageTitle)) }}</title>

    @include('partials.seo')

    <!-- Custom Css -->

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset($activeTemplateTrue . 'assets/manifest.json') }}" />
    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset($activeTemplateTrue . 'assets/css/style.css') }}" rel="stylesheet" id="style">

    <style>
        a {
            text-decoration: none;
        }

        .bg-gradiant {
            background-image: linear-gradient(to bottom right, #ffffff36, #00000081) !important;
            color: #FFF;
        }

        .bg-gradiant-alt {
            background-image: linear-gradient(to bottom right, #00000081, #ffffff36) !important;
            color: #FFF;
        }

        .bg-purple {
            background: #560087 !important;
            color: #FFF;
        }

        .bg-orange {
            background: #f76000 !important;
            color: #FFF;
        }

        .btn-mini {
            font-size: 0.6rem;
            line-height: 1;
            border-radius: 80.19999999999999rem;
        }

        .btn-mini2 {
            font-size: 0.7rem;
            line-height: 1.7;
            border-radius: 80.19999999999999rem;
        }

        .border-custom {
            border-radius: 1.3rem !important;
        }

        .avatar.avatar-200 {
            height: 200px;
            line-height: 200px;
            width: 200px;
        }

        /* custom */

        .single-select.active {
            position: relative;
            border-color: #e6a25d;
        }
        .single-select {
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            border-radius: 8px;
        }

    </style>

    {{-- <!--CSS -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php?color1='.$general->base_color)}}">
    
    <!--CSS new-->
    <link rel="icon" type="image/png" href="{{ asset(imagePath()['logoIcon']['path'] .'/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($activeTemplateTrue.'/assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'/assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset($activeTemplateTrue.'/__manifest.json') }}"> --}}



    @stack('style-lib')

    @stack('style')
</head>
<body>

    @stack('fbComment')

    <!--<div class="preloader">-->
    <!--    <div class="ball"></div>-->
    <!--</div>-->
    
    <!-- loader -->
    <div id="loader">
        <div class="loader-n">
            <div class="l-one"></div>
            <div class="l-two"></div>
          </div>
    </div>
    <!-- * loader -->

    <a href="javascript:void(0)" class="scrollToTop"><i class="las la-angle-up"></i></a>
    <div class="overlay"></div>


    @yield('content')


    @php
        $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
    @endphp

    @if(@$cookie->data_values->status && !session('cookie_accepted'))
        <div class="cookie-remove">
            <div class="cookie__wrapper bg--section">
                <div class="container">
                    <div class="flex-wrap align-items-center justify-content-between">
                        <h4 class="title">@lang('Cookie Policy')</h4>
                        <div class="txt my-2">
                            @php echo @$cookie->data_values->description @endphp
                        </div>
                        <div class="button-wrapper">
                            <button class="cmn--btn policy cookie">@lang('Accept')</button>
                            <a class="cmn--btn" href="{{ @$cookie->data_values->link }}" target="_blank" class=" mt-2">@lang('Read Policy')</a>
                            <a href="javascript:void(0)" class="btn--close cookie-close"><i class="las la-times"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>


    <!--**** custom script start ****-->
    <!-- Required jquery and libraries -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/popper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>



    <!-- chart js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/utils.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/chart-js-data.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/color-scheme-demo.js') }}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/pwa-services.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/app.js') }}"></script>
    <!--***** custom script end *****-->
    
    
    {{-- <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="{{ asset($activeTemplateTrue.'/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset($activeTemplateTrue.'/assets/js/plugins/splide/splide.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset($activeTemplateTrue.'/assets/js/base.js') }}"></script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script> --}}

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')


    <script>
        (function ($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val() ;
            });

            $('.cookie').on('click',function () {

                var url = "{{ route('cookie.accept') }}";

                $.get(url,function(response){

                    if(response.success){
                        notify('success',response.success);
                        $('.cookie-remove').html('');
                    }
                });
            });

            $('.cookie-close').on('click',function () {
                $('.cookie-remove').html('');
            });
        })(jQuery);
    </script>

</body>
</html>
