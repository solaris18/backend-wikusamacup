<?php
require __DIR__.'/../vendor/autoload.php';

$app = new Slim\Slim();

// routes
$app->post('/registration', 'registration');
$app->get('/schedule/','getSchedule');
$app->get('/schedule/:id','getScheduleById');
$app->get('/schedule/:city/:category','getSchedule');


// Post registration team
function registration()
{
    global $app;
    $response = $app->response();
    $response->header('Content-Type', 'application/json');
        $response->header('Access-Control-Allow-Origin', '*');

    try {
        $data = $app->request->post();
        $registration = Registration::create($data);
            $response->write( json_encode( [ 'id' => $registration->id, 'error' => false ] ) );
    } catch (Exception $e) {
            $response->write( json_encode( [ 'error' => true ] ) );
    }
}

// Get Schedule
function getSchedule( $city = '', $category = '' )
{
    global $app;
    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');

    $return = [];
    try {
      $schedule = ( ! empty( $city ) AND ! empty( $category ) ) ? Schedule::where( 'city', '=', $city)->where( 'category', '=', $category)->get() : Schedule::all();
      
      foreach ($schedule as $key => $value) {
        $return[]['id'] = $value->id;
        $return[]['player'] = [ $value->team1(), $value->team2() ];
        $return[]['time'] = [ date("d m y",strtotime($value->datetime_competition)), date("H.i",strtotime($value->datetime_competition)) ];
        $return[]['currentScore'] = [ $value->score_team1, $value->score_team2 ];
        $return[]['updated_at'] = $value->updated_at->toDateTimeString(); ;
      }
      $return['error'] = false;
    } catch (Exception $e) {
      $return['error'] = true;
    }

    $response->write( json_encode( $return ) );
}

function getScheduleById( $id = null )
{
    global $app;

    $schedule = [];
    $return = [];

    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');

    try {
      $schedule = Schedule::find( $id );

      $return['id'] = $schedule->id;
      $return['player'] = [ $schedule->team1(), $schedule->team2() ];
      $return['time'] = [ date("d m y",strtotime($schedule->datetime_competition)), date("H.i",strtotime($schedule->datetime_competition)) ];
      $return['currentScore'] = [ $schedule->score_team1, $schedule->score_team2 ];
      $return['updated_at'] = $schedule->updated_at->toDateTimeString(); ;
      $return['error'] = false;
    } catch (Exception $e) {
      $return['error'] = true;
    }

    $response->write( json_encode( $return ) );
}

$app->run();
