@extends($activeTemplate . 'layouts.frontend')
@section('content')


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            @forelse($bets as $item)  
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar bg-warning-light text-warning avatar-50 rounded-circle">
                                    <div class="background">
                                        <img width="50" height="50" src="{{ $item->match->logo_1 }}" alt="team_1">
                                    </div>
                                </div>
                            </div>

                            <div align="center" class="col align-self-center pr-0">
                                {{ __($item->match->team_1) }} 
                                <font color="red">VS</font>
                                {{ __($item->match->team_2) }}
                                <br>
                                <b class="small text-secondary">
                                    {{ __($item->option->dividend) }}:{{ __($item->option->divisor) }} 
                                    ( <span class="text-info">{{ __($item->option->profit) }}%</span> )
                                </b>
                                <b class=" bg-info border-custom text-white pb-1">
                                    @php echo $item->statusBadge @endphp
                                </b>
                                <br>
                                <b class="small text-secondary">
                                    @lang('Invest') : <span class="text-danger">{{ __($general->cur_sym) }} {{ getAmount($item->invest_amount) }}</span>
                                </b>
                                <br>
                                <b class="small text-secondary">
                                    @php
                                    $p = getAmount(@$item->option->profit);
                                    $p = 0.01 * $p;
                                    $p = $p * @$item->invest_amount;
                                    $d = getAmount(@$item->invest_amount) + getAmount(@$p);
                                    @endphp
                                    @lang('If Won') : <span class="text-success">{{ __(@$general->cur_sym) }} {{ getAmount(@$d) }}</span>
                                </b>
                            </div>
      
                            <div class="col-auto">
                                <div class="avatar bg-warning-light text-warning avatar-50 rounded-circle">
                                    <div class="background">
                                        <img width="50" height="50" src="{{ $item->match->logo_2 }}" alt="team_2">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
              <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($bets->hasPages())
            <div class="container">
                <div style="margin: 0 auto; justify-content: center;" class="row-12">
                        {{ paginateLinks($bets) }}
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
                <h4 class="text-light">All Bets</h4>
            </div>

        </div>

    </div>

    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">@lang('Match')</th>
                                <th class="text-white">@lang('Betted Score')</th>
                                <th class="text-white">@lang('Betted Amount')</th>
                                <th class="text-white">@lang('Reward if Won')</th>
                                <th class="text-white">@lang('Result')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bets as $item)
                                <tr>
                                    <td data-label="@lang('Match')">{{ __($item->match->team_1) }} <font color="red">
                                            VS</font>
                                        {{ __($item->match->team_2) }}
                                    </td>

                                    <td data-label="@lang('Score')">
                                        {{ __($item->option->dividend) }}:{{ __($item->option->divisor) }} ( <font
                                            color="yellow">{{ __($item->option->profit) }}%</font> ) </td>
                                    <td data-label="@lang('Invest')">{{ getAmount($item->invest_amount) }}
                                        {{ __($general->cur_text) }}</td>
                                    <td data-label="@lang('Return')">

                                        @php
                                        $p = getAmount($item->option->profit);
                                        $p = 0.01 * $p;
                                        $p = $p * $item->invest_amount;
                                        $d = getAmount($item->invest_amount) + getAmount($p);
                                        @endphp

                                        {{ getAmount($d) }}
                                        {{ __($general->cur_text) }}</td>
                                    <td data-label="@lang('Result')">
                                        @php echo $item->statusBadge @endphp
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{ $bets->links() }}
                </ul>
            </div>
        </div>
    </section> --}}

    <!-- Modal -->
    <div class="modal cmn--modal fade" id="detailsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col text-center match-name" id="exampleModalLabel">@lang('Login Required')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="predict-content">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                @lang('Question') <span class="subtitle question"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span>@lang('My Choice Was ')</span> <span class="choice text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Invested Amount ')</b></span> <span class="invest text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Return Amount ')</b></span> <span class="return text--base"></span>
                            </li>

                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Result')</b></span> <span class="status text--base"></span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                var modal = $('#detailsModal');
                var match = $(this).data('match');
                var question = $(this).data('question');
                var choice = $(this).data('choice');
                var investAmount = $(this).data('invest_amount');
                var returnAmount = $(this).data('return_amount');
                var statusBadge = $(this).data('status_badge');

                modal.find('.match-name').text(match);
                modal.find('.question').text(question);
                modal.find('.choice').text(choice);
                modal.find('.invest').html(
                    `${parseFloat(investAmount).toFixed(2)} {{ __($general->cur_text) }}`);
                modal.find('.return').html(
                    `${parseFloat(returnAmount).toFixed(2)} {{ __($general->cur_text) }}`);
                modal.find('.status').html(statusBadge);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
