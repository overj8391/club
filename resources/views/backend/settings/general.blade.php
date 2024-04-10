@extends('backend.layouts.app')

@section('page-title', trans('app.general_settings'))
@section('page-heading', trans('app.general_settings'))

@section('content')
    <section class="content-header">
        @include('backend.partials.messages')
    </section>
    <section class="content">
        <div class="box box-default">
            {!! Form::open(['route' => ['backend.settings.list.update', 'general'], 'id' => 'general-settings-form']) !!}
            <div class="box-header with-border">
                <h3 class="box-title">@lang('app.general_settings')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Название сайта</label>
                            <input type="text" class="form-control" id="app_name" name="app_name" value="{{ settings('app_name') }}">
                        </div>
                        <div class="form-group">
                            <label>
                                @lang('app.frontend')
                            </label>
                            {!! Form::select('frontend', $directories, settings('frontend', 'Default'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>
                                @lang('app.turn_off_the_site')
                            </label>
                            {!! Form::select('siteisclosed', ['0' => __('app.no'), '1' => __('app.yes')], settings('siteisclosed'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    @lang('app.edit_settings')
                </button>
                <a href="{{ route('backend.settings.gelete_stat') }}"
                    class="btn btn-danger "
                    data-method="PUT"
                    data-confirm-title="@lang('app.please_confirm')"
                    data-confirm-text="@lang('app.delete_stat_game_question')"
                    data-confirm-delete="@lang('app.yes_i_do')">
                    <b>@lang('app.delete_stat_game')</b></a>
                <a href="{{ route('backend.settings.gelete_log') }}"
                    class="btn btn-danger "
                    data-method="PUT"
                    data-confirm-title="@lang('app.please_confirm')"
                    data-confirm-text="@lang('app.delete_log_game_question')"
                    data-confirm-delete="@lang('app.yes_i_do')">
                    <b>@lang('app.delete_log_game')</b></a>
            </div>
            {{ Form::close() }}
        </div>
    </section>
@stop
