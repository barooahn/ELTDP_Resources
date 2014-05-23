@extends('template.master')


@section('title')
ELTDP - {{$resource->name}}
@stop

@section('main')

<div class="container">
<h1>{{$resource->name}}</h1> 

	<div class="row">

		<div class="col-md-8 ">	


			<p>{{ link_to_route('resources.edit', 'Edit', $resource->id, array('class' => 'btn btn-info')) }}</p>

			@if($resource->file)
					    		
				{{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
			@else
				<img data-src="holder.js/300x200" alt="...">
			@endif
			<div class="caption">

				<h2>Description</h2>
				<p>{{$resource-> description}}</p>
				
				<p>School : {{ $resource->school }}</p>

				<p>Year : {{ $resource->year }}</p>

				<p>Unit : {{ $resource->unit }}</p>

				
			</div>
		</div>

		<div class="col-md-4">

			<h4>Creator</h4>

			<p>Other work by this creator</p>

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<div class="well">

	        </div>

        </div>

    </div>

</div>

@stop