<?php

class Year extends \Eloquent {
	protected $fillable = [];

	public function school()
    {
        return $this->belongsTo('School');
    }
    public function units()
    {
        return $this->hasMany('Unit');
    }
}