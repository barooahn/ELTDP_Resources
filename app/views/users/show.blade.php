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
				  		{{ link_to_route('users.edit', 'Edit', array(Auth::user()->id), array('class' => 'btn btn-info')) }} 
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

		<div class="col-xs-12 col-sm-12 col-md-6">

			<h3 class="centered">Resources you have tried </h3>

			@foreach (User::showLiked(Auth::user()->id) as $resource)

				<div class="col-xs-12 col-sm-6 col-md-6">
					    <div class="thumbnail thumbnail_small">
					    	<div class="frame"> 	
					      		{{HTML::image($resource->picture, $resource->name ,$attributes = array('width' => '100%'))}}
					     	</div>
					      	<div class="caption thumb_caption">
					        	<h3>{{ $resource->name }}</h3>
					        	{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 30)) }}...
					       	</div>

			        		{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
							@include('template.addToUserButton')

					    	@include('template.review')
					    </div>
				  </div>

			@endforeach

		</div>


		<div class="col-xs-12 col-sm-12 col-md-6">

			<h3  class="centered">Your resources </h3>

			@foreach (User::find(Auth::user()->id)->resources as $resource)

				  <div class="col-xs-12 col-sm-6 col-md-6">
					    <div class="thumbnail thumbnail_small">
					    	<div class="frame"> 	
					      		{{HTML::image($resource->picture, $resource->name ,$attributes = array('width' => '100%'))}}
					     	</div>
					      	<div class="caption thumb_caption">
					        	<h3>{{ $resource->name }}</h3>
					        	{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 30)) }}...
					        </div>

					        	<p>
					        		{{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
					        		@if ($resource->private != 1)
					        			{{ link_to_route('makePrivate', 'Make Private', $resource->id, array('class' => 'btn btn-danger')) }} 
					        		@endif
					        		@if ($resource->private == 1)
					        			{{ link_to_route('makePublic', 'Make Public', $resource->id, array('class' => 'btn btn-success')) }}
					        		@endif
					        	</p>
					    	

					      	@if ($resource->private == 1)
						    	<div class="private">
						    		<p><strong>Private</strong></p>
						    	</div>
						    @endif

						    @include('template.review')
					    </div>
				  </div>

			@endforeach


		</div>
	</div>


@stop