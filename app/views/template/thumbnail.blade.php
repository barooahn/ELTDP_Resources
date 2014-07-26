@if ($resource->private != 1)
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="thumbnail thumbnail_small">
            <div class="frame">     
                {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
            </div>
            <div class="caption">
                <h3>{{ $resource->name }}</h3>
                <p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 30)) }}...</p>
                <div class="thumb_container">
                    <div class="buttons_review">
                        <p>
                            {{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
                            @if(Auth::user())
                                @if (!Auth::user()->resource->contains($resource->id)) 
                                    {{ link_to_route('addToUser', 'Add to My Home', $resource->id, array('class' => 'btn btn-warning')) }} 
                                @endif
                            @endif
                        </p>

                        @include('template.review')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

