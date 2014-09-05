<?php
require __DIR__.'/../vendor/autoload.php';

use Mailgun\Mailgun;
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

      # Include the Autoloader (see "Libraries" for install instructions)

      # Instantiate the client.
      $mgClient = new Mailgun('key-93ff6cb32c74d74e5ae33267adb7758b');
      $domain = "sandbox0a8d2b3620114db389abe6833a0c5c96.mailgun.org";

      # Make the call to the client.
      $result = $mgClient->sendMessage("$domain",
        array('from'    => 'Wikusama Cup <postmaster@wikusamacup.com>',
              'to'      => 'Dwi Ma\'ruf Alvansuri <dwimarufalvansuri@gmail.com>',
              'bcc'      => 'Agung Hari Wijaya <a9un9_ch@yahoo.co.id>',
              'subject' => '[Wikusama Cup] New Team Register',
              'html'    => '
                <html>
                  <body>
                    <p>Hi , Dwi Ma\'ruf Alvansuri</p>
                    <p>just notification '.$app->request->post('team_name').' team success register with this detail : </p>
                    <p>
                      <strong>Team Name </strong> : '.$app->request->post('team_name').'<br>
                      <strong>Generation </strong> : '.$app->request->post('generation').'<br>
                      <strong>PIC Name </strong> : '.$app->request->post('pic').'<br>
                      <strong>Phone Number </strong> : '.$app->request->post('phone').'<br>
                      <strong>Email </strong> : '.$app->request->post('email').'<br>
                      <strong>Sosial Media </strong> : '.$app->request->post('sosmed').'<br>
                    </p>
                  </body>
                </html>
              ')
        );
    

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
        $return[$key]['id'] = $value->id;
        $return[$key]['player'] = [ $value->team1(), $value->team2() ];
        $return[$key]['time'] = [ date("d m y",strtotime($value->datetime_competition)), date("H.i",strtotime($value->datetime_competition)) ];
        $return[$key]['currentScore'] = [ $value->score_team1, $value->score_team2 ];
        $return[$key]['updated_at'] = $value->updated_at->toDateTimeString(); ;
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
