<?php

class Resource extends \Eloquent {

	// Add your validation rules here
	public static $rules = array(
        'type'			=> 'required',
        'name'			=> 'required|unique:resources,name',
        'description'	=> 'required|unique:resources,description',
        'school'		=> 'required',
        'year'			=> 'required',
        'file'			=> 'required|unique:resources,file',
        'unit'			=> 'required'
    );

	// Don't forget to fill this array
	protected $fillable = ['school', 'year', 'unit', 'name', 'type', 'description', 'file', 'user_id', 'private'];

	public function reviews()
    {
        return $this->hasMany('Review');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%")
            ->orWhere('school', 'LIKE', "%$search%");
    }

    public function recalculateRating()
    {
        $reviews = $this->reviews()->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->cache_rating = round($avgRating,1);
        $this->count_rating = $reviews->count();
        $this->save();
    }

}