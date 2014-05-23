@extends('template.master')


@section('title')
ELTDP - {{$user->name}}
@stop

@section('main')

	<div class="jumbotron">

		<h1 class="centered"> Welcome {{ ucwords(Auth::user()->username)}} </h1>

		<div class="col-md-12 centered">

			{{-- link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) --}}
			{{-- Form::open(array('method' => 'DELETE', 'route' => array('users.destroy',  Auth::user()->id))) --}}
                {{-- Form::submit('Delete', array('class' => 'btn btn-danger')) --}}
            {{-- Form::close() --}}
		</div>
	</div>


	<div class="row">

		<div class="col-md-6 centered">

			@if( Auth::user()->is('creator'))

				<p>{{ link_to_route('users.creators.edit', 'Edit Your Creator Details', array(Auth::user()->id, Auth::user()->creator()->first()->id), array('class' => 'btn btn-info')) }}</p>

				<p>{{HTML::image(Auth::user()->creator()->first()->avatar, $user->username ,$attributes = array('height' => '200px'))}}</p>

				<p>{{Auth::user()->creator()->first()->bio}}</p>

				@if($creatorSkills = Auth::user()->creator()->first()->skills()->get()->count())

					@foreach(Auth::user()->creator()->first()->skills as $creatorSkills)

						<p>{{$creatorSkills->skills}} </p>

					@endforeach

				@endif

					

					<p>{{ link_to_route('users.creators.category_skills.index', 'Your Skills', array(Auth::user()->id, Auth::user()->creator()->first()->id), array('class' => 'btn btn-info')) }}</p>

			

			@else

				<h3>Join the creative team</h3>

				<p>If you have skills that you want to use for a new or listed project please add them here</p>
				
				<p>{{ link_to_route('users.creators.create', 'Add creator details', Auth::user()->id, array('class' => 'btn btn-primary')) }}</p>



			@endif



		</div>


		<div class="col-md-6 centered">

			@if( Auth::user()->is('donator'))

				{{ 'donator'}}

			@endif

		</div>
	</div>


@stop