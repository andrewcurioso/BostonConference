<?php
App::uses('Sponsor', 'BostonConference.Model');

/**
 * Sponsor Test Case
 *
 */
class SponsorTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.sponsor', 'app.sponsorship_level');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sponsor = ClassRegistry::init('Sponsor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sponsor);

		parent::tearDown();
	}

}
