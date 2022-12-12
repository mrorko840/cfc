@extends($activeTemplate . 'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body text-center">

                        <!-- Reffer Copy -->
                        <div class="row px-3 mb-2 align-items-center justify-content-center">
                            <div class="col px-0">
                                <input type="text" name="key" value="{{ route('user.refer.register', [Auth::user()->id + 1000]) }}"
                                    class="form-control form-select" id="referralURL" readonly>
                            </div>
                            <div class="col-auto px-0">
                                <a href="javascript:void(0)" class="btn btn-warning border-custom copytext" id="copyBoard"> Copy </a>
                            </div>
                        </div>


                        <b>LEVEL - {{ $levelNo }} </b>
                        <div class="text-left  mb-2">
                            @for ($i = 1; $i <= $lev; $i++)
                                <a href="{{ route('user.referral.users', $i) }}" class="btn btn-sm btn-warning border-custom text-white">@lang('Level ' . $i)</a>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>

            {{ showUserLevel(auth()->user()->id, $levelNo) }}

            

        </div>

    </main>

</body>









    {{-- <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));"
        class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">


            <div align="center" class="col pt-2">
                <h4 class="text-light">My Team</h4>
                <b>LEVEL - {{ $levelNo }} </b>
            </div>

        </div>

    </div>


    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-2">
                    @for ($i = 1; $i <= $lev; $i++)
                        <a href="{{ route('user.referral.users', $i) }}" class="cmn--btn btn--sm">@lang('Level ' . $i)</a>
                    @endfor
                </div>
                {{ showUserLevel(auth()->user()->id, $levelNo) }}
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white" scope="col">@lang('SL')</th>
                                <th class="text-white" scope="col">@lang('Username')</th>
                                <th class="text-white" scope="col">@lang('Joined At')</th>
                                <th class="text-white" scope="col">@lang('First Deposit')</th>
                                <th class="text-white" scope="col">@lang('Super Agent')</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ showUserLevel(auth()->user()->id, $levelNo) }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section> --}}

@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.copytext').on('click', function() {
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);
    </script>
@endpush
