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
	protected $fillable = ['school', 'year', 'unit', 'name', 'type', 'description', 'file', 'user_id'];

	public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}