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
	    <div class="col-md-4">

			{{ Form::open(array('route' => 'resources.store', 'files' => true)) }}

				<ul>

					<li>
						{{ Form::label('school', 'School:', array('class' => 'label label-warning')) }}

						{{ Form::select('school', $options['school_options'] , Input::old('school')) }}

					</li>

					<li>
						{{ Form::label('year', 'Year:', array('class' => 'label label-warning')) }}

						{{ Form::select('year', $options['year_options'] , Input::old('year')) }}

					</li>

					<li>
						{{ Form::label('unit', 'Unit:', array('class' => 'label label-warning')) }}

						{{ Form::select('unit', $options['unit_options'] , Input::old('unit')) }}

					</li>

					<li>
						{{ Form::label('type', 'Type:', array('class' => 'label label-warning')) }}
					
						{{ Form::select('type', $options['resourceType_options'] , Input::old('type')) }}

					</li>

					<li>
						{{ Form::label('name', 'Name:', array('class' => 'label label-warning')) }}

						{{Form::text('name', 'examplgmail.doc', array('class' => 'form-control'), Input::old('name')) }}

					</li>

					<li>
				        {{ Form::label('file', 'File to upload:', array('class' => 'label label-warning')) }}

				       
				        {{ Form::file('file') }}

				        
				    </li>

					<li>
						{{ Form::label('description', 'Description:', array('class' => 'label label-warning')) }}

						{{Form::textarea('description', 'example@gmail.com') }}
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

