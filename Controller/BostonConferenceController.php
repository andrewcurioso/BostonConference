<?php

/**
 * BostonConference controller, used for displaying static and home pages.
 *
 * @package BostonConference.Controller
 */
class BostonConferenceController extends BostonConferenceAppController {

/**
 * Name property
 *
 * @var string
 */
	public $name = 'BostonConference';

/**
 * Index method. Displays the conference homepage.
 *
 * @returns void
 */
	public function index() {
	}

/**
 * Index method. Displays the administrator homepage.
 *
 * @returns void
 */
	public function admin_index() {
	}

/**
 * Logout method. Logs out the current user and returns them to the
 * appropriate location.
 *
 * @returns void
 */
	public function logout() {
		if ( property_exists($this,'Auth') )
			$this->redirect($this->Auth->logout());
		else
			$this->redirect(array('index'));
	}

}
