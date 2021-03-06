<?php
require __DIR__.'/../vendor/autoload.php';

use \Slim\Middleware\SessionCookie;
use Mailgun\Mailgun;
use Illuminate\Database\Capsule\Manager as Capsule;

$app = new Slim\Slim( [
  'templates.path' => '../app/views/',
  'view' => '\Slim\LayoutView',
  'layout' => 'layouts/admin.php'
] );

$app->hook('slim.before', function () use ($app) {
    $app->view()->appendData(array('baseUrl' => 'http://'.$_SERVER['HTTP_HOST'] ));
});

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '20 minutes',
    'path' => '/',
    'domain' => null,
    'secure' => false,
    'httponly' => false,
    'name' => 'slim_session',
    'secret' => 'CHANGE_ME',
    'cipher' => MCRYPT_RIJNDAEL_256,
    'cipher_mode' => MCRYPT_MODE_CBC
)));

// routes
$app->post('/registration', 'registration');
$app->get('/schedule','getSchedule');
$app->get('/schedule/:id','getScheduleById');
$app->get('/schedule/:city/:category','getSchedule');
$app->get('/schedule/:city/:category/live','getScheduleLive');

$app->get('/login','getLogin');
$app->post('/login','postLogin');
$app->get('/logout','getLogout');
$app->get('/dashboard','getDashboard');
$app->get('/admin/schedule', 'getAdminSchedule');
$app->get('/admin/schedule/add', 'getAdminScheduleCreate');
$app->post('/admin/schedule', 'postAdminSchedule');
$app->put('/admin/schedule/:id', 'putAdminSchedule');
$app->get('/admin/schedule/livescore/:id', 'getAdminScheduleLive');
$app->get('/admin/schedule/edit/:id', 'getAdminScheduleEdit');
$app->delete('/admin/schedule/delete/:id', 'deleteAdminSchedule');

$app->get('/comment','getComment');
$app->get('/admin/comment','getAdminComment');
$app->get( '/admin/comment/add', 'getAdminCommentCreate');
$app->post( '/admin/comment', 'postAdminComment');
$app->delete('/admin/comment/delete/:id', 'deleteAdminComment');

