@extends('template.master')


@section('title')
ELTDP - All Resources
@stop

@section('main')

<div class="container">

	@if($resources->count())

		<h1>All Resources</h1>

		{{ link_to_route('resources.create', 'Add new resource', array(), array('class' => 'btn btn-info')) }}

		<div class="centered">



		
		</div>
		@foreach($resources as $resource)

			@if ($resource->private != 1)
			<div class="row ">
				<div class="col-sm-12 col-md-12 row_bottom_pad thumbnail">
					<div class="col-sm-4 col-md-4 row_bottom_pad ">
						<h4>{{ $resource->name }}</h4>
						@if($resource->picture)

							<div class="frame">
							
							{{HTML::image($resource->picture, $resource->name ,$attributes = array('width' => '100%'))}}

							</div>
						@else
								<img data-src="holder.js/300x200" alt="...">
						@endif

					</div>

					<div class="col-sm-4 col-md-4 row_bottom_pad ">	
						<h4>Description</h4>
						<p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 80)) }}...</p>

					</div>

					<div class="col-sm-4 col-md-4 row_bottom_pad ">	

						<h4>Details</h4>
						<p>School : {{ $resource->school }}</p>

						<p>Year : {{ $resource->year }}</p>

						<p>Unit : {{ $resource->unit }}</p>

						<p>
							@include('template.downloadButton')
							{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }}
							@include('template.addToUserButton')
						</p>

						@include('template.review')
					</div>
							
					
			  	</div>
			</div>

			@endif
		@endforeach

		<div class="centered"></div>

	@else 
	
		<div class="alert alert-warning" role="alert">There were no search results for {{ Request::get('q') }}</div>	
	
	@endif

</div>
@stop
