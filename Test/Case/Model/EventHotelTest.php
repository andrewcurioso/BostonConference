<?php
App::uses('EventHotel', 'BostonConference.Model');

/**
 * EventHotel Test Case
 *
 */
class EventHotelTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.event_hotel', 'plugin.boston_conference.event', 'plugin.boston_conference.hotel');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EventHotel = ClassRegistry::init('BostonConference.EventHotel');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EventHotel);

		parent::tearDown();
	}

}
