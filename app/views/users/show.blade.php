@extends('template.master')


@section('title')
ELTDP - {{ ucwords(Auth::user()->name)}} 
@stop

@section('main')

	<div class="jumbotron">

		<h1 class="centered"> Welcome {{ ucwords(Auth::user()->name)}} </h1>

		<div class="col-md-12 centered">

			{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
			{{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy',  Auth::user()->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
		</div>
	</div>


	<div class="row">

		<div class="col-md-6 centered">

			{{"here"}}



		</div>


		<div class="col-md-6 centered">

		{{"here are the resources you have produced "}}


		</div>
	</div>


@stop