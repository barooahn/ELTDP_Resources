<div class="ratings">
    <p class="pull-right">{{$resource->count_rating}} {{ Str::plural('review', $resource->count_rating);}}</p>
	<p>
		@for ($i=1; $i <= 5 ; $i++)
		  	<span class="glyphicon glyphicon-star{{ ($i <= $resource->cache_rating) ? '' : '-empty'}}"></span>
		@endfor
		{{ number_format($resource->cache_rating, 1);}} stars
	</p>
</div>