<?php


($adminPrefix = Configure::read('BostonConference.adminPrefix')) || ($adminPrefix = 'admin');

if ( $prefix = Configure::read('BostonConference.routePrefix') )
	$prefix = '/'.$prefix;

Router::connect(
	$prefix.'/',
	array( 'plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'index' )
);

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : ''),
	array( 'plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'index', 'admin' => true )
);

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : '').'/boston_conference/:controller',
	array( 'plugin' => 'BostonConference', 'action' => 'index', 'admin' => true )
);

Router::connect(
	'/'.$adminPrefix.('/'.$prefix ? $prefix : '').'/boston_conference/:controller/:action/*',
	array( 'plugin' => 'BostonConference', 'admin' => true )
);



