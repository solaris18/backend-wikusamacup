<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Schedule extends Eloquent {

	// Add your validation rules here
	public static $rules = [];

	// Don't forget to fill this array
	protected $fillable = [ 'team1_id', 'team2_id', 'datetime_competition', 'score_team1', 'score_team2', 'city', 'category' ];

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
