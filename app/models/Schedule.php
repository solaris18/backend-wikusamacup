<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Schedule extends Eloquent {

	// Add your validation rules here
	public static $rules = [
		'team1_id' 	=> 'required',
		'team2_id' 	=> 'required',
		'datetime_competition' => 'required',
		'city' 			=> 'required',
		'category' 	=> 'required'
	];
 	public static $messages = array(
      'required' => 'Your :attribute is required.',
      'min'      => 'Your :attribute must be at least :min characters long.',
      'max'      => 'Your :attribute must be a maximum of :max characters long.',
      'between'  => 'Your :attribute must be between :min - :max characters long.',
      'email'    => 'Your :attribute must be a valid email address'
  );

	// Don't forget to fill this array
	protected $fillable = [ 'team1_id', 'team2_id', 'datetime_competition', 'score_team1', 'score_team2', 'city', 'category', 'live' ];

  public function team1()
  {
  	$registration = Registration::find($this->team1_id);

    return $registration->team_name;
  }
  public function team2()
  {
  	$registration = Registration::find($this->team2_id);

    return $registration->team_name;
  }
}
