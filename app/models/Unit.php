<?php

class Unit extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function year()
    {
        return $this->belongsTo('Year');
    }
    public function resources()
    {
        return $this->hasMany('Resource');
    }

}