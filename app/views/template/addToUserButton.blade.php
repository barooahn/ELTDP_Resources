@if(Auth::user() && Auth::user()->id != $resource->user_id)
    @if (!Auth::user()->resource->contains($resource->id)) 
        {{ link_to_route('addToUser', 'Save', $resource->id, array('class' => 'btn btn-success')) }} 
    @elseif (Auth::user()->resource->contains($resource->id)) 
        {{ link_to_route('removeFromUser', 'Remove', $resource->id, array('class' => 'btn btn-danger')) }} 
    @endif
@endif