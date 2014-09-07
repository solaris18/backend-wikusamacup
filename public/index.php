<?php
require __DIR__.'/../vendor/autoload.php';

use Mailgun\Mailgun;
$app = new Slim\Slim( [
  'templates.path' => '../app/views/'
] );


// routes
$app->post('/registration', 'registration');
$app->get('/schedule','getSchedule');
$app->get('/schedule/:id','getScheduleById');
$app->get('/schedule/:city/:category','getSchedule');

$app->get('/login','getLogin');
$app->post('/login','postLogin');

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
      $mgClient = new Mailgun('key');
      $domain = "domain";

      # Make the call to the client.
      $toAdmin = $mgClient->sendMessage("$domain",
        array('from'    => $app->request->post('pic').' <'.$app->request->post('email').'>',
              // 'to'      => 'Dwi Ma\'ruf Alvansuri <dwimarufalvansuri@gmail.com>',
              'to'      => 'Agung Hari Wijaya <a9un9_ch@yahoo.co.id>',
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

      $toPic = $mgClient->sendMessage("$domain",
        array('to'    => $app->request->post('pic').' <'.$app->request->post('email').'>',
              'from'      => 'Dwi Ma\'ruf Alvansuri <dwimarufalvansuri@gmail.com>',
              'bcc'      => 'Agung Hari Wijaya <a9un9_ch@yahoo.co.id>',
              'subject' => '[Wikusama Cup] New Team Register',
              'html'    => '
                <html>
                  <body>
                    <p>Halo , '.$app->request->post('pic').'</p>
                    <p>Terimakasih atas keikutsertaan dalam Wikusamacup 2014</p>
                    <p>Berikut data tim anda yang telah kami terima: </p>
                    <p>
                      <strong>Nama Tim </strong> : '.$app->request->post('team_name').'<br>
                      <strong>Angkatan </strong> : '.$app->request->post('generation').'<br>
                      <strong>Nama CP </strong> : '.$app->request->post('pic').'<br>
                      <strong>Nomor CP </strong> : '.$app->request->post('phone').'<br>
                      <strong>Email CP </strong> : '.$app->request->post('email').'<br>
                      <strong>Sosial Media </strong> : '.$app->request->post('sosmed').'<br>
                    </p>
                    <br>
                    <p>Untuk pendaftaran harap transfer</p>
                    <p>
                      <strong>Biaya</strong> : Rp 700.000 (tujuh ratus ribu rupiah) - sudah meliputi 3 ajang lomba<br>
                    </p>
                    <br>
                    <p>Biaya pendaftaran dapat di transfer ke :</p>
                    <p>
                      <strong>BCA</strong> : 145 136 3404 a/n Dwi Ma\'ruf Alvansuri <br>
                      <strong>Mandiri</strong> : 144 001 359 1224 a/n Dwi Ma\'ruf Alvansuri
                    </p>
                    <br>
                    <p>Stelah melakukan pembayaran mohon konfirmasi pembayaran ke nomor +62857-55-33-89-88</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <strong>Panitia Wikusama Cup 2014</strong>
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

function getLogin()
{
  global $app;

  $app->render('user/login.php');
}

function postLogin()
{
  global $app;
  $email = $app->request->post('email');
  $password = $app->request->post('password');

  if ( ! empty( $email ) AND ! empty( $password ) )
  {
    $user = User::where( 'email', '=', $email )->where( 'password', '=', sha1( $password ) )->first();
    
    if ($user->count() > 0) {
      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['name'] = $user->name;
      $_SESSION['user']['id'] = $user->id;
      $app->flash('success', 'Selamat datang '.$user->name);
      $app->redirect('/dashboard');
    }
    else
    {
      $app->flash('error', 'Email atau password salah!');
    }
  }
  else
  {
    $app->flash('error', 'silahkan isi email dan password');
  }
  $app->redirect('/login');
}

$app->run();
