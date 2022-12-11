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

            @forelse($logs as $log) 
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 rounded">
                                    <div class="background">
                                        @if(@$log->gateway->image)
                                        <img src="{{getImage(imagePath()['gateway']['path'].'/'.$log->gateway->image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">Deposit Via {{ __(@$log->gateway->name)  }}
                                </h6>
                                <p class="small text-secondary">
                                    Trx: <b class="text-info">{{ $log->trx }}</b>
                                    <br>
                                    {{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}
                                </p>
                            </div>

                            @php
                                $details = ($log->detail != null) ? json_encode($log->detail) : null;
                            @endphp

                            <div class="col-auto text-right">
                                {{__($general->cur_sym)}} {{ showAmount($log->amount + $log->charge) }}
                                <br>
                                ({{ showAmount($log->final_amo) }} {{ __($log->method_currency) }})
                                <br>
                                <a href="javascript:void(0)" class="@if($log->method_code >= 1000) detailBtn @else disabled @endif"
                                    @if($log->method_code >= 1000)
                                        data-info="{{ $details }}"
                                    @endif
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

            @if ($logs->hasPages())
                <div class="">
                    {{ paginateLinks($logs) }}
                </div>
            @endif
        </div>

    </main>
</body>













    {{-- <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));"
        class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">


            <div align="center" class="col pt-2">
                <h4 class="text-light">Deposit History</h4>
            </div>

        </div>

    </div>

    <section class="cmn-section">
        <div class="container">

            @if (count($logs) > 0)
                @foreach ($logs as $k => $data)
                    <div class="card table-card mt-2 pt-1">
                        <div class="card-body p-o">
                            <div class="table-responsive--sm">

                                <div class="row">
                                    <div align="left" class="col-6">
                                        <h4>Deposit</h4>
                                    </div>

                                    <div align="right" class="col-6">
                                        <h3 class="text-danger">{{ showAmount($data->amount) }} {{ $general->cur_text }}
                                        </h3>
                                    </div>
                                </div>


                                <div class="row">

                                    <div align="left" class="col-6">
                                        <h5>{{ date(' d M, Y ', strtotime($data->created_at)) }}</h5>
                                    </div>


                                    <div align="right" class="col-6">
                                        <h5>
                                            @if ($data->status == 1)
                                                <span class="badge badge-success">@lang('Complete')</span>
                                            @elseif($data->status == 2)
                                                <span class="badge badge-warning">@lang('Pending')</span>
                                            @elseif($data->status == 3)
                                                <span class="badge badge-danger">@lang('Cancel')
                                            @endif
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">

                                    <div align="left" class="col-6">
                                        <h5>Trx : {{ $data->trx }}</h5>
                                    </div>

                                    @php
                                        $details = $data->detail != null ? json_encode($data->detail) : null;
                                    @endphp

                                    <div align="right" class="col-6">
                                        <h5>More:
                                            <a href="javascript:void(0)" class="badge badge--success approveBtn"
                                                data-info="{{ $details }}" data-id="{{ $data->id }}"
                                                data-amount="{{ showAmount($data->amount) }} {{ __($general->cur_text) }}"
                                                data-charge="{{ showAmount($data->charge) }} {{ __($general->cur_text) }}"
                                                data-after_charge="{{ showAmount($data->amount + $data->charge) }} {{ __($general->cur_text) }}"
                                                data-rate="{{ showAmount($data->rate) }} {{ __($data->method_currency) }}"
                                                data-payable="{{ showAmount($data->final_amo) }} {{ __($data->method_currency) }}">
                                                <i class="fa fa-desktop"></i>
                                            </a>
                                        </h5>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <tr>
                    <td colspan="100%" class="text-center"> @lang('No results found')!</td>
                </tr>
            @endif


        </div>
        </div>
        </div>

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
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0">@lang('Details')</h6>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
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
                var modal = $('#approveModal');
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-charge').text($(this).data('charge'));
                modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
                modal.find('.withdraw-rate').text($(this).data('rate'));
                modal.find('.withdraw-payable').text($(this).data('payable'));
                var list = [];
                var details = Object.entries($(this).data('info'));

                var ImgPath = "{{ asset(imagePath()['verify']['deposit']['path']) }}/";
                var singleInfo = '';
                for (var i = 0; i < details.length; i++) {
                    if (details[i][1].type == 'file') {
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="@lang('Image')" class="w-100">
                                        </li>`;
                    } else {
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <textarea class="form-control shadow-sm text-warning" rows="2">${details[i][1].field_name}</textarea>
                                        </li>`;
                    }
                }

                if (singleInfo) {
                    modal.find('.withdraw-detail').html(
                        `<br><strong class="my-3">@lang('Payment Information')</strong>  ${singleInfo}`);
                } else {
                    modal.find('.withdraw-detail').html(`${singleInfo}`);
                }
                modal.modal('show');
            });

            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
