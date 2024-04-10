<div class="row">
    @if (!$edit || $game->name !== '')
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">@lang('app.name')</label>
                <input type="text" class="form-control" id="name"
                       name="name" placeholder="@lang('app.name')" {{ $edit ? 'disabled' : '' }} value="{{ $edit ? $game->name : '' }}" required>
            </div>
        </div>
    @endif
    @if (!$edit || $game->title !== '')
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">@lang('app.title')</label>
                <input type="text" class="form-control" id="title"
                       name="title" placeholder="@lang('app.title')" value="{{ $edit ? $game->title : '' }}" required>
            </div>
        </div>
    @endif

    @if (!$edit || $game->bet !== '')
        <div class="col-md-4">
            <div class="form-group">
                <label for="bet">@lang('app.bet')</label>
                {!! Form::select('bet', $game->get_values('bet'), $edit ? $game->bet : '', ['class' => 'form-control', 'required' => true]) !!}
            </div>
        </div>
    @endif

    @if (!$edit || $game->denomination !== '')
        <div class="col-md-4">
            <div class="form-group">
                <label>@lang('app.denomination')</label>
                @php
                    $denominations = array_combine(\VanguardLTE\Game::$values['denomination'], \VanguardLTE\Game::$values['denomination']);
                @endphp
                {!! Form::select('denomination', $denominations, $edit ? $game->denomination : '1.00', ['class' => 'form-control']) !!}
            </div>
        </div>
    @endif

    <div class="col-md-4">
        <div class="form-group">
            <label for="view">@lang('app.view')</label>
            <select name="view" id="view" class="form-control">
                <option value="1" {{ $edit && $game->view? 'selected="selected"' : '' }}>@lang('app.active')</option>
                <option value="0" {{ $edit && !$game->view? 'selected="selected"' : '' }}>@lang('app.disabled')</option>
            </select>
        </div>
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                @lang('app.edit_game')
            </button>
        </div>
    @endif
</div>