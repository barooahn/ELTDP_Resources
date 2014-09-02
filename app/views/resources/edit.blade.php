@extends('template.master')


@section('title')
ELTDP - Edit - {{$resource->name}}
@stop

@section('main')

<div class="container">
	<h1>Edit - {{$resource->name}}</h1> 

	<div class="row">
	    <div class="col-md-12 col-md-12 col-md-12 col-lg-12">
	    {{ Form::model($resource, array('method' => 'PATCH', 'route' => array('resources.update', $resource->id), 'files' => true)) }}

				<ul class ="form_left col-xs-12 col-sm-12 col-md-6 col-lg-6">

					<li><p>
						{{ Form::label('school', 'School:', array('class' => 'label label-warning')) }}

						
						<div>
						@if (count($options['school_options']) != null)

							{{ Form::select('school', $options['school_options'] , $resource->school, array('class' => 'create_width selectpicker')) }}

							@if(Auth::user()->admin == 1)
								{{ link_to_route('schools.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}
							@endif
						@else

							{{ link_to_route('schools.edit', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif
						</div>
						</p>
					</li>

					<li><p>

						{{ Form::label('year', 'Year:', array('class' => 'label label-warning')) }}

						<div>
						@if (count($options['year_options']) != null)

							{{ Form::select('year', $options['year_options'] , $resource->year, array('class' => 'create_width selectpicker ')) }}
							@if(Auth::user()->admin == 1)
								{{ link_to_route('years.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}
							@endif
						@else

						{{ link_to_route('years.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif
						</div>
						</p>
					</li>

					<li><p>
						{{ Form::label('unit', 'Unit:', array('class' => 'label label-warning')) }}
						<div>
						@if (count($options['unit_options']) != null)

							{{ Form::select('unit', $options['unit_options'] , $resource->unit, array('class' => 'selectpicker create_width')) }}
							@if(Auth::user()->admin == 1)
								{{ link_to_route('units.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}
							@endif
						@else

							{{ link_to_route('units.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif
						</div>
						</p>
					</li>

					<li><p>
						{{ Form::label('type', 'Type:', array('class' => 'label label-warning')) }}
						<div>
						{{ Form::select('type', $options['resourceType_options'] , $resource->type, array('class' => 'selectpicker create_width')) }}

						@if (count($options['resourceType_options']) != null)
							@if(Auth::user()->admin == 1)
								{{ link_to_route('type.create', 'Add +', array(''), array('class' => 'btn btn-info')) }}
							@endif
						@else

							{{ link_to_route('type.create', 'New', array(''), array('class' => 'btn btn-info')) }}

						@endif
						</div>
						</p>
					</li>

					<li><p>
						{{ Form::label('name', 'Name:', array('class' => 'label label-warning')) }}
						<div>
						{{Form::text('name', $resource->name, array('class' => 'custom_box form-control create_width', 'placeholder' => 'Animal flashcards'), $resource->name) }}
						</div>
						</p>
					</li>

					<li><p>
						{{Form::hidden('user_id', Auth::user()->id) }}
						</p>
					</li>

				</ul>

				<ul class ="form_right col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<li><p>
				        {{ Form::label('file', 'File to upload:', array('class' => 'label label-warning')) }}

				       	<div class="create_width input-group input_file ">
			                <span class="input-group-btn">
			                    <span class="btn btn-primary btn-file">
			                        Browse&hellip; {{ Form::file('file') }}
			                    </span>
			                </span>
			                <input type="text" class="form-control" readonly>
			            </div>
				        </p>
				    </li>
				
					<li>
						<p>

							<span class = "create_width">
								{{ Form::label('description', 'Description:', array('class' => 'label label-warning')) }}
								<div>
								{{Form::textarea('description', $resource->description, array('id' => 'editor1', 'class' => 'ckeditor', 'placeholder' => 'A set of 24 Animal flash cards')) }}	
								</div>
							</span>


						</p>
					</li>

					<li>

						{{Form::hidden('id', $resource->id) }}	

					</li>

					<li><p>
						{{ Form::label('private', 'Check for private:', array('class' => 'label label-warning')) }}

						{{ Form::checkbox('private', '1') }}

					</li></p>

					<li><p>

						{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
						{{ link_to_route('resources.show', 'Cancel', $resource->id, array('class' => 'btn btn-danger')) }}
						</p>
					</li>
				
				</ul>

			{{ Form::close() }}
	    </div>
	</div>


</div>


@stop

