<?php

if ( $prefix = Configure::read('BostonConference.routePrefix') )
	$prefix = '/'.$prefix;

Router::connect(
	$prefix.'/',
	array( 'plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'index' )
);
