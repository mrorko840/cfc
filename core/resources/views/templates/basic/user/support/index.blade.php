@extends($activeTemplate . 'layouts.frontend')

@section('content')

<!-- Begin page content -->
<main class="flex-shrink-0 main">
    <!-- Fixed navbar -->
    @include(activeTemplate() . 'includes.top_nav_mini')
  
    <div class="main-container">
        <div class="container">
            <div class="card mb-2">
                <div class="card-header text-right">
                    <a href="{{ route('ticket.open') }}" class="btn btn-sm btn-success border-custom">@lang('New Ticket')</a>
                </div>
            </div>
        </div>
      @forelse($supports as $key => $support) 
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                          <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle text-danger">
                            <i class="material-icons vm text-template">support_agent</i>
                          </div>
                        </div>
                        <div class="col align-self-center pr-0">
                            <h6 class="font-weight-normal mb-1"><a class="text-primary" href="{{ route('ticket.view', $support->ticket) }}">{{ __($support->subject) }}</a></h6>
                            <span class="small text-secondary">[Ticket#{{ $support->ticket }}]</span>
                            <span class="small">
                                @if($support->priority == 1)
                                    <span class="badge badge-dark">@lang('Low')</span>
                                @elseif($support->priority == 2)
                                    <span class="badge badge-success">@lang('Medium')</span>
                                @elseif($support->priority == 3)
                                    <span class="badge badge-primary">@lang('High')</span>
                                @endif
                            </span>
                            <p class="small text-info">
                              Last Reply {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}
                            </p>
                        </div>
  
                        <div align="center" class="col-auto">
                            <a href="{{ route('ticket.view', $support->ticket) }}"><span class="material-icons btn btn-sm btn-mini btn-warning text-white">visibility</span></a>
                            <br>
                            @if($support->status == 0)
                                <span align="center" class="badge badge-secondary style--light border-custom">@lang('Open')</span>
                            @elseif($support->status == 1)
                                <span align="center" class="badge badge-primary style--light">@lang('Answered')</span>
                            @elseif($support->status == 2)
                                <span align="center" class="badge badge-info style--light">@lang('Replied')</span>
                            @elseif($support->status == 3)
                                <span align="center" class="badge badge-danger style--light">@lang('Closed')</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <tr>
                <td colspan="100%" class="text-center">@lang('Data Not Found')!</td>
            </tr>
        @endforelse 
    </div>
</main>












    {{-- <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));"
        class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">


            <div align="center" class="col pt-2">
                <h4 class="text-light">Support Ticket</h4>
            </div>

        </div>

    </div>

    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-1">
                    <a href="{{ route('ticket.open') }}" class="cmn--btn btn--sm">@lang('New Ticket')</a>
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">@lang('Subject')</th>
                                <th class="text-white">@lang('Status')</th>
                                <th class="text-white">@lang('Last Reply')</th>
                                <th class="text-white">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supports as $key => $support)
                                <tr>
                                    <td data-label="@lang('Subject')"> <a
                                            href="{{ route('ticket.view', $support->ticket) }}"
                                            class="font-weight-bold text--base"> [@lang('Ticket')#{{ $support->ticket }}]
                                            {{ __($support->subject) }} </a></td>
                                    <td data-label="@lang('Status')">
                                        @if ($support->status == 0)
                                            <span class="badge badge--success">@lang('Open')</span>
                                        @elseif($support->status == 1)
                                            <span class="badge badge--info">@lang('Answered')</span>
                                        @elseif($support->status == 2)
                                            <span class="badge badge--primary">@lang('Customer Reply')</span>
                                        @elseif($support->status == 3)
                                            <span class="badge badge--danger">@lang('Closed')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Last Reply')">
                                        {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('ticket.view', $support->ticket) }}" class="badge badge--success">
                                            <i class="fa fa-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">@lang('No data found')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{ $supports->links() }}
                </ul>
            </div>
        </div>
    </section> --}}
@endsection
