@extends('template.master')


@section('title')
ELTDP - {{$resource->name}}
@stop

@section('template.reviewScript')
	{{-- review script --}}
@stop

@section('main')

<div class="container">
<h1>{{$resource->name}}</h1> 

	<div class="row">

		<div class="col-md-6 ">	
			<div class="thumbnail">

				@if($resource->file)

						    		
					{{HTML::image($resource->file, $resource->name ,$attributes = array('width' => '100%'))}}
				@else
					<img data-src="holder.js/300x200" alt="...">
				@endif
				<div class="caption">

					<h2>Description</h2>
					<p>{{$resource-> description}}</p>
					
					<p>School : {{ $resource->school }}</p>

					<p>Year : {{ $resource->year }}</p>

					<p>Unit : {{ $resource->unit }}</p>

					
				</div>

			<!--reviews -->
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
            <div class="well" id="reviews-anchor">
              <div class="row">
                <div class="col-md-12">
                  @if(Session::get('errors'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h5>There were errors while submitting this review:</h5>
                       @foreach($errors->all('<li>:message</li>') as $message)
                          {{$message}}
                       @endforeach
                    </div>
                  @endif
                  @if(Session::has('review_posted'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been posted!</h5>
                    </div>
                  @endif
                  @if(Session::has('review_removed'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been removed!</h5>
                    </div>
                  @endif
                </div>
              </div>
              <div class="text-right">
                <a href="#reviews-anchor" id="open-review-box" class="btn btn-success btn-green">Leave a Review</a>
              </div>
              <div class="row" id="post-review-box" style="display:none;">
                <div class="col-md-12">
                  {{Form::open()}}
                  {{Form::hidden('rating', null, array('id'=>'ratings-hidden'))}}
                  {{Form::textarea('comment', null, array('rows'=>'5','id'=>'new-review','class'=>'form-control animated','placeholder'=>'Enter your review here...'))}}
                  <div class="text-right">
                    <div class="stars starrr" data-rating="{{Input::old('rating',0)}}"></div>
                    <a href="#" class="btn btn-danger btn-sm" id="close-review-box" style="display:none; margin-right:10px;"> <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                  </div>
                {{Form::close()}}
                </div>
              </div>

              @foreach($reviews as $review)
              <hr>
                <div class="row">
                  <div class="col-md-12">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                    @endfor

                    {{ $review->user ? $review->user->name : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span> 
                    
                    <p>{{{$review->comment}}}</p>
                  </div>
                </div>
              @endforeach
              {{ $reviews->links(); }}
            </div>
        </div>

	<!-- end of reviews -->


		<div class="col-md-6">

			<h4>Creator - {{ $resource->user->name }}</h4>



			<p>Other work by {{ $resource->user->name }}:</p>

			@foreach (User::find($resource->user->id)->resources as $resource)

				@if ($resource->private != 1)
					<div class="col-xs-6 col-sm-6 col-md-6">
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

				                @if(Auth::check())

                        <p>
                           {{ link_to_route('add_to_user', 'Add to my resources...', $resource->id, array('class' => 'btn btn-warning')) }} 
                        </p>   
                        @endif

                        

				                @include('template.review')
				            </div>
				        </div>
					</div>
	
				@endif
			
			@endforeach

		</div>

	</div>

</div>

@stop