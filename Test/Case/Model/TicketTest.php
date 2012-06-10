<?php
App::uses('Ticket', 'BostonConference.Model');

/**
 * Ticket Test Case
 *
 */
class TicketTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.ticket', 'app.user', 'app.ticket_option');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ticket = ClassRegistry::init('Ticket');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ticket);

		parent::tearDown();
	}

}
