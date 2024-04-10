<tr>
    <td>
		<a href="{{ route('backend.game.edit', $game->id) }}">
		{{ $game->title }}
		</a>
	</td>

	<td>{{ $game->stat_in }}</td>
	<td>{{ $game->stat_out }}</td>
	<td>
		@if(($game->stat_in - $game->stat_out) >= 0)
			<span class="text-green">
		@else
			<span class="text-red">
		@endif
		{{ number_format(abs($game->stat_in-$game->stat_out), 2, '.', '') }}
		</span>
	</td>
	<td>
		{{ $game->stat_in > 0 ? number_format(($game->stat_out / $game->stat_in) * 100, 2, '.', '') : '0.00' }}
	</td>

	<td>{{ $game->bids }}</td>
	<td>
		@if(!$game->view)
			<small><i class="fa fa-circle text-red"></i></small>
		@else
			<small><i class="fa fa-circle text-green"></i></small>
		@endif
	</td>
<td>


</td>
</tr>