<tr>        
    <td>
		<a href="{{ route('backend.shop.edit', $shop->shop_id) }}">{{ $shop->name }}</a>
	</td>
	<td>{{ $shop->get_percent_label($shop->percent) }}</td>
	<td>{{ $shop->currency }}</td>
	<td>{{ $shop->orderby }}</td>
	<td>
		@if($shop->is_blocked)
			<small><i class="fa fa-circle text-red"></i></small>
		@else
			<small><i class="fa fa-circle text-green"></i></small>
		@endif
	</td>
</tr>