<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Registration extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		'team_name' => 'required',
		'generation' => 'required',
		'pic' => 'required',
		'phone' => 'required',
		'email' => 'required|email',
		'sosmed' => 'required',
		'region' => 'required'
	];
	public static $messages = array(
		'required' => 'Your :attribute is required.',
		'min'      => 'Your :attribute must be at least :min characters long.',
		'max'      => 'Your :attribute must be a maximum of :max characters long.',
		'between'  => 'Your :attribute must be between :min - :max characters long.',
		'email'    => 'Your :attribute must be a valid email address'
	);

	// Don't forget to fill this array
	protected $fillable = [ 'team_name', 'generation', 'pic', 'phone', 'email', 'sosmed', 'region' ];
}
