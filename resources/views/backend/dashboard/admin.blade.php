@extends('backend.layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('content')

    <section class="content-header">
        @include('backend.partials.messages')
    </section>

    <section class="content">

        <div class="row">
            @permission('shops.manage')
            <div class="col-xs-12">
                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">Активное казино</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('app.name')</th>
                                    <th>@lang('app.percent')</th>
                                    <th>@lang('app.frontend')</th>
                                    <th>@lang('app.currency')</th>
                                    <th>@lang('app.status')</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if (count($shops))
                                    @foreach ($shops as $shop)
                                        <tr>
                                            <td>
                                                <a href="{{ route('backend.shop.edit', $shop->id)  }}">
                                                    {{ $shop->name }}
                                                </a>
                                            </td>

                                            <td>{{ $shop->get_percent_label($shop->percent) }}</td>
                                            <td>{{ $shop->frontend }}</td>

                                            <td>{{ $shop->currency }}</td>
                                            <td>
                                                @if($shop->is_blocked)
                                                    <small><i class="fa fa-circle text-red"></i></small>
                                                @else
                                                    <small><i class="fa fa-circle text-green"></i></small>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="6">@lang('app.no_data')</td></tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endpermission
        </div>

    </section>
    <!-- /.content -->

@stop

@section('scripts')
    {!! HTML::script('/back/dist/js/pages/dashboard.js') !!}
@stop
