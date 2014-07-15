<?php

class Review extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'comment' => 'required',
		'rating' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function resource()
    {
        return $this->belongsTo('Resource');
    }

    public function user()
	{
		return $this->belongsTo('User');
	}

	public function scopeApproved($query)
	{
		return $query->where('approved', true);
	}

	public function scopeSpam($query)
	{
		return $query->where('spam', true);
	}

	public function scopeNotSpam($query)
	{
		return $query->where('spam', false);
	}

	public function getTimeagoAttribute()
	{
	  $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
	  return $date;
	}
	// this function takes in resource ID, comment and the rating and attaches the review to the resource by its ID, then the average rating for the product is recalculated
	public function storeReviewForProduct($resource_id, $comment, $rating)
	{
	  $resource = Resource::find($resource_id);

	  // this will be added when we add user's login functionality
	  $this->user_id = Auth::user()->id;
	  $this->comment = $comment;
	  $this->rating = $rating;
	  $resource->reviews()->save($this);

	  // recalculate ratings for the specified resource
	  $resource->recalculateRating();
	}

}