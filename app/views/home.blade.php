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

        <div class="col-md-3"><h1> highest rated 1</h1></div>
        <div class="col-md-3"><h1> highest rated 2</h1></div>
        <div class="col-md-3"><h1> highest rated 3</h1></div>
        <div class="col-md-3"><h1> highest rated 4</h1></div>
        
    </div>

    <div class="row">


        <h4>Latest</h4>

        <div class="col-md-3"><h1> Latest 1</h1></div>
        <div class="col-md-3"><h1> Latest rated 2</h1></div>
        <div class="col-md-3"><h1> Latest rated 3</h1></div>
        <div class="col-md-3"><h1> Latest rated 4</h1></div>
        
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