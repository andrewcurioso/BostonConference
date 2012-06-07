<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Gravatar helper
 *
 */
class GravatarHelper extends AppHelper {

/**
 * Array of helpers needed
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
 * @param array $options Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 */
	public function image( $email, $s = 80, $options = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s={$s}&d=mm";

		$output = $this->Html->image( $url, $options );
		return $output;
	}
}
