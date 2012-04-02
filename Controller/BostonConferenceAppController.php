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
		$this->_createDefaultNavigationLinks();
		parent::beforeFilter();
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

