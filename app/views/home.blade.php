@extends('template.master')


@section('title')
ELTDP
@stop

@section('main')
<div class="container">

    <h1 class="text-center">ELTDP Resources</h1>
     
    <div class="row">

        <h4>Higest rated</h4>

        <?php $resources = Home::showTopResources(4); ?>
        @foreach($resources as $resource)
        
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="thumbnail thumbnail_small">
                        <div class="frame">   
                                {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
                        </div>
                        <div class="caption">
                            <h3>{{ $resource->name }}</h3>
                            <p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 20)) }}...</p>
                            <p>
                                {{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
                            </p>
                        

                            <div class="ratings">
                                  <p class="pull-right">{{$resource->count_rating}} {{ Str::plural('review', $resource->count_rating);}}</p>
                                  <p>
                                    @for ($i=1; $i <= 5 ; $i++)
                                      <span class="glyphicon glyphicon-star{{ ($i <= $resource->cache_rating) ? '' : '-empty'}}"></span>
                                    @endfor
                                    {{ number_format($resource->cache_rating, 1);}} stars
                                  </p>
                            </div>

                        </div>
                </div>
            </div>

            

        @endforeach

    </div>

    <div class="row">


        <h4>Latest</h4>


        <?php $resources = Home::showNewResources(4); ?>
        @foreach($resources as $resource)
        
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="thumbnail thumbnail_small">
                        <div class="frame">   
                                {{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
                        </div>
                        <div class="caption">
                            <h3>{{ $resource->name }}</h3>
                            <p>{{ implode(' ', array_slice(explode(' ', $resource->description), 0, 20)) }}...</p>
                            <p>
                                {{ link_to_route('resources.show', 'More...', $resource->id, array('class' => 'btn btn-info')) }} 
                            </p>

                             <div class="ratings">
                                  <p class="pull-right">{{$resource->count_rating}} {{ Str::plural('review', $resource->count_rating);}}</p>
                                  <p>
                                    @for ($i=1; $i <= 5 ; $i++)
                                      <span class="glyphicon glyphicon-star{{ ($i <= $resource->cache_rating) ? '' : '-empty'}}"></span>
                                    @endfor
                                    {{ number_format($resource->cache_rating, 1);}} stars
                                  </p>
                            </div>
                        </div>
                </div>
            </div>

        @endforeach
        
    </div>

</div>
@stop