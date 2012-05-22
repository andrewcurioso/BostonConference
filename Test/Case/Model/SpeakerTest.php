<?php
App::uses('Speaker', 'BostonConference.Model');

/**
 * Speaker Test Case
 *
 */
class SpeakerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.speaker', 'app.user', 'app.talk');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Speaker = ClassRegistry::init('Speaker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Speaker);

		parent::tearDown();
	}

}
