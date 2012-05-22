<?php

class BostonConferenceAppController extends AppController {

/**
 * navigationLinks
 *
 * @var array
 */
	private $navigationLinks = array();

/**
 * Called before the controller action.  You can use this method to configure and customize components
 * or perform logic that needs to happen before each controller action.
 * Does conference initialization.
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->_createDefaultNavigationLinks();
		$this->_populateAuthData();
	}

/**
 * Creates the default navigation links. Can be overriden in individule controllers.
 *
 * @returns void
 */
	protected function _createDefaultNavigationLinks() {
		$isAdmin = $this->params['admin'];

		$this->addNavigationLink('Home',array('plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'index'));

		if ( $isAdmin )
			$this->addNavigationLink('Events',array('plugin' => 'BostonConference', 'controller' => 'events', 'action' => 'index'));

		$this->addNavigationLink('Schedule',array('plugin' => 'BostonConference', 'controller' => 'talks', 'action' => 'index'));

		$this->addNavigationLink('Sponsors',array('plugin' => 'BostonConference', 'controller' => 'sponsors', 'action' => 'index'));

		$this->addNavigationLink('Venue'.($isAdmin ? 's' : ''),array('plugin' => 'BostonConference', 'controller' => 'Venues', 'action' => 'index'));

		if ( $isAdmin )
			$this->addNavigationLink('Hotels',array('plugin' => 'BostonConference', 'controller' => 'hotels', 'action' => 'index'));
	}

/**
 * Populates authentication related values for the view.
 *
 * @returns void
 */
	protected function _populateAuthData() {

		if ( !property_exists($this,'Auth') )
			return;

		$a = array();

		if ( $this->Auth->loggedIn() ) {
			$a['logout_url'] = array( 'plugin' => 'BostonConference', 'controller' => 'BostonConference', 'action' => 'logout' );
			$a['greeting'] = Configure::read('BostonConference.greeting');
		} else {
			$a['login_url'] = $this->Auth->loginAction;
		}


		$this->set('authentication',$a);
	}

/**
 * Adds a link to the top navigation.
 *
 * @param string $label The label for the link.
 * @param mixed $link The actual link. Can be a path or link data structure.
 * @returns void
 */
	public function addNavigationLink( $label, $link ) {
		$this->navigationLinks[] = array( $label, $link );
	}

/**
 * Called after the controller action is run, but before the view is rendered. You can use this method
 * to perform logic or set view variables that are required on every request.
 * Sets the navigation links for the view.
 *
 * @return void
 */
	public function beforeRender() {
		$this->set('navigation_links',$this->navigationLinks);
		return parent::beforeRender();
	}

}

