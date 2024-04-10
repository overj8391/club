<input type="hidden" name="shop_id" value="{{ auth()->user()->shop_id }}">

<div class="col-md-6">
    <div class="form-group">
        <label>@lang('app.username')</label>
        <input type="text" class="form-control" id="username" name="username" value="">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>{{ trans('app.balance') }}</label>
        <input type="text" class="form-control" id="balance" name="balance" value="0">
    </div>
</div>

@if(auth()->user()->hasRole('cashier'))
<input type="hidden" name="role_id" value="1">
@else
<div class="col-md-6">
    <div class="form-group">
        <label>@lang('app.role')</label>
        {!! Form::select('role_id', [1 => 'Пользователь', 2 => 'Кассир'], '',
            ['class' => 'form-control', 'id' => 'role_id', '']) !!}
    </div>
</div>
@endif

<div class="col-md-6">
    <div class="form-group">
        <label>{{ trans('app.password') }}</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>{{ trans('app.confirm_password') }}</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
</div>