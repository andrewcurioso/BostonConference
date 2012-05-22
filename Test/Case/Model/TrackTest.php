<?php
App::uses('Track', 'BostonConference.Model');

/**
 * Track Test Case
 *
 */
class TrackTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.track', 'app.talk');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Track = ClassRegistry::init('Track');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Track);

		parent::tearDown();
	}

}
