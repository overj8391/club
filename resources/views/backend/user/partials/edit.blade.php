<div class="box-body box-profile">

    <h3 style="margin-top: 0; margin-bottom: 30px;">Пользователь: {{ $edit ? $user->username : '' }}</h3>

    <div class="form-group">
        <label>@lang('app.role')</label>
        {!! Form::select('role_id', Auth::user()->available_roles( true ), $edit ? $user->role_id : '',
            ['class' => 'form-control', 'id' => 'role_id', 'disabled' => true]) !!}
    </div>

    <div class="form-group">
        <label>@lang('app.status')</label>
        {!! Form::select('status', $statuses, $edit ? $user->status : '' ,
            ['class' => 'form-control', 'id' => 'status', 'disabled' => ($user->hasRole(['admin']) || $user->id == auth()->user()->id) ? true: false]) !!}
    </div>

    @if(auth()->user()->hasRole('admin') && $user->hasRole(['agent', 'distributor']))
            <div class="form-group">
                <label for="device">@lang('app.block')</label>
                {!! Form::select('is_blocked', ['0' => __('app.unblock'), '1' => __('app.block')], $edit ? $user->is_blocked : old('is_blocked'), ['class' => 'form-control']) !!}
            </div>
    @endif

    <!-- <div class="form-group">
        <label>@lang('app.username')</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="(@lang('app.optional'))" value="{{ $edit ? $user->username : '' }}">
    </div> -->

    <!-- <div class="form-group">
        <label>{{ $edit ? trans("app.new_password") : trans('app.password') }}</label>
        <input type="password" class="form-control" id="password" name="password" @if ($edit) placeholder="@lang('app.leave_blank_if_you_dont_want_to_change')" @endif>
    </div>

    <div class="form-group">
        <label>{{ $edit ? trans("app.confirm_new_password") : trans('app.confirm_password') }}</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" @if ($edit) placeholder="@lang('app.leave_blank_if_you_dont_want_to_change')" @endif>
    </div> -->

</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary" id="update-details-btn">
        @lang('app.edit_user')
    </button>
</div>
