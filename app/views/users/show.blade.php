@extends('template.master')


@section('title')
ELTDP - {{ ucwords(Auth::user()->name)}} 
@stop

@section('main')

	<div class="jumbotron">

		<h1 class="centered"> Welcome {{ ucwords(Auth::user()->name)}} </h1>


		<div class="col-md-12 centered">

			<p>
			{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
			{{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy',  Auth::user()->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}

            </p>
		</div>
	</div>


	<div class="row">

		<div class="col-md-6 centered">

			<h3>Resources you have tried </h3>

		</div>


		<div class="col-md-6">

			<h3>Resources you have produced </h3>

			@foreach (User::find($user->id)->resources as $resource)

				  <div class="col-md-4 ">
				    <div class="thumbnail">
				      {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
				      <div class="caption">
				        <h3>{{ $resource->name }}</h3>
				        <p>{{ $resource->description }}</p>
				        <p>
				        	{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 

				        	{{ link_to_route('resources.edit', 'Edit', $resource->id, array('class' => 'btn btn-info')) }} 
				        </p>
				      </div>
				    </div>
				  </div>

			@endforeach


		</div>
	</div>


@stop