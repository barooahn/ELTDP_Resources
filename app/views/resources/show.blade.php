@extends('template.master')


@section('title')
ELTDP - {{$resource->name}}
@stop

@section('main')

<div class="container">
<h1>{{$resource->name}}</h1> 

	<div class="row">

		<div class="col-md-6 ">	

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

		<div class="col-md-6">

			<h4>Creator - {{ $resource->user->name }}</h4>



			<p>Other work by {{ $resource->user->name }}:</p>

			@foreach (User::find($resource->user->id)->resources as $resource)

			
			  <div class="col-xs-6 col-sm-6 col-md-6">
			    <div class="thumbnail">
			      {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
			      <div class="caption">
			        <h3>{{ $resource->name }}</h3>
			        <p>{{ $resource->description }}</p>
			        <p>
			        	{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
			        </p>
			      </div>
			    </div>
			  </div>
			
			@endforeach

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