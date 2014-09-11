<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Registration extends Eloquent {

	// Add your validation rules here
	public static $rules = [];

	// Don't forget to fill this array
	protected $fillable = [ 'team_name', 'generation', 'pic', 'phone', 'email', 'sosmed', 'region' ];
}
