<?php
App::uses('SponsorshipLevel', 'BostonConference.Model');

/**
 * SponsorshipLevel Test Case
 *
 */
class SponsorshipLevelTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.sponsorship_level', 'app.event', 'app.sponsor');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SponsorshipLevel = ClassRegistry::init('SponsorshipLevel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SponsorshipLevel);

		parent::tearDown();
	}

}
