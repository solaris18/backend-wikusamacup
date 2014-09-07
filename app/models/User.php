<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

	// Add your validation rules here
	public static $rules = [];

	// Don't forget to fill this array
	protected $fillable = [ 'name', 'email', 'password' ];
}
