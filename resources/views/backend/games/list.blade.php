@extends('backend.layouts.app')

@section('page-title', trans('app.games'))
@section('page-heading', trans('app.games'))

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{ $stats['in'] }}</h3>
						<p>Проиграно пользователями</p>
					</div>
					<div class="icon">
						<i class="fa fa-level-up"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{ $stats['out'] }}</h3>
						<p>Выиграно пользователями</p>
					</div>
					<div class="icon">
						<i class="fa fa-level-down"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>{{ $percent }}</h3>
						<p>@lang('app.average_RTP'): {{ number_format( $stats['rtp'], 2 ) }}</p>
					</div>
					<div class="icon">
						<i class="fa fa-area-chart"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{ number_format($stats['games']) }}</h3>
						<p>Всего игр</p>
					</div>
					<div class="icon">
						<i class="fa fa-star"></i>
					</div>
				</div>
			</div>
		</div>

		@if( Auth::user()->shop && Auth::user()->shop->pending )
			<div class="alert alert-warning">
				<h4>@lang('app.shop_is_creating')</h4>
				<p>@lang('app.games_will_be_added_in_few_minutes')</p>
			</div>
		@endif

		@if( !Auth::user()->shop || (Auth::user()->shop && !Auth::user()->shop->pending) )

		@if(auth()->user()->hasRole('admin'))
			<form action="{{ route('backend.game.mass') }}" method="POST" class="pb-2 mb-3 border-bottom-light">
		@else
			<form action="{{ route('backend.game.view') }}" method="POST" class="pb-2 mb-3 border-bottom-light" id="viewForm">
		@endif

				<input type="hidden" value="<?= csrf_token() ?>" name="_token">

			<div class="box box-primary">
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>@lang('app.game')</th>
								<th>@lang('app.in')</th>
								<th>@lang('app.out')</th>
								<th>@lang('app.total')</th>
								<th>@lang('app.rtp')</th>
							<th>@lang('app.count2')</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@if (count($games))
							@foreach ($games as $game)
								@include('backend.games.partials.row')
							@endforeach
						@else
							<tr><td colspan="9">@lang('app.no_data')</td></tr>
						@endif
						</tbody>
						<thead>
						<tr>
							<th>@lang('app.game')</th>
							@permission('games.rtp')
								<th>@lang('app.in')</th>
								<th>@lang('app.out')</th>
								<th>@lang('app.total')</th>
								<th>@lang('app.rtp')</th>
							@endpermission
							@permission('games.show_count')
							<th>@lang('app.count2')</th>
							@endpermission
							@if( auth()->user()->hasRole('admin') )
								<th>@lang('app.denomination')</th>
							@endif
							<th>@lang('app.view')</th>
						</tr>
						</thead>
                            </table>
                        </div>
                    </div>
			</div>
		@if(auth()->user()->hasRole('admin'))
		</form>
		@endif

		@endif


		<div class="modal fade" id="openAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="" method="POST" id="gamebank_add">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">@lang('app.balance') @lang('app.pay_in')</h4>
						</div>

						<div class="modal-body">
							<div class="form-group">
								<input type="hidden" class="form-control" id="AddSum" name="summ" placeholder="@lang('app.sum')" required>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<br>

									<button type="button" class="btn btn-default changeAddSum" data-value="100">100</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="200">200</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="300">300</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="400">400</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="500">500</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="1000">1000</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="2000">2000</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="3000">3000</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="4000">4000</button>
									<button type="button" class="btn btn-default changeAddSum" data-value="5000">5000</button>

							</div>
						</div>
						<div class="modal-footer" style="text-align: left;">
							<a href="" class="btn btn-warning openAddClear"><b>@lang('app.reset')</b></a>
						</div>
					</form>
				</div>
			</div>
		</div>

	</section>

@stop

@section('scripts')

	<script>
		var table = $('#games-table').DataTable({
			orderCellsTop: true,
			dom: '<"toolbar">frtip',

		});

		$("#filter").detach().appendTo("div.toolbar");

		//$('#games-table').dataTable();
		$("#view").change(function () {
			$("#games-form").submit();
		});
		$("#device").change(function () {
			$("#games-form").submit();
		});
		$("#category").change(function () {
			$("#games-form").submit();
		});

		$('.checkAll').on('ifChecked', function(event){
			$('.minimal').iCheck('check');
		});

		$('#enableGames').click(function () {
			$('#action').val('enable');
			$('#viewForm').submit();
		});
		$('#disableGames').click(function () {
			$('#action').val('disable');
			$('#viewForm').submit();
		});

		$('.checkAll').on('ifUnchecked\t', function(event){
			$('.minimal').iCheck('uncheck');
		});

		$('.checkAll').click(function(event){
			if($(event.target).is(':checked') ){
				$('input[type=checkbox]').attr('checked', true);
			}else{
				$('input[type=checkbox]').attr('checked', false);
			}
		});

		$('.btn-box-tool').click(function(event){
			if( $('.games_show').hasClass('collapsed-box') ){
				$.cookie('games_show', '1');
			} else {
				$.removeCookie('games_show');
			}
		});

		if( $.cookie('games_show') ){
			$('.games_show').removeClass('collapsed-box');
			$('.games_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
		}

	</script>
@stop