@extends($activeTemplate . 'layouts.frontend')
@section('content')
@php
    $user = Auth::user();
@endphp


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">
    <!-- Top navbar -->
    {{-- @include($activeTemplate . 'includes.side_nav') --}}

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <form action="{{route('user.withdraw.money')}}" method="post">
            @csrf

        <div class="main-container">
            <div class="container mb-4">
                <p class="text-center text-secondary mb-1">Enter Amount to Add</p>
                <div class="form-group mb-1">
                    <input type="number" step="any" name="amount" value="{{ old('amount') }}" class="form-control large-gift-card" autocomplete="off" placeholder="00.00" required>
                </div>
                <p class="text-center text-secondary mb-4">Available: {{ $general->cur_sym }} {{ showAmount($user->balance) }} </p>
                <div class="form-group position-relative" hidden>
                    <div class="bottom-right mb-1 mr-1">
                        <button class="btn btn-sm btn-success rounded">Apply</button>
                    </div>
                    <input type="text" class="form-control" placeholder="Promo Code (optional)">
                </div>
            </div>

            <div class="container mb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="paynow" class="custom-control-input" id="pay3" checked="">
                                    <label class="custom-control-label" for="pay3"></label>
                                </div>
                            </div>

                            <div class="col pl-0">
                                <h6 class="subtitle mb-0">Withdraw via</h6>
                            </div>
                            <div class="col-5">
                                <select style="height: fit-content;" class="form-control form-select p-0 ps-1" name="method_code" required>
                                    <option value="">@lang('Gateway')</option>
                                    @foreach($withdrawMethod as $data)
                                    <option value="{{ $data->id }}" data-resource="{{$data}}"> {{__($data->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-4 preview-details d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush payment-list">
                                    <li style="border-bottom: 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Limit')</span>
                                        <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span class="max fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-bottom: 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Charge')</span>
                                        <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-bottom: 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Receivable')</span> <span><span class="receivable fw-bold"> 0</span> {{__($general->cur_text)}} </span>
                                    </li>
                                    <li style="border-bottom: 0;" class="list-group-item d-none justify-content-between rate-element">

                                    </li>
                                    <li style="border-bottom: 0;" class="list-group-item d-none justify-content-between in-site-cur">
                                        <span>@lang('In') <span class="base-currency"></span></span>
                                        <strong class="final_amo">0</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="container text-center">
                <button type="submit" class="btn btn-default mb-2 mx-auto rounded">Withdraw Money</button>
                {{-- <a href="thank_you.html" class="btn btn-default mb-2 mx-auto rounded">Add Money</a> --}}
            </div>
        </div>

        <div style="height: 70px"></div>

        </form>

        

    </main>



    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')

        
</body>






    <!-- App Capsule -->
    {{-- <div id="appCapsule">

        <div class="bg-primary container pt-4 pb-3 mb-2">
            <div class="row">


                <div class="col-7 pt-1 ps-2">
                    <h5 class="text-light"></h5>
                    <h2 class="text-light">Withdraw</h2>
                    <h6 class="text-light">You can <b> Withdraw</b> your</h6>
                    <h6 class="text-light">earnings.</h6>
                </div>

                <div align="center" class="col-5"><img width="90px"
                        src="https://i.ibb.co/9W8RJsF/2-C3-C64-AE-9627-4024-83-DB-3063-C3-A786-DE-1.png" /></div>

            </div>

        </div>

        <div class="container">

            <div class="col-md-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
            </div>


            @foreach ($withdrawMethod as $data)
                <div class="border-0 mb-4 bg-warning text-white rounded">
                    <div class="p-1">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-40 border-0 bg-white-light rounded-circle text-white">
                                    <ion-icon style="font-size: 20px;" class="align-middle" name="card-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="col-6 pl-0">
                                <p class="mb-1 text-white">Withdraw Money</p>
                                <h6 class="text-white">with {{ $data->name }}</h6>
                            </div>
                            <div align="right" class="col right">
                                <img class="bg-white rounded-circle shadow"
                                    src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $data->image) }}"
                                    width="50px" alt="deposit">
                            </div>
                        </div>
                    </div>
                    <div class="row card-body">
                        <h4 class="mb-0 mt-3 mb-3 text-white card-num">
                            <!--4654 {{ rand(3000, 5000) }} {{ rand(3000, 5000) }} {{ rand(3000, 5000) }}-->
                        </h4>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0 text-white">
                                    {{ showAmount($data->min_amount) }}
                                    - {{ showAmount($data->max_amount) }} {{ $general->cur_text }}
                                </h6>
                                <h6 class="small text-white">Limits</h6>
                            </div>
                            <div class="col-auto align-self-center text-right">
                                <p class="mb-0">

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#withdrawModal"
                                        class="cmn--btn text-center withdraw btn btn-light shadow w-100"
                                        data-id="{{ $data->id }}" data-resource="{{ $data }}"
                                        data-min_amount="{{ showAmount($data->min_limit) }}"
                                        data-max_amount="{{ showAmount($data->max_limit) }}"
                                        data-delay="{{ $data->delay }}"
                                        data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                                        data-percent_charge="{{ showAmount($data->percent_charge) }}"
                                        data-base_symbol="{{ __($general->cur_text) }}">
                                        @lang('Withdraw')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div> --}}


    <!-- Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title method-name text-white" id="withdrawModalLabel">@lang('Withdraw')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <form action="{{ route('user.withdraw.money') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-dark withdrawLimit"></p>
                        <p class="text-danger withdrawCharge"></p>
                        <p class="text-white">
                            Withdrawal will arrive within 5 Minutes due to busy schedule
                            You have not bound a wallet address , please bind a wallet address for withdrawal.
                        </p>
                        <!--<p class="text-info delay"></p>-->

                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control">
                        </div>



                        <div class="form-group">
                            <label>@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control"
                                    onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"
                                    placeholder="0.00" required="" value="{{ old('amount') }}">

                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text addon-bg currency-addon bg-info rounded-end px-2">{{ __($general->cur_text) }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row-12 modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button> --}}
                        <button type="submit" class="col-12 btn btn-success">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    (function ($) {
            "use strict";
            $('select[name=method_code]').change(function(){
                if(!$('select[name=method_code]').val()){
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=method_code] option:selected').data('resource');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                var toFixedDigit = 2;
                $('.min').text(parseFloat(resource.min_limit).toFixed(2));
                $('.max').text(parseFloat(resource.max_limit).toFixed(2));
                var amount = parseFloat($('input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if(amount <= 0){
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                $('.preview-details').removeClass('d-none');

                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('.charge').text(charge);
                if (resource.currency != '{{ $general->cur_text }}') {
                    var rateElement = `<span>@lang('Conversion Rate')</span> <span class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span>`;
                    $('.rate-element').html(rateElement);
                    $('.rate-element').removeClass('d-none');
                    $('.in-site-cur').removeClass('d-none');
                    $('.rate-element').addClass('d-flex');
                    $('.in-site-cur').addClass('d-flex');
                }else{
                    $('.rate-element').html('')
                    $('.rate-element').addClass('d-none');
                    $('.in-site-cur').addClass('d-none');
                    $('.rate-element').removeClass('d-flex');
                    $('.in-site-cur').removeClass('d-flex');
                }
                var receivable = parseFloat((parseFloat(amount) - parseFloat(charge))).toFixed(2);
                $('.receivable').text(receivable);
                var final_amo = parseFloat(parseFloat(receivable)*rate).toFixed(toFixedDigit);
                $('.final_amo').text(final_amo);
                $('.base-currency').text(resource.currency);
                $('.method_currency').text(resource.currency);
                $('input[name=amount]').on('input');
            });
            $('input[name=amount]').on('input',function(){
                var data = $('select[name=method_code]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
</script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.withdraw').on('click', function() {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');
                var delay = $(this).data('delay');

                var withdrawLimit =
                    `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{ __($general->cur_text) }}`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge =
                    `@lang('Charge'): ${fixCharge} {{ __($general->cur_text) }} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.delay').text('@lang('Processing Time'): ' + delay);

                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>
@endpush
