@extends('backend.layouts.app')

@section('page-title', 'Финансовая статистика')
@section('page-heading', 'Финансовая статистика')

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>

	<section class="content">
		<form action="" method="GET">
			<div class="box box-danger">
				<div class="box-header with-border">
					<h3 class="box-title">Параметры</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Пользователь</label>
								<input type="text" class="form-control" name="user" value="{{ Request::get('user') }}">
							</div>
						</div>
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Тип</label>
								{!! Form::select('type', ['' => '---', 'add' => 'Пополнение', 'out' => 'Снятие'], Request::get('type'), ['id' => 'type', 'class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Сумма от</label>
								<input type="number" class="form-control" name="sum_from" value="{{ Request::get('sum_from') }}">
							</div>
						</div>
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Сумма до</label>
								<input type="number" class="form-control" name="sum_to" value="{{ Request::get('sum_to') }}">
							</div>
						</div>
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Период смены (В ЧАСАХ)</label>
								<input type="number" class="form-control" name="shift_time_hours" value="{{ Request::get('shift_time_hours') }}">
							</div>
						</div>
						<div class="col-md-6 col-lg-3">
							<div class="form-group">
								<label>Период</label>
								<div class="input-group">
									<button type="button" class="btn btn-default pull-right" id="daterange-btn">
										<span><i class="fa fa-calendar"></i> {{ Request::get('dates_view') ?: __('app.date_start_picker') }}</span>
										<i class="fa fa-caret-down"></i>
									</button>
								</div>
								<input type="hidden" id="dates_view" name="dates_view" value="{{ Request::get('dates_view') }}">
								<input type="hidden" id="dates" name="dates" value="{{ Request::get('dates') }}">
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">
						Применить
					</button>
					<a href="{{ route('backend.money_stat') }}" class="btn">Сбросить фильтр</a>
					<a href="{{ route('backend.money_stat_clear') }}" class="btn" style="color: red;">Cбросить всю статистику</a>
				</div>
			</div>
		</form>

		<div class="row">
			<div class="col-lg-4">
				<div class="small-box bg-aqua" style="min-height: 103px;">
					<div class="inner">
						<p>Статистика за период</p>
						@if(!$filter_date_from && !$filter_date_to)
						<h3>За всё время</h3>
						@else
							@if($filter_date_from)
							<h4 style="margin-bottom: 5px;">от: <b>{{ $filter_date_from }}</b></h4>
							@endif
							@if($filter_date_to)
							<h4 style="margin-bottom: 5px;">до: <b>{{ $filter_date_to }}</b></h4>
							@endif
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{ $stat_add }}</h3>
						<p>Получено от пользователей</p>
					</div>
					<div class="icon">
						<i class="fa fa-level-up"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{ $stat_out }}</h3>
						<p>Выплачено пользователям</p>
					</div>
					<div class="icon">
						<i class="fa fa-level-down"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Финансовая статистика</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Пользователь</th>
								<th>Тип операции</th>
								<th>Сумма</th>
								<th>Дата</th>
							</tr>
						</thead>
						<tbody>
						@if (count($statistics_stat))
							@foreach ($statistics_stat as $stat)
								<tr class="@if ($stat->type == 'add') text-green @elseif ($stat->type == 'out') text-red @endif">
									<td>{{ $stat->user->username }}</td>
									<td>
									@if ($stat->type == 'add')
									Пополнение
									@elseif ($stat->type == 'out')
									Снятие
									@endif
									</td>
									<td>{{ abs($stat->sum) }}</td>
									<td>{{ $stat->created_at->format(config('app.date_time_format')) }}</td>
								</tr>
							@endforeach
						@else
							<tr><td colspan="4">Нет данных</td></tr>
						@endif
						</tbody>
					</table>
					</div>
						@php
						$urlParams = '?';
						foreach(request()->all() AS $key=>$value){
							if($key != 'page'){
								$urlParams .= '&' . $key . '=' . $value;
							}
						}
						@endphp
						{!! \VanguardLTE\Lib\Pagination::paging($count, $perPage, $page, route('backend.money_stat').$urlParams, '&page', 9) !!}
                    </div>	
				</div>
			</div>
		</div>
	</section>

@stop

@section('scripts')
<script>
	$(function() {
		$('input[name="dates"]').daterangepicker({
			timePicker: true,
			timePicker24Hour: true,
			startDate: moment().subtract(30, 'day'),
			endDate: moment().add(1, 'day'),

			locale: {
				format: 'YYYY-MM-DD HH:mm'
			}
		});
	});
</script>
@stop