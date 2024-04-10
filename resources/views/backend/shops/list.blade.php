@extends('backend.layouts.app')

@section('page-title', trans('app.shops'))
@section('page-heading', trans('app.shops'))

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>

	<section class="content">

		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('app.shops')</h3>
                <div class="pull-right box-tools">
                    @permission('shops.add')
                    @if(auth()->user()->hasRole('admin'))
                        <!-- <a href="{{ route('backend.shop.admin_create') }}" class="btn btn-primary btn-sm">@lang('app.add')</a> -->
					@elseif(auth()->user()->hasRole('distributor'))
                        <!-- <a href="{{ route('backend.shop.admin_create') }}" class="btn btn-primary hidden btn-sm">@lang('app.add')</a> -->
                    @else
						<!-- <a href="{{ route('backend.shop.create') }}" class="btn btn-primary btn-sm">@lang('app.add')</a> -->
                    @endif
                    @endpermission
                    @permission('shops.free_demo')
                        @if(!auth()->user()->free_demo)
                            <!--<a href="{{ route('backend.shop.get_demo') }}" class="btn btn-primary btn-sm">@lang('app.free_demo')</a>  -->
                        @endif
                    @endpermission
                    @if(auth()->user()->hasRole('admin'))
                        <!-- <a href="{{ route('backend.shop.fast_shop') }}" class="btn btn-primary btn-sm">@lang('app.fast_shop')</a> -->
                    @endif
                </div>

			</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
					<thead>
					<tr>
						<th>@lang('app.name')</th>
						<th>@lang('app.percent')</th>
						<th>@lang('app.currency')</th>
						<th>@lang('app.order')</th>
						<th>@lang('app.status')</th>
						
					</tr>
					</thead>
					<tbody>
					@if (count($shops))
						@foreach ($shops as $shop)
							@include('backend.shops.partials.row')
						@endforeach
					@else
						<tr><td colspan="13">@lang('app.no_data')</td></tr>
					@endif
					</tbody>
					<thead>
					<tr>
						<th>@lang('app.name')</th>
						<th>@lang('app.percent')</th>
						<th>@lang('app.currency')</th>
						<th>@lang('app.order')</th>
						<th>@lang('app.status')</th>
						
					</tr>
					</thead>
                            </table>
							{{ $shops->links() }}
                        </div>
                    </div>
		</div>

	</section>

	<!-- Modal -->
	<div class="modal fade" id="openAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('backend.shop.balance') }}" method="POST">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">@lang('app.balance') @lang('app.pay_in')</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="AddSum">@lang('app.sum')</label>
							<input type="text" class="form-control" id="AddSum" name="summ" placeholder="@lang('app.sum')" required>
							<input type="hidden" name="type" value="add">
							<input type="hidden" id="AddId" name="shop_id">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('app.close')</button>
						<button type="submit" class="btn btn-primary">@lang('app.pay_in')</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="openOutModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('backend.shop.balance') }}" method="POST" id="outForm">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">@lang('app.balance') @lang('app.pay_out')</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="OutSum">@lang('app.sum')</label>
							<input type="text" class="form-control" id="OutSum" name="summ" placeholder="@lang('app.sum')" required>
							<input type="hidden" id="outAll" name="all" value="0">
							<input type="hidden" name="type" value="out">
							<input type="hidden" id="OutId" name="shop_id">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('app.close')</button>
						<button type="button" class="btn btn-danger" id="doOutAll">@lang('app.pay_out') @lang('app.all')</button>
						<button type="submit" class="btn btn-primary">@lang('app.pay_out')</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@stop

@section('scripts')
	<script>
		$('#shops-table').dataTable();
		$("#view").change(function () {
			$("#shops-form").submit();
		});
		$('.addPayment').click(function(event){
			console.log($(event.target));
			var item = $(event.target).hasClass('addPayment') ? $(event.target) : $(event.target).parent();
			var id = item.attr('data-id');
			$('#AddId').val(id);
		});

		$('.outPayment').click(function(event){
			console.log($(event.target));
			var item = $(event.target).hasClass('outPayment') ? $(event.target) : $(event.target).parent();
			var id = item.attr('data-id');
			$('#OutId').val(id);
			$('#outAll').val('0');
		});


		$('#doOutAll').click(function () {
			$('#outAll').val('1');
			$('form#outForm').submit();
		});

		$('.btn-box-tool').click(function(event){
			if( $('.shops_show').hasClass('collapsed-box') ){
				$.cookie('shops_show', '1');
			} else {
				$.removeCookie('shops_show');
			}
		});

		if( $.cookie('shops_show') ){
			$('.shops_show').removeClass('collapsed-box');
			$('.shops_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
		}
	</script>
@stop
