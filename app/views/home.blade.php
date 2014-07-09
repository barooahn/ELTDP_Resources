@extends('template.master')


@section('title')
ELTDP
@stop

@section('main')
<div class="container">

    <h1 class="text-center">ELTDP Resources</h1>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form role="search">
                  <input type="text" class="form-control" placeholder="Search">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
     
    <div class="row">

        <h4>Higest rated</h4>

        <?php $resources = Home::showTopResources(4); ?>
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
                        </div>
                </div>
            </div>

        @endforeach
        
    </div>

    <div class="row">


        <h4>Most commented</h4>

        <div class="col-md-3"><h1> Most commented 1</h1></div>
        <div class="col-md-3"><h1> Most commented 2</h1></div>
        <div class="col-md-3"><h1> Most commented 3</h1></div>
        <div class="col-md-3"><h1> Most commented 4</h1></div>
        
    </div>

</div>
@stop