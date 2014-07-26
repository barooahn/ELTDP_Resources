<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

		// Add your validation rules here
	public static $rules = array(
        'name'			=> 'required|unique:users,name',
        'email'			=> 'required|unique:users,email',
        'password'		=> 'required',
    );

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('name', 'LIKE', "%$search%");
    }

    public function resources()
    {
        return $this->hasMany('Resource');
    }

    public function resource()
    {
        return $this->belongsToMany('Resource')->withTimestamps();;
    }

    public function review()
	{
		return $this->hasMany('Review');
	}

	public static function showLiked($id) 
	{
		$user = User::find($id);
    	return $user->resource;
	}

}