// Post registration team
function registration()
{
    global $app;
    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');
    $responseData = '';

    try {

      $validator = Validator::make($data = $app->request->post(), Registration::$rules, Registration::$messages);
      if ( $validator->fails() )
      {
        $error = '';
        foreach ($validator->errors()->all() as $key => $value) {
          $error .= '<p class="bg-danger text-danger">'.$value.'</p>';
        }
        $responseData = json_encode( [ 'error' => true ] );
      }else{

        $registration = Registration::create($data);

        # Instantiate the client.
        $mgClient = new Mailgun('key');
        $domain = "domain";

        $toMalang = 'Yanuar Ardi S  <yanuardi04@gmail.com>';
        $tojakarta = 'Dwi Ma\'ruf Alvansuri <dwimarufalvansuri@gmail.com>';

        $to = ( 'malang' == $app->request->post('region') ) ? $toMalang : $tojakarta;

        # Make the call to the client.
        $toAdmin = $mgClient->sendMessage("$domain",
          array('from'    => $app->request->post('pic').' <'.$app->request->post('email').'>',
                'to'      => $to,
                'bcc'      => 'Agung Hari Wijaya <a9un9_ch@yahoo.co.id>',
                'subject' => '[Wikusama Cup] New Team Register',
                'html'    => '
                  <html>
                    <body>
                      <p>Hi , Dwi Ma\'ruf Alvansuri</p>
                      <p>just notification '.$app->request->post('team_name').' team success register with this detail : </p>
                      <p>
                        <strong>Team Name </strong> : '.$app->request->post('team_name').'<br>
                        <strong>Regional </strong> : '.$app->request->post('region').'<br>
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

        $malang = '
                      <p>
                        <strong>Biaya</strong> : Rp 400.000 (empat ratus ribu rupiah)<br>
                      </p>
                      <p>Biaya pendaftaran dapat di transfer ke :</p>
                      <p>
                        <strong>BCA</strong> : 140 664 1571 a/n Rezha Rosella <br>
                        <strong>BNI</strong> : 288 496 532 a/n Rezha Rosella <br>
                        <strong>Mandiri</strong> : 141 001 038 1572 a/n Bakti Ariani Melinda
                      </p>
                      <br>
                      <p>CP bisa menghubungi</p>
                      <p>
                        <strong>Yanuar Ardi S</strong> : +62 819 457 95 782 / yanuardi04@gmail.com <br>
                        <strong>Wagis Pratama</strong> : +62 852 344 677 29 / wagispratama@gmail.com
                      </p>
                      <br>';
        $jakarta = '
                      <p>
                        <strong>Biaya</strong> : Rp 700.000 (tujuh ratus ribu rupiah) - sudah meliputi 3 ajang lomba<br>
                      </p>
                      <p>Biaya pendaftaran dapat di transfer ke :</p>
                      <p>
                        <strong>BCA</strong> : 145 136 3404 a/n Dwi Ma\'ruf Alvansuri <br>
                        <strong>Mandiri</strong> : 144 001 359 1224 a/n Dwi Ma\'ruf Alvansuri
                      </p>
                      <br>
                      <p>Stelah melakukan pembayaran mohon konfirmasi pembayaran ke nomor +62857-55-33-89-88 (Dwi Ma\'ruf Alvansuri)</p>
                      <br>';

        $biaya = ( 'malang' == $app->request->post('region') ) ? $malang : $jakarta;

        $toPic = $mgClient->sendMessage("$domain",
          array('to'    => $app->request->post('pic').' <'.$app->request->post('email').'>',
                'from'      => $to,
                'bcc'      => 'Agung Hari Wijaya <a9un9_ch@yahoo.co.id>',
                'subject' => '[Registrasi Wikusama Cup 2014] New Team Register Confirmation',
                'html'    => '
                  <html>
                    <body>
                      <p>Halo , '.$app->request->post('pic').'</p>
                      <p>Terimakasih atas keikutsertaan dalam Wikusamacup 2014</p>
                      <p>Berikut data tim anda yang telah kami terima: </p>
                      <p>
                        <strong>Nama Tim </strong> : '.$app->request->post('team_name').'<br>
                        <strong>Regional </strong> : '.$app->request->post('region').'<br>
                        <strong>Angkatan </strong> : '.$app->request->post('generation').'<br>
                        <strong>Nama CP </strong> : '.$app->request->post('pic').'<br>
                        <strong>Nomor CP </strong> : '.$app->request->post('phone').'<br>
                        <strong>Email CP </strong> : '.$app->request->post('email').'<br>
                        <strong>Sosial Media </strong> : '.$app->request->post('sosmed').'<br>
                      </p>
                      <br>
                      <p>Untuk pendaftaran harap transfer</p>'.$biaya.'
                      <br>
                      <br>
                      <br>
                      <strong>Panitia Wikusama Cup 2014</strong>
                    </body>
                  </html>
                ')
          );

        $responseData = json_encode( [ 'id' => $registration->id, 'error' => false ] ) ;
      }

    } catch (Exception $e) {
      $responseData =  json_encode( [ 'error' => true ] );
    }
    $response->write( $responseData );
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
        $return[$key]['player'] = [ $value->team1_id, $value->team2_id ];
        $return[$key]['time'] = [ date("d m y",strtotime($value->datetime_competition)), date("H.i",strtotime($value->datetime_competition)) ];
        $return[$key]['currentScore'] = [ $value->score_team1, $value->score_team2 ];
        $return[$key]['updated_at'] = $value->updated_at->toDateTimeString();
        $return[$key]['live'] = $value->live;
      }
      $return['error'] = false;
    } catch (Exception $e) {
      $return['error'] = true;
    }

    $response->write( json_encode( $return ) );
}

// Get Schedule
function getScheduleLive( $city = '', $category = '' )
{
    global $app;
    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');

    $return = [];
    try {

      $schedule = Schedule::where( 'city', '=', $city)->where( 'category', '=', $category)->where( 'live', '=', 1 )->first();
      $schedule = ( ! empty( $schedule ) ) ? $schedule : Schedule::where( 'city', '=', $city)->where( 'category', '=', $category)->where( 'datetime_competition', '>', date('Y-m-d H:i:s') )->orderBy( 'datetime_competition', 'asc' )->first();

      if( ! empty( $schedule ) ) {
        $return['id'] = $schedule->id;
        $return['player'] = [ $schedule->team1_id, $schedule->team2_id ];
        $return['time'] = [ date("d F Y",strtotime($schedule->datetime_competition)), date("H.i",strtotime($schedule->datetime_competition)) ];
        $return['currentScore'] = [ $schedule->score_team1, $schedule->score_team2 ];
        $return['updated_at'] = $schedule->updated_at->toDateTimeString();
        $return['live'] = $schedule->live;
        $return['error'] = false;
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
      $return['player'] = [ $schedule->team1_id, $schedule->team2_id ];
      $return['time'] = [ date("d m y",strtotime($schedule->datetime_competition)), date("H.i",strtotime($schedule->datetime_competition)) ];
      $return['currentScore'] = [ $schedule->score_team1, $schedule->score_team2 ];
      $return['updated_at'] = $schedule->updated_at->toDateTimeString();
      $return['live'] = $schedule->live;
      $return['error'] = false;
    } catch (Exception $e) {
      $return['error'] = true;
    }

    $response->write( json_encode( $return ) );
}

function getLogin()
{
  global $app;

  if( ! empty($_SESSION['user']['email']) )
    $app->redirect('/dashboard');

  $app->render('user/login.php', [ 'layout' => false ] );
}

function postLogin()
{
  global $app;
  $email = $app->request->post('email');
  $password = $app->request->post('password');

  if ( ! empty( $email ) AND ! empty( $password ) )
  {
    $user = User::where( 'email', '=', $email )->where( 'password', '=', sha1( $password ) )->first();

    if ( ! empty($user) ) {
      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['name'] = $user->name;
      $_SESSION['user']['id'] = $user->id;
      $app->flash('messages', 'Selamat datang '.$user->name);
      $app->redirect('/dashboard');
    }
    else
    {
      $app->flash('messages', '<p class="bg-danger text-danger">Email atau password salah!</p>');
    }
  }
  else
  {
    $app->flash('messages', '<p class="bg-danger text-danger">silahkan isi email dan password</p>');
  }
  $app->redirect('/login');
}

function getDashboard()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['teams'] = Registration::where( 'email', '!=' ,'' )->get();
  $data['title'] = 'Team Registration Data';
  $data['homeActive'] = 'active';

  $app->render( 'admin/dashboard.php', $data );
}

function getAdminSchedule()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['schedules'] = Schedule::all();
  $data['title'] = 'Schedule & Scoring';
  $data['scheduleActive'] = 'active';

  $app->render( 'schedule/view.php', $data );
}

function getAdminScheduleCreate()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['title'] = 'Add New Schedule';
  $data['scheduleActive'] = 'active';
  $data['teams'] = Registration::where( 'email', '!=' ,'' )->get();

  $app->render( 'schedule/create.php', $data );
}

