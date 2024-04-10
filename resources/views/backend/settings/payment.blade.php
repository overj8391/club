@extends('backend.layouts.app')

@section('page-title', trans('app.general_settings'))
@section('page-heading', trans('app.general_settings'))

@section('content')
    <section class="content-header">
        @include('backend.partials.messages')
    </section>
    <section class="content">
        <div class="box box-default">
            {!! Form::open(['route' => ['backend.settings.list.update', 'payment'], 'id' => 'general-settings-form']) !!}
            <div class="box-header with-border">
                <h3 class="box-title">@lang('app.general_settings')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('app.default_currency')</label>
                            @php
                                $currencies = array_combine(\VanguardLTE\Shop::$values['currency'], \VanguardLTE\Shop::$values['currency']);
                            @endphp
                            {!! Form::select('default_currency', $currencies, settings('default_currency', 'USD'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('app.minimum_payment_amount')</label>
                            <input type="number" step="1" name="minimum_payment_amount" class="form-control" value="{{ settings('minimum_payment_amount', 0) }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('app.maximum_payment_amount')</label>
                            <input type="number" step="1" name="maximum_payment_amount" class="form-control" value="{{ settings('maximum_payment_amount', 10000) }}">
                        </div>
                        <div class="form-group">
                            <label>
                                Pin
                            </label>
                            {!! Form::select('payment_pin', ['0' => __('app.no'), '1' => __('app.yes')], settings('payment_pin'), ['class' => 'form-control']) !!}
                        </div> 
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    @lang('app.edit_settings')
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </section>
@stop
