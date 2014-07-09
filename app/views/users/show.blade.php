@extends('template.master')


@section('title')
ELTDP - {{ ucwords(Auth::user()->name)}} 
@stop

@section('main')
	<div class="row jumbotron">


			<div class="col-md-12 buttons">

				  <div class="col-md-10 col-md-push-2">

				  	<h1> Welcome {{ ucwords(Auth::user()->name)}} </h1>

				  </div>
				  <div class="col-md-2 col-md-pull-10 buttons">

				  	<span class = "padding">
				  		{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }} 
				  		</span>
					<span class = "padding">
						{{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy',  Auth::user()->id))) }}
		                	{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
		            	{{ Form::close() }}
		            </span>

		          </div>
		    </div>

	</div>

	<div class="row">

		<div class="col-md-6 centered">

			<h3>Resources you have tried </h3>

		</div>


		<div class="col-md-6 centered">

			<h3>Your resources </h3>

			@foreach (User::find($user->id)->resources as $resource)

				  <div class="col-xs-6 col-sm-6 col-md-6">
					    <div class="thumbnail">
					    	<div class="frame"> 	
					      		{{HTML::image($resource->file, $resource->name ,$attributes = array('height' => '100%'))}}
					     	</div>
					      	<div class="caption">
					        	<h3>{{ $resource->name }}</h3>
					        	<p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 30)) }}...
					        	</p>
					        	<p>
					        		{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
					        	</p>
					    	</div>

					      	@if ($resource->private == 1)
						    	<div class="private">
						    		<p><strong>Private</strong></p>
						    	</div>
						    @endif
					    </div>
				  </div>

			@endforeach


		</div>
	</div>


@stop