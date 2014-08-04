@if ($resource->private != 1)
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="thumbnail thumbnail_small">
            <div class="frame">     
                {{HTML::image($resource->picture, $resource->name ,$attributes = array('width' => '100%'))}}
            </div>
            <div class="caption thumb_caption">
                <h3>{{ $resource->name }}</h3>
                <p>
                    
                </p>
                <p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 30)) }}...</p>
            </div>
            <div class="thumb_container">
                <div class="buttons_review">
                    <p>
                        @include('template.moreButton') 
                        @include('template.downloadButton')
                    </p>

                    @include('template.review')
                </div>
            </div>
        </div>
    </div>

@endif

