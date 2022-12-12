@extends($activeTemplate . 'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            {{-- <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Transaction Number')</label>
                                    <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Type')</label>
                                    <select class="form-control form-select" name="trx_type">
                                        <option value="">@lang('All')</option>
                                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-control form-select" name="remark">
                                        <option value="">@lang('Any')</option>
                                        @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end p-1">
                                    <button class="btn btn-warning border-custom w-100">@lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div> --}}

            @forelse($transactions as $trx)  
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            
                            <div class="col-auto pr-0">
                                <div class="avatar bg-warning-light text-warning avatar-50 rounded">
                                    <div class="background">
                                        <span class="material-icons">
                                            receipt_long
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1"> {{ __(@$trx->details) }}</h6>
                                <p class="small text-secondary">{{ showDateTime($trx->created_at, 'd-m-Y') }} | 
                                    {{ diffForHumans($trx->created_at) }}
                                    <br>
                                    Trx: <b class="text-info">{{ $trx->trx }}</b>
                                </p>
                                
                                
                            </div>
      
                            <div class="col-auto">

                              <h6 class="@if(($trx->trx_type)=='+') {{'text-success'}} @else {{'text-danger'}} @endif">
      
                                  @if(getAmount($trx->amount) != 0)
                                  {{ __($trx->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($trx->amount) }}
                                  
                                  @else
                                  {{ __($trx->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($trx->charge) }}
                                  @endif
                                  
                              </h6>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
              <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($transactions->hasPages())
            <div class="container">
                <div style="margin: 0 auto; justify-content: center;" class="row-12">
                        {{ paginateLinks($transactions) }}
                </div>
                
            </div>
            @endif


        </div>

    </main>

</body>

    {{-- <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));"
        class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">


            <div align="center" class="col pt-2">
                <h4 class="text-light">Transactions</h4>
            </div>

        </div>

    </div>

    <section class="cmn-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="card table-card">
                        <div class="card-body p-0">
                            <div class="table-responsive--sm">
                                <table class="table table-striped">
                                    <thead class="bg-primary rounded">
                                        <tr>
                                            <th class="text-white">@lang('Amount')</th>
                                            <th class="text-white">@lang('Balance')</th>
                                            <th class="text-white">@lang('Details')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $item)
                                            <tr>

                                                <td data-label="@lang('Amount')">
                                                    @if ($item->trx_type == '+')
                                                        <span class="text--base">+ {{ showAmount($item->amount) }}
                                                            {{ __($general->cur_text) }}
                                                </td></span>
                                            @elseif ($item->trx_type == '-')
                                                <span class="text--danger">- {{ showAmount($item->amount) }}
                                                    {{ __($general->cur_text) }}</td></span>
                                        @endif

                                        <td data-label="@lang('Post Balance')">{{ showAmount($item->post_balance) }}
                                            {{ __($general->cur_text) }}</td>

                                        <td data-label="@lang('Details')">{{ __($item->details) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <ul class="pagination justify-content-end">
                        {{ $transactions->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section style="height: 90px;">
    </section> --}}
@endsection
