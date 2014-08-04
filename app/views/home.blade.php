@extends('template.master')


@section('title')
ELTDP
@stop

@section('main')


<h1 class="text-center">ELTDP Resources</h1>
 
<div class="row">

    <h2>Higest rated</h2>

    <?php $resources = Home::showTopResources(4); ?>

    @foreach($resources as $resource)
        @include('template.thumbnail')
    @endforeach

</div>

<div class="row">


    <h2>Latest</h2>

    <?php $resources = Home::showNewResources(4); ?>
    
    @foreach($resources as $resource)
        @include('template.thumbnail')
    @endforeach
    
</div>

@stop