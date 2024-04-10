@extends('backend.layouts.app')

@section('page-title', trans('app.pincodes'))
@section('page-heading', trans('app.pincodes'))

@section('content')

	<section class="content-header">
		@include('backend.partials.messages')
	</section>
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('app.pincode')</h3>
				@permission('pincodes.add')
				<div class="pull-right box-tools">
					<a href="{{ route('backend.pincode.create') }}" class="btn btn-block btn-primary btn-sm">@lang('app.add')</a>
				</div>
				@endpermission
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped">
					<thead>
					<tr>
						<th>@lang('app.pincode')</th>
						<th>@lang('app.nominal')</th>
						<th>@lang('app.status')</th>
					</tr>
					</thead>
					<tbody>
					@if (count($pincodes))
						@foreach ($pincodes as $pincode)
							@include('backend.pincodes.partials.row')
						@endforeach
					@else
						<tr><td colspan="3">@lang('app.no_data')</td></tr>
					@endif
					</tbody>
					<thead>
					<tr>
						<th>@lang('app.pincode')</th>
						<th>@lang('app.nominal')</th>
						<th>@lang('app.status')</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</section>

@stop

@section('scripts')
    <script>
		$(function() {
			$('#pincodes-table').dataTable();

			$('.dates').daterangepicker({
				//autoUpdateInput: false,
				timePicker: true,
				timePicker24Hour: true,
				startDate: moment().subtract(30, 'day'),
				endDate: moment().add(7, 'day'),
				locale: {
					format: 'YYYY-MM-DD HH:mm',
				},
			});
			$('.dates').on('cancel.daterangepicker', function(ev, picker) {
				$(picker.element).val('');
			});

		});
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
		});

			$('.btn-box-tool').click(function(event){
				if( $('.pin_show').hasClass('collapsed-box') ){
					$.cookie('pin_show', '1');
				} else {
					$.removeCookie('pin_show');
				}
			});

			if( $.cookie('pin_show') ){
				$('.pin_show').removeClass('collapsed-box');
				$('.pin_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
			}
    </script>
@stop