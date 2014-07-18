@foreach($resources as $resource)
        
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="thumbnail">
            <div class="frame">   
                {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
            </div>
            <div class="caption">
                <h3>{{ $resource->name }}</h3>
                <p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 20)) }}...</p>
                <p>
                    {{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
                </p>

                  @include('template.review')
            </div>
        </div>
    </div>

@endforeach