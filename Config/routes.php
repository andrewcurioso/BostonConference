<?php

// Set up the prefix

($adminPrefix = Configure::read('BostonConference.adminPrefix')) || ($adminPrefix = 'admin');

if ( $prefix = Configure::read('BostonConference.routePrefix') )
	$prefix = '/'.$prefix;

// Event index

Router::connect(
	$prefix.'/',
	array( 'plugin' => 'BostonConference', 'controller' => 'news', 'action' => 'index' )
);

// Logout
Router::connect(
	$prefix.'/logout',
	array( 'plugin' => 'BostonConference', 'controller' => 'boston_conference', 'action' => 'logout' )
);

// Admin routing

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : ''),
	array( 'plugin' => 'BostonConference', 'controller' => 'boston_conference', 'action' => 'index', 'admin' => true )
);

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : '').'/boston_conference/:controller',
	array( 'plugin' => 'BostonConference', 'action' => 'index', 'admin' => true )
);

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : '').'/boston_conference/:controller/:action/*',
	array( 'plugin' => 'BostonConference', 'admin' => true )
);

// Index for plural controllers (more than one per event)

$controllers = 'sponsors|speakers';

Router::connect(
	$prefix.'/:controller',
	array( 'plugin' => 'BostonConference', 'action' => 'index' ),
	array( 'controller' => $controllers )
);

Router::connect(
	$prefix.'/:controller/:action/*',
	array( 'plugin' => 'BostonConference' ),
	array( 'controller' => $controllers )
);

// Singular controllers (one per event)

Router::connect(
	$prefix.'/venue',
	array( 'plugin' => 'BostonConference', 'controller' => 'venues', 'action' => 'index' )
);

Router::connect(
	$prefix.'/schedule',
	array( 'plugin' => 'BostonConference', 'controller' => 'talks', 'action' => 'index' )
);

Router::connect(
	$prefix.'/talks',
	array( 'plugin' => 'BostonConference', 'controller' => 'talks', 'action' => 'listing' )
);
