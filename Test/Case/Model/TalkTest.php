<?php
App::uses('Talk', 'BostonConference.Model');

/**
 * Talk Test Case
 *
 */
class TalkTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.talk', 'app.event', 'app.speaker', 'app.track');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Talk = ClassRegistry::init('Talk');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Talk);

		parent::tearDown();
	}

}
