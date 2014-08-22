<?php
require __DIR__.'/../vendor/autoload.php';

$app = new Slim\Slim();

// routes
$app->post('/registration', 'registration');


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

$app->run();
