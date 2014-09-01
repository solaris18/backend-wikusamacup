<?php
require __DIR__.'/../vendor/autoload.php';

$app = new Slim\Slim();

// routes
$app->post('/registration', 'registration');
$app->get('/schedule/','getSchedule');
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

// Post registration team
function getSchedule( $city = '', $category = '' )
{
    global $app;
    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');

    $return = [];
    $schedule = ( ! empty( $city ) AND ! empty( $category ) ) ? Schedule::where( 'city', '=', $city)->where( 'category', '=', $category)->get() : Schedule::all();
    
    foreach ($schedule as $key => $value) {
      $return[]['player'] = [ $value->team1(), $value->team2() ];
      $return[]['time'] = [ date("d m y",strtotime($value->datetime_competition)), date("H.i",strtotime($value->datetime_competition)) ];
      $return[]['currentScore'] = [ $value->score_team1, $value->score_team2 ];
    }

    $response->write( json_encode( $return ) );
}

$app->run();