function postAdminSchedule()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  try{

    $validator = Validator::make($data = $app->request->post(), Schedule::$rules, Schedule::$messages);
    if ($validator->fails() )
    {
      $error = '';
      foreach ($validator->errors()->all() as $key => $value) {
        $error .= '<p class="bg-danger text-danger">'.$value.'</p>';
      }
      $app->flash('messages', $error);
    }else{
      $schedule = Schedule::create($data);
      $app->flash('messages', '<p class="bg-success text-success">Schedule success create</p>');
    }

  } catch (Exception $e) {
    $app->flash('messages', '<p class="bg-danger text-danger">Something problem, please try again</p>');
  }


  $app->redirect('/admin/schedule');
}

function putAdminSchedule( $id )
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  try{
    $live = $app->request->post('islive');

    $schedule = Schedule::findOrFail($id);
    $data = $app->request->post();

    $schedule->update($data);

    if( 'true' == $live ){
      $messages = 'Score success updated';
      $redirect = '/admin/schedule/livescore/'.$id;
    }else{
      $messages = 'Schedule success updated';
      $redirect = '/admin/schedule';
    }

    $app->flash('messages', '<p class="bg-success text-success">'.$messages.'</p>');
  } catch (Exception $e) {
    $app->flash('messages', '<p class="bg-danger text-danger">Something problem, please try again</p>');
  }


  $app->redirect( $redirect );
}

