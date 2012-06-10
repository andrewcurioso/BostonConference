<?php
App::uses('TicketOption', 'BostonConference.Model');

/**
 * TicketOption Test Case
 *
 */
class TicketOptionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.ticket_option', 'app.event', 'app.ticket');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TicketOption = ClassRegistry::init('TicketOption');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TicketOption);

		parent::tearDown();
	}

}
