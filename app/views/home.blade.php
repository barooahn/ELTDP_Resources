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
        @include('template.displayOne')

    </div>

    <div class="row">


        <h4>Latest</h4>


        <?php $resources = Home::showNewResources(4); ?>
        
        @include('template.displayOne')
        
    </div>

</div>
@stop