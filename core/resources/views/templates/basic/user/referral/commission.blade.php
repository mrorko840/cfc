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
                    <div class="card-body">
                        <div class="btn-group justify-content-center mb-1 w-100">
                            <a href="@if (request()->routeIs('user.referral.commissions.deposit')) javascript:void(0) @else {{ route('user.referral.commissions.deposit') }} @endif"
                                class="btn btn-sm btn-primary w-100 border-custom mx-1" @if(request()->routeIs('user.referral.commissions.deposit')) hidden @endif>@lang('Deposit Bonus')</a>
        
                            <a href="@if (request()->routeIs('user.referral.commissions.bet')) javascript:void(0) @else {{ route('user.referral.commissions.bet') }} @endif"
                                class="btn btn-sm btn-warning w-100 border-custom mx-1" @if(request()->routeIs('user.referral.commissions.bet')) hidden @endif>@lang('Bet Bonus')</a>
        
                            <a href="@if (request()->routeIs('user.referral.commissions.win')) javascript:void(0) @else {{ route('user.referral.commissions.win') }} @endif"
                                class="btn btn-sm btn-dark w-100 border-custom mx-1" @if(request()->routeIs('user.referral.commissions.win')) hidden @endif>@lang('Won Bet Bonus')</a>
                        </div>
                    </div>
                </div>

            </div>

            @forelse($logs as $data)  
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            
                            <div class="col-auto pr-0">
                                <div class="avatar bg-success-light text-success avatar-50 rounded">
                                    <div class="background">
                                        <span class="material-icons">
                                            group_add
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1"> {{ __(@$data->details) }}</h6>
                                <p class="small text-secondary">{{ showDateTime($data->created_at, 'd M, Y') }} | 
                                    {{ diffForHumans($data->created_at) }}
                                </p>
                                
                                
                            </div>
      
                            <div class="col-auto">

                              <h6 class="text-success">
      
                                {{ __($general->cur_sym) }}{{ getAmount($data->comission_amount) }}
                                  
                              </h6>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
              <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($logs->hasPages())
            <div class="container">
                <div style="margin: 0 auto; justify-content: center;" class="row-12">
                        {{ paginateLinks($logs) }}
                </div>
                
            </div>
            @endif


        </div>

    </main>

</body>



{{-- 
    <div style="" class="container pt-5 pb-3 mt-5 mb-2 bg-warning">
        <div class="row">
            <div align="center" class="col pt-2">
                <h4 class="text-light">Commissions</h4>
            </div>
        </div>
    </div>


    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="btn--group justify-content-center mb-1">
                    <a href="@if (request()->routeIs('user.referral.commissions.deposit')) javascript:void(0) @else {{ route('user.referral.commissions.deposit') }} @endif"
                        class="cmn--btn btn--sm btn-primary w-100 @if (request()->routeIs('user.referral.commissions.deposit')) btn-disabled @endif">@lang('Deposit Bonus')</a>

                    <a href="@if (request()->routeIs('user.referral.commissions.bet')) javascript:void(0) @else {{ route('user.referral.commissions.bet') }} @endif"
                        class="cmn--btn btn--sm btn-warning w-100 @if (request()->routeIs('user.referral.commissions.bet')) btn-disabled @endif">@lang('Bet Bonus')</a>

                    <a href="@if (request()->routeIs('user.referral.commissions.win')) javascript:void(0) @else {{ route('user.referral.commissions.win') }} @endif"
                        class="cmn--btn btn--sm btn-dark w-100 @if (request()->routeIs('user.referral.commissions.win')) btn-disabled @endif">@lang('Won Bet Bonus')</a>
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary rounded">
                            <tr>
                                <th class="text-white">@lang('Date')</th>
                                <th class="text-white">@lang('From')</th>
                                <th class="text-white">@lang('Amount')</th>
                                <th class="text-white">@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $data)
                                <tr class="bg-success">
                                    <td data-label="@lang('Date')">{{ showDateTime($data->created_at, 'd M, Y') }}</td>
                                    <td data-label="@lang('From')"><strong>{{ @$data->bywho->username }}</strong></td>
                                    <td data-label="@lang('Amount')">
                                        {{ __($general->cur_sym) }}{{ getAmount($data->comission_amount) }}</td>
                                    <td data-label="@lang('Type')">{{ __($data->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{ $logs->links() }}
                </ul>
            </div>
        </div>
    </section> --}}
@endsection
