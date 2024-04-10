@extends('backend.layouts.app')

@section('page-title', trans('app.activity_log'))
@section('page-heading', trans('app.activity_log'))

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>

	<section class="content">

		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('app.activity_log')</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
						<tr>
							@if (isset($adminView))
							<th>@lang('app.user')</th>
							@endif
							<th>@lang('app.message')</th>
							<th>@lang('app.log_time')</th>
							<th>@lang('app.more_info')</th>
						</tr>
						</thead>
						<tbody>
						@if (count($activities))
							@foreach ($activities as $activity)
								<tr>
									@if (isset($adminView))
										<td>
											@if (isset($user))
												{{ $activity->user->username }}
											@else
												<a href="{{ route('backend.activity.user.log', $activity->user_id) }}">{{ $activity->user->username }}</a>
											@endif
										</td>
									@endif

									<td>
										@if ($activity->old)
											<b>@lang('app.after'): </b><br>
										@endif
											{{ $activity->description }}
										@if ($activity->old)
											<br><b>@lang('app.before'): </b><br>{{ $activity->old }}
										@endif
									</td>
									<td>{{ date(config('app.date_time_format'), strtotime($activity->created_at)) }}</td>
										<td>
											<b> @lang('app.country')</b>: {{ $activity->country }} <br>
											<b> @lang('app.city')</b>: {{ $activity->city }} <br>
											<b> @lang('app.os')</b>: {{ $activity->os }} <br>
											<b> @lang('app.device')</b>: {{ $activity->device }} <br>
											<b> @lang('app.browser')</b>: {{ $activity->browser }} <br>
											<b> @lang('app.ip')</b>: {{ $activity->ip_address }} <br>
											<b> @lang('app.user_agent')</b>: {{ $activity->user_agent }} <br>
										</td>
								</tr>
							@endforeach
						@else
							<tr><td colspan="@if (isset($adminView)) 5 @else 4 @endif">@lang('app.no_data')</td></tr>
						@endif
						</tbody>
						<thead>
						<tr>
							@if (isset($adminView))
								<th>@lang('app.user')</th>
							@endif
							<th>@lang('app.message')</th>
							<th>@lang('app.log_time')</th>
							<th>@lang('app.more_info')</th>
						</tr>
						</thead>
					</table>
				</div>
				{{ $activities->links() }}
			</div>
		</div>
	</section>

@stop

@section('scripts')
	<script>
		$(function() {
			$('#stat-table').dataTable();
			$('input[name="dates"]').daterangepicker({
				timePicker: true,
				timePicker24Hour: true,
				startDate: moment().subtract(30, 'day'),
				endDate: moment().add(7, 'day'),

				locale: {
					format: 'YYYY-MM-DD HH:mm',
					timeZone: '{{ config('app.timezone') }}'
				}
			});

			$('.btn-box-tool').click(function(event){
				if( $('.activity_show').hasClass('collapsed-box') ){
					$.cookie('activity_show', '1');
				} else {
					$.removeCookie('activity_show');
				}
			});

			if( $.cookie('activity_show') ){
				$('.activity_show').removeClass('collapsed-box');
				$('.activity_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
			}
		});
	</script>
@stop
