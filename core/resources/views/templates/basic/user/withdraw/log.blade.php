@extends($activeTemplate . 'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include(activeTemplate() . 'includes.top_nav_mini')

        <div class="main-container">

            {{-- <div class="container">
                <form action="">
                    <div class="d-flex justify-content-end ms-auto table--form mb- mb-3 flex-wrap">
                        <div class="input-group">

                            <input class="form-control border-custom mr-2" name="search" type="text" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                        
                            <button class="input-group-text text-white border-custom bg-warning">
                                <span class="material-icons">
                                    search
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div> --}}

            @forelse($withdraws as $log) 
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 rounded">
                                    <div class="background">
                                        @if(@$log->method->image)
                                        <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'.$log->method->image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">Withdraw Via {{ __(@$log->method->name) }}
                                </h6>
                                <p class="small text-secondary">
                                    Trx: <b class="text-info">{{ $log->trx }}</b>
                                    <br>
                                    {{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}
                                </p>
                            </div>

                            <div class="col-auto text-right">
                                {{__($general->cur_sym)}} {{ showAmount($log->amount - $log->charge) }}
                                <br>
                                ({{ showAmount($log->final_amount) }} {{ __($log->currency) }})
                                <br>
                                <a href="javascript:void(0)" class="detailBtn"
                                    data-user_data="{{ json_encode($log->withdraw_information) }}"
                                    @if ($log->status == 3)
                                    data-admin_feedback="{{ $log->admin_feedback }}"
                                    @endif
                                    >
                                    @if($log->status == 1)
                                        <span class="badge badge-success style--light">@lang('Complete')</span>
                                    @elseif($log->status == 2)
                                        <span class="badge badge-warning style--light">@lang('Pending')</span>
                                    @elseif($log->status == 3)
                                        <span class="badge badge-danger style--light">@lang('Rejected')</span>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($withdraws->hasPages())
                <div class="">
                    {{ paginateLinks($withdraws) }}
                </div>
            @endif
        </div>

    </main>
</body>











    {{-- <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));"
        class="container pt-5 pb-3 mt-5">
        <div class="row">

            <div align="center" class="col pt-2">
                <h4 class="text-light">Withdraw History</h4>
            </div>

        </div>

    </div>


    <section class="cmn-section">
        <div class="container">




            @forelse($withdraws as $k=>$data)
                <div class="card table-card mt-2 pt-1">
                    <div class="card-body p-o">
                        <div class="table-responsive--sm">


                            <div class="row">

                                <div align="left" class="col-6">
                                    <h4>Withdrawal</h4>
                                </div>
                                <div align="right" class="col-6">
                                    <h3 class="text-danger">{{ showAmount($data->final_amount) }} {{ $data->currency }}</h3>
                                </div>

                            </div>


                            <div class="row">

                                <div align="left" class="col-6">
                                    <h5>{{ date('d M, Y ', strtotime($data->created_at)) }}</h5>
                                </div>


                                <div align="right" class="col-6">
                                    <h5>
                                        @if ($data->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge--success">@lang('Completed')</span>
                                            <a href="javascript:void(0)" class="badge badge--info approveBtn"
                                                data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                    class="fa fa-info"></i></a>
                                        @elseif($data->status == 3)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                            <a class="badge badge--info approveBtn"
                                                data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                    class="fa fa-info"></i></a>
                                        @endif
                                    </h5>
                                </div>

                                <div class="row">

                                    <div align="left" class="col-6">
                                        <h5>Trx :</h5>
                                    </div>

                                    <div align="right" class="col-6">
                                        <h5>{{ $data->trx }}</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



            @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">@lang('Data not found')</td>
                </tr>
            @endforelse



        </div>
    </section>

    <section style="height: 90px;">

    </section> --}}


    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title m-0 text-white">@lang('Details')</h5>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <ul class="list-group shadow rounded">
                        <li class="list-group-item bg-warning">@lang('Amount') : <span class="withdraw-amount "></span>
                        </li>
                        <li class="list-group-item bg-info">@lang('Charge') : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item bg-warning">@lang('After Charge') : <span
                                class="withdraw-after_charge"></span></li>
                        <li class="list-group-item bg-info">@lang('Conversion Rate') : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item bg-warning">@lang('Payable Amount') : <span class="withdraw-payable"></span>
                        </li>
                    </ul>
                    <ul class="list-group withdraw-detail mt-1">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">@lang('Details')</h5>
                    <span data-bs-dismiss="modal">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer bg-transparent border-primary">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
