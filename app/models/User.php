<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required',
		'email' => 'required|email',
		'password' => 'required'
	];
	public static $messages = array(
		'required' => 'Your :attribute is required.',
		'min'      => 'Your :attribute must be at least :min characters long.',
		'max'      => 'Your :attribute must be a maximum of :max characters long.',
		'between'  => 'Your :attribute must be between :min - :max characters long.',
		'email'    => 'Your :attribute must be a valid email address'
	);

	// Don't forget to fill this array
	protected $fillable = [ 'name', 'email', 'password' ];
}
