@extends('template.master')


@section('title')
ELTDP - Thanks for registering
@stop

@section('main')

<div class="container">
	<div class="jumbotron">

		<h1> Thank you {{ucwords($user->name) }} for registering. </h1>

	</div>
</div>
<div class="container">
	<div class = "well">Please check {{$user->email}} email to continue!</div>

</div>



@stop