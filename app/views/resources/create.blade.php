@extends('template.master')


@section('title')
ELTDP - Create New Resource
@stop

@section('main')

<div class="container">
	<h1>New Resource</h1> 


	@if (Session::has('errors'))

	<div class="alert alert-danger">

		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>

	</div>
	@endif


	<div class="row">
	    <div class="col-md-5">

			{{ Form::open(array('route' => 'resources.store', 'files' => true)) }}

				<ul>

					<li>
						{{ Form::label('school', 'School:', array('class' => 'label label-warning')) }}

						

						@if (count($options['school_options']) != null)

							{{ Form::select('school', $options['school_options'] , Input::old('school')) }}

							{{ link_to_route('schools.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}

						@else

							{{ link_to_route('schools.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif


					</li>

					<li>

						{{ Form::label('year', 'Year:', array('class' => 'label label-warning')) }}

						@if (count($options['year_options']) != null)

							{{ Form::select('year', $options['year_options'] , Input::old('year')) }}

							{{ link_to_route('years.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}

						@else

						{{ link_to_route('years.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif

					</li>

					<li>
						{{ Form::label('unit', 'Unit:', array('class' => 'label label-warning')) }}

						@if (count($options['unit_options']) != null)

							{{ Form::select('unit', $options['unit_options'] , Input::old('unit')) }}

							{{ link_to_route('units.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}

						@else

							{{ link_to_route('units.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif

					</li>

					<li>
						{{ Form::label('type', 'Type:', array('class' => 'label label-warning')) }}
					
						{{ Form::select('type', $options['resourceType_options'] , Input::old('type')) }}

						@if (count($options['resourceType_options']) != null)

							{{ link_to_route('type.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}

						@else

							{{ link_to_route('type.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif

					</li>

					<li>
						{{ Form::label('name', 'Name:', array('class' => 'label label-warning')) }}

						{{Form::text('name', 'Animal flashcards', array('class' => 'custom_box form-control'), Input::old('name')) }}

					</li>

					<li>
				        {{ Form::label('file', 'File to upload:', array('class' => 'label label-warning')) }}

				       
				        {{ Form::file('file') }}

				        
				    </li>

					<li>
						{{ Form::label('description', 'Description:', array('class' => 'label label-warning')) }}

						{{Form::textarea('description', 'A set of 24 Animal flash cards') }}
					</li>

					<li>

						{{Form::hidden('user_id', Auth::user()->id) }}
					</li>

					<li>

						{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
					</li>
				</ul>

			{{ Form::close() }}
	    </div>
	</div>


</div>


@stop