function getAdminScheduleLive( $id = 0 )
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['schedule'] = Schedule::find($id);
  $data['title'] = 'Update Live Score';
  $data['scheduleActive'] = 'active';

  $app->render( 'schedule/live.php', $data );
}

function getAdminScheduleEdit( $id = 0 )
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['schedule'] = Schedule::find($id);
  $data['title'] = 'Update Schedule & Score';
  $data['scheduleActive'] = 'active';
  $data['teams'] = Registration::where( 'email', '!=' ,'' )->get();

  $app->render( 'schedule/update.php', $data );
}

function deleteAdminSchedule( $id = 0 )
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  try{
		Schedule::destroy($id);
    $app->flash('messages', '<p class="bg-success text-success">Schedule successfull deleted.</p>');
  } catch (Exception $e) {
    $app->flash('messages', '<p class="bg-danger text-danger">Something problem, please try again</p>');
  }

  $app->redirect( '/admin/schedule' );
}

function getLogout()
{
  global $app;

  $_SESSION['user']['email'] = null;
  $_SESSION['user']['name'] = null;
  $_SESSION['user']['id'] = null;
  session_destroy();

  $app->flash('messages', '<p class="bg-success text-success">Anda telah keluar dari aplikasi</p>');

  $app->redirect('/login');
}



function getAdminComment()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['data'] = Comment::all();
  $data['title'] = 'Guest Book';
  $data['commentActive'] = 'active';

  $app->render( 'comment/view.php', $data );
}

function getAdminCommentCreate()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  $data['title'] = 'Add New Comment';
  $data['commentActive'] = 'active';
  $data[ 'layout' ] = 'layouts/comment.php';

  $app->render( 'comment/create.php', $data );
}

function postAdminComment()
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  try{

    $validator = Validator::make($data = $app->request->post(), Comment::$rules, Comment::$messages);
    if ($validator->fails() )
    {
      $error = '';
      foreach ($validator->errors()->all() as $key => $value) {
        $error .= '<p class="bg-danger text-danger">'.$value.'</p>';
      }
      $app->flash('messages', $error);
    }else{
      $schedule = Comment::create($data);
      $app->flash('messages', '<p class="bg-success text-success text-left" style="padding: 5px 10px;border-radius: 3px;">Your comment success send ^_^</p>');
    }

  } catch (Exception $e) {
    $app->flash('messages', '<p class="bg-danger text-danger">Something problem, please try again</p>');
  }


  $app->redirect('/admin/comment/add');
}

function deleteAdminComment( $id = 0 )
{
  global $app;

  if( empty($_SESSION['user']['email']) )
    $app->redirect('/login');

  try{
    Comment::destroy($id);
    $app->flash('messages', '<p class="bg-success text-success">Comment successfull deleted.</p>');
  } catch (Exception $e) {
    $app->flash('messages', '<p class="bg-danger text-danger">Something problem, please try again</p>');
  }

  $app->redirect( '/admin/comment' );
}

// Get Schedule
function getComment()
{
    global $app;

    $response = $app->response();
    $response->header('Content-Type', 'application/json');
    $response->header('Access-Control-Allow-Origin', '*');

    // $return = [];
    try {
      $return['data'] = Comment::orderBy( Capsule::raw('RAND()') )->take(20)->get();
      $return['error'] = false;
    } catch (Exception $e) {
      print_r($e);
      $return['error'] = true;
    }

    $response->write( json_encode( $return ) );
}

$app->run();
