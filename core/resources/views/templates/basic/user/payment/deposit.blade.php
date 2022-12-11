@extends($activeTemplate . 'layouts.frontend')

@section('content')

@php
    $user = Auth::user();
@endphp


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">
    <!-- Top navbar -->
    {{-- @include($activeTemplate . 'includes.side_nav') --}}

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <form action="{{route('user.deposit.insert')}}" method="post">
            @csrf
            <input type="hidden" name="method_code">
            <input type="hidden" name="currency">

        <div class="main-container">
            <div class="container mb-4">
                <p class="text-center text-secondary mb-1">Enter Amount to Add</p>
                <div class="form-group mb-1">
                    <input type="number" step="any" name="amount" class="form-control large-gift-card" value="{{ old('amount') }}" autocomplete="off" placeholder="00.00" required>
                </div>
                <p class="text-center text-secondary mb-4">Available: {{ $general->cur_sym }} {{ showAmount($user->balance) }} </p>
                <div class="form-group position-relative">
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
                                <h6 class="subtitle mb-0">Add via</h6>
                            </div>
                            <div class="col-6">
                                <select style="height: fit-content;" class="form-control form-select p-0 ps-1" name="gateway" required>
                                    <option value="">@lang('Select One')</option>
                                    @foreach($gatewayCurrency as $data)
                                    <option value="{{$data->method_code}}" data-gateway="{{ $data }}">{{$data->name}}</option>
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
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Limit')</span>
                                        <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span class="max fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Charge')</span>
                                        <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Payable')</span> <span><span class="payable fw-bold"> 0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-between d-none rate-element">

                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-between d-none in-site-cur">
                                        <span>@lang('In') <span class="method_currency"></span></span>
                                        <span class="final_amo fw-bold">0</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-center crypto_currency d-none">
                                        <span>@lang('Conversion with') <span class="method_currency"></span> @lang('and final value will Show on next step')</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="container text-center">
                <button type="submit" class="btn btn-default mb-2 mx-auto rounded">Add Money</button>
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

                    <h2 class="text-light">Deposit</h2>
                    <h6 class="text-light">You can <b> Diposit</b> here</h6>
                    <h6 class="text-light">for<b> Beting</b></h6>
                </div>

                <div align="center" class="col-5"><img width="90px"
                        src="https://i.ibb.co/L1HScH9/5-F867-FDB-41-C9-488-D-913-C-16-FDDD5-BDFF0-1.png" /></div>

            </div>

        </div>


        <div class="container">

            <div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
            </div>


            @foreach ($gatewayCurrency as $data)
                <div class="border-0 mb-4 bg-warning text-white rounded">
                    <div class="p-1">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-40 border-0 bg-white-light rounded-circle text-white">
                                    <ion-icon style="font-size: 20px;" class="align-middle" name="card-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="col-6 pl-0">
                                <p class="mb-1 text-white">Add Money</p>
                                <h6 class="text-white">with {{ $data->name }}</h6>
                            </div>
                            <div align="right" class="col right">
                                <img class="bg-white rounded-circle shadow" src="{{ $data->methodImage() }}" width="50px"
                                    alt="deposit">
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
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depositModal"
                                        class="cmn--btn text-center deposit btn btn-light shadow w-100"
                                        data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                        data-currency="{{ $data->currency }}" data-method_code="{{ $data->method_code }}"
                                        data-min_amount="{{ showAmount($data->min_amount) }}"
                                        data-max_amount="{{ showAmount($data->max_amount) }}"
                                        data-base_symbol="{{ $data->baseSymbol() }}"
                                        data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                                        data-percent_charge="{{ showAmount($data->percent_charge) }}">
                                        @lang('Deposit')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div> --}}




    <div class="modal fade cmn-modal" id="depositModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header bg-primary">
                    <strong class="modal-title method-name" id="depositModalLabel"></strong>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <form action="{{ route('user.deposit.insert') }}" method="post">
                    @csrf
                    <div class="modal-body pt-4 pb-3">
                        <p class="text-dark depositLimit"></p>
                        <p class="text-danger depositCharge"></p>
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency">
                            <input type="hidden" name="method_code" class="edit-method-code">
                        </div>
                        <div class="form-group">
                            <label class="mb-2">@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control" name="amount"
                                    placeholder="@lang('Amount')" required value="{{ old('amount') }}">
                                <span class="input-group-text bg-info text-white rounded-end">
                                    <p class="text-info"> , , </p>{{ __($general->cur_text) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div align="center" class="row-12 container mb-2">
                        <button align="center" type="button" class="col-6 w-100 btn btn-danger"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <div align="center" class=" prevent-double-click mt-1 mb-1">
                            <button type="submit"
                                class="col-6 w-100 btn btn-success confirm-btn">@lang('Confirm')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('select[name=gateway]').change(function(){
                if(!$('select[name=gateway]').val()){
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=gateway] option:selected').data('gateway');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                if(resource.method.crypto == 1){
                    var toFixedDigit = 8;
                    $('.crypto_currency').removeClass('d-none');
                }else{
                    var toFixedDigit = 2;
                    $('.crypto_currency').addClass('d-none');
                }
                $('.min').text(parseFloat(resource.min_amount).toFixed(2));
                $('.max').text(parseFloat(resource.max_amount).toFixed(2));
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
                var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                $('.payable').text(payable);
                var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge)))*rate).toFixed(toFixedDigit);
                $('.final_amo').text(final_amo);
                if (resource.currency != '{{ $general->cur_text }}') {
                    var rateElement = `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span></span>`;
                    $('.rate-element').html(rateElement)
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
                $('.base-currency').text(resource.currency);
                $('.method_currency').text(resource.currency);
                $('input[name=currency]').val(resource.currency);
                $('input[name=method_code]').val(resource.method_code);
                $('input[name=amount]').on('input');
            });
            $('input[name=amount]').on('input',function(){
                $('select[name=gateway]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
    </script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.deposit').on('click', function() {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{ $general->cur_text }}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge =
                    `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });

            // $('.prevent-double-click').on('click',function(){
            //     $(this).addClass('button-none');
            //     $(this).html('<i class="fas fa-spinner fa-spin"></i> @lang('Processing')...');
            // });
        })(jQuery);
    </script>
@endpush


@push('style')
    <style type="text/css">

    </style>
@endpush
