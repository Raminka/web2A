<?php

/**
 * Application d'exemple Agence de voyages Silex
 */

// require_once __DIR__.'/vendor/autoload.php';
$vendor_directory = getenv ( 'COMPOSER_VENDOR_DIR' );
if ($vendor_directory === false) {
	$vendor_directory = __DIR__ . '/vendor';
}
require_once $vendor_directory . '/autoload.php';

// Initialisations
$app = require_once 'initapp.php';

require_once 'agvoymodel.php';

// Routage et actions

// circuitlist : Liste tous les circuits
$app->get ( '/circuit', 
    function () use ($app) 
    {
    	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);
    	
    	return $app ['twig']->render ( 'circuitslist.html.twig', [
    			'circuitslist' => $circuitslist

    	] );
    }
)->bind ( 'circuitlist' );


//home
$app->get ('/',
	function () use ($app)
	{
	
	return $app ['twig']->render ( 'index.html.twig' );

}
)->bind ( 'index' );

// circuitshow : affiche les détails d'un circuit
$app->get ( '/circuit/{id}', 
	function ($id) use ($app) 
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'circuitshow.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'circuitshow' );

// programmationlist : liste tous les circuits programmés
$app->get ( '/programmation', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'programmationslist.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'programmationlist' );


// home_action
$app->get ( '/circuit', function () use ($app) {
	$todoslist = get_all_todos ();
	// print_r($todoslist);
	
	return $app ['twig']->render ( 'listtodos.html.twig', [ 
			'todoslist' => $todoslist 
	] );
} )->bind ( 'home' );



//Back Office

//admin_home
$app->get ('/admin/home',
	function () use ($app)
	{

	return $app ['twig']->render ( 'admin_home.html.twig' );
}
)->bind ( 'admin_home' );


// circuitBO
$app->get ( '/circuitBO', function () use ($app) {
	$circuitslist = get_all_circuits ();
    	// print_r($circuitslist);
	return $app ['twig']->render ( 'circuitslistBO.html.twig', [
    			'circuitslist' => $circuitslist

    	] );
    }
)->bind ( 'circuitBO' );


// programmationlist : liste tous les circuits programmés
$app->get ( '/programmationBO', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'programmationslistBO.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'programmationBO' );

    	
// circuitshowBO
$app->get ( '/circuitBO/{id}', 
	function ($id) use ($app) 
	{
		$circuit = get_circuit_by_id ( $id );
		// print_r($circuit);
		$programmations = get_programmations_by_circuit_id ( $id );
		//$circuit ['programmations'] = $programmations;

		return $app ['twig']->render ( 'circuitshowBO.html.twig', [ 
				'id' => $id,
				'circuit' => $circuit 
			] );
	}
)->bind ( 'circuitshowBO' );

// new account: sign up
$app->get ( '/signup', 
	function () use ($app) 
	{

		return $app ['twig']->render ( 'signup.html.twig' );
	}
)->bind ( 'signup' );

// contact
$app->get ( '/contact', 
	function () use ($app) 
	{

		return $app ['twig']->render ( 'contact.html.twig' );
	}
)->bind ( 'contact' );

// news: les promotions
$app->get ( '/news', 
	function () use ($app) 
	{
		$programmationslist = get_all_programmations ();
		// print_r($programmationslist);

		return $app ['twig']->render ( 'news.html.twig', [ 
				'programmationslist' => $programmationslist 
			] );
	}
)->bind ( 'news' );

$app->run ();







