@if(Auth::user() && Auth::user()->id == $resource->user_id)

{{ Form::open(array('method' => 'DELETE', 'route' => array('resources.destroy', $resource->id))) }}
    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
{{ Form::close() }}

@endif