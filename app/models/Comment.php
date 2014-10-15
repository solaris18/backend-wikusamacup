<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {

  // Add your validation rules here
  public static $rules = [
    'name' 	=> 'required',
    'generation' 	=> 'required',
    'comment' => 'required'
  ];
  public static $messages = array(
    'required' => 'Your :attribute is required.'
  );

  // Don't forget to fill this array
  protected $fillable = [ 'name', 'generation', 'comment' ];
}
