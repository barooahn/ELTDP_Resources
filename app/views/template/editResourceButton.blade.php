@if(Auth::user() && Auth::user()->id == $resource->user_id)

{{ link_to_route('resources.edit', 'Edit', array($resource->id), array('class' => 'btn btn-info')) }}

@endif