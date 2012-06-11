<?php
App::uses('Component', 'Controller');

/**
 * MenuComponent
 *
 */
class MenuComponent extends Component {

/**
 * navigationLinks
 *
 * @var array
 */
	protected $_navigationLinks = array();

/**
 * Initializes the component.
 *
 * @param Controller The controller being used
 * @returns void
 */
	public function initialize( Controller $controller ) {
		$this->_initDefaultMenu($controller);
	}

/**
 * Adds a link to the menu.
 *
 * @param string $label The label for the link.
 * @param mixed $link The actual link. Can be a path or link data structure.
 * @returns void
 */
	public function addLink( $label, $link, $importance=100 ) {
		$this->_navigationLinks[md5($label)] = array( $label, $link, $importance );
	}

/**
 *
 * Removes links from the menu.
 *
 * ### Usage
 *
 * `$this->removeLinks( 'Schedule' );`
 * `$this->removeLinks( array( 'Schedule', 'Venue' );`
 *
 * @param mixed $labels The label or array of label names
 * @returns void
 */
	public function removeLinks( $labels ) {

		if( !is_array( $labels ) ) {
			$labels = array( $labels );
		}

		foreach( $labels AS $label ) { // Remove all links
			unset( $this->_navigationLinks[md5($label)] );
		}
	}

/**
 * Called after the controller action is run, but before the view is rendered. You can use this method
 * to perform logic or set view variables that are required on every request.
 * Sets the navigation links for the view.
 *
 * @param Controller $controller The controller using this component
 * @return void
 */
	public function beforeRender( Controller $controller ) {

		usort($this->_navigationLinks,array($this,'_sortCallback'));

		$controller->set('navigation_links',$this->_navigationLinks);

		parent::beforeRender($controller);
	}

/**
 * Sorts the menu items based on importance.
 *
 * @param array $a The first item to compair
 * @param array $b The second item to compair
 * @returns int 0 if $a and $b are equal, -1 if $a < $b and 1 if $a > $b
 */
	protected function _sortCallback($a,$b) {
		if ( $a[2] == $b[2] ) return 0;
		return ( $a[2] < $b[2] ? -1 : 1 );
	}

/**
 * Creates the default navigation links.
 *
 * @param Controller $controller The controller being used.
 * @returns void
 */
	protected function _initDefaultMenu(Controller $controller) {
		$isAdmin = $controller->params['admin'];

		// Home link (0 - most important)
		$this->addLink(
			'Home',
			array(
				'plugin' => 'BostonConference',
				'controller' => ( $isAdmin ? 'boston_conference' : 'news' ),
				'action' => 'index'
			),
			0
		);

		if ( $isAdmin ) {

			// Events admin link (10)
			$this->addLink(
				'Events',
				array(
					'plugin' => 'BostonConference',
					'controller' => 'events',
					'action' => 'index'
				),
				10
			);

			// News admin link (20)
			$this->addLink(
				'News',
				array(
					'plugin' => 'BostonConference',
					'controller' => 'news',
					'action' => 'index'
				),
				20
			);
		}

		// Schedule link (30)
		$this->addLink(
			'Schedule',
			array(
				'plugin' => 'BostonConference',
				'controller' => 'talks',
				'action' => 'schedule'
			),
			30
		);

		// Admin tickets link (40)
		$this->addLink(
			'Tickets',
			array(
				'plugin' => 'BostonConference',
				'controller' => 'tickets',
				'action' => 'index'
			),
			40
		);

		// Sponsors link (50)
		$this->addLink(
			'Sponsors',
			array(
				'plugin' => 'BostonConference',
				'controller' => 'sponsors',
				'action' => 'index'
			),
			50
		);

		// Vanue link (60)
		$this->addLink(
			'Venue'.($isAdmin ? 's' : ''),
			array(
				'plugin' => 'BostonConference',
				'controller' => 'venues',
				'action' => 'index'
			),
			60
		);

		if ( $isAdmin ) {

			// Admin hotels link (70)
			$this->addLink(
				'Hotels',
				array(
					'plugin' => 'BostonConference',
					'controller' => 'hotels',
					'action' => 'index'
				),
				70
			);

		}
	}
}
