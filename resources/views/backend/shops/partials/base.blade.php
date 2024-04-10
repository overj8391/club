<div class="row">

    @if(!$edit || ($edit && auth()->user()->hasPermission('shops.title')))
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('app.title')</label>
            <input type="text" class="form-control" id="title" name="name" placeholder="@lang('app.title')" required value="{{ $edit ? $shop->name : old('name') }}">
        </div>
    </div>
    @endif

    @if(!$edit || ($edit && auth()->user()->hasPermission('shops.percent')))
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('app.percent')</label>
            @php
                $percents = array_combine(\VanguardLTE\Shop::$values['percent'], \VanguardLTE\Shop::$values['percent_labels']);
            @endphp
            {!! Form::select('percent', \VanguardLTE\Shop::$values['percent_labels'], $edit ? $shop->percent : (old('percent')?:'90'), ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif

    @if(!$edit || ($edit && auth()->user()->hasPermission('shops.currency')))
    <div class="col-md-6">
        <div class="form-group">
            <label> @lang('app.currency')</label>
            @php
                $currencies = array_combine(\VanguardLTE\Shop::$values['currency'], \VanguardLTE\Shop::$values['currency']);
            @endphp
            {!! Form::select('currency', $currencies, $edit ? $shop->currency : (old('currency')?:'USD'), ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif

    @if(!$edit || ($edit && auth()->user()->hasPermission('shops.max_win')))
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('app.max_win')</label>
            @php
                $max_win = array_combine(\VanguardLTE\Shop::$values['max_win'], \VanguardLTE\Shop::$values['max_win']);
            @endphp
            {!! Form::select('max_win', $max_win, $edit ? $shop->max_win : (old('max_win')?:'100'), ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif

    @if(!$edit || ($edit && auth()->user()->hasRole('admin')))
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('app.shop_limit')</label>
            @php
                $shop_limits = array_combine(\VanguardLTE\Shop::$values['shop_limit'], \VanguardLTE\Shop::$values['shop_limit']);
            @endphp
            {!! Form::select('shop_limit', $shop_limits, $edit ? $shop->shop_limit : (old('shop_limit')?:'200'), ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif

    @if($edit && count($blocks))
    <div class="col-md-6">
        <div class="form-group">
            <label for="device">
                @lang('app.status'):
                @if($shop->is_blocked)
                    @lang('app.block')
                @else
                    @lang('app.unblock')
                @endif
            </label>
            {!! Form::select('is_blocked', ['' => '---'] + $blocks, $edit ? $shop->is_blocked : old('is_blocked'), ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif

    <!-- <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.balance') }}</label>
            <input type="text" class="form-control" name="balance" value="{{ old('balance')?:0 }}">
        </div>
    </div> -->

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="view">Основной банк</label>
                    <input type="number" class="form-control" id="game_bank_slots" name="game_bank_slots" value="{{ $edit ? $game_bank_slots : 0 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="view">Банк бонусов</label>
                    <input type="number" class="form-control" id="game_bank_bonus" name="game_bank_bonus" value="{{ $edit ? $game_bank_bonus : 0 }}">
                </div>
            </div>
        </div>
        <p>Сумма в банке не может превышать лимит магазина</p>
    </div>
</div>