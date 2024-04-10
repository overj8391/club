@extends('backend.layouts.app')

@section('page-title', trans('app.pyour_withdraw'))
@section('page-heading', trans('app.pyour_withdraw'))

@section('content')

<section class="content-header">
    @include('backend.partials.messages')
</section>

<section class="content">
    <div class="tableList">
        <table class="table bg-white text-center">
            <thead>
                <tr>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Номер счета</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdraws as $w)
                <tr class="fw-bold">
                    <td>{{ $w->user->username }}</td>
                    <td>{{ $w->amount }} RUB</td>
                    <td>{{ $w->wallet }}</td>
                    <td>{{ $w->status ? ($w->status == 2 ? 'Одобрено' : 'Отклонено') : 'В ожидании' }}</td>
                    <td>{{ $w->created_at }}</td>
                    <td>
                        @if($w->status == 'Pending')
                            <a href="{{ route('backend.withdraw.approve', ['id' => $w->id]) }}" class="btn btn-inline btn-success btn-xs">Одобрить</a>
                            <a href="{{ route('backend.withdraw.reject', ['id' => $w->id]) }}" class="btn btn-inline btn-danger btn-xs" style="margin-left: 10px">Отклонить</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if(count($withdraws) == 0)
                <tr>
                    <td colspan="6">
                        <div class="noData">
                            Нет заявок
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
@stop

@section('scripts')

@stop
