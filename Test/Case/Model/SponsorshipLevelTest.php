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
	public $fixtures = array(
				'plugin.boston_conference.sponsorship_level',
				'plugin.boston_conference.event',
				'plugin.boston_conference.sponsor',
				);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SponsorshipLevel = ClassRegistry::init('BostonConference.SponsorshipLevel');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$data = array(
			'label' => 'Test Sponsorship Level',
			'event_id' => 1,
			'position' => 0,
			'sponsor_count' => 0
		);

		$result = $this->SponsorshipLevel->save(array_merge($data,array('label' => 'ab')));
		$this->assertFalse($result);
		$this->assertEquals(array('label'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('label' => str_pad('ab',33,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('label'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('event_id' => 'abc')));
		$this->assertFalse($result);
		$this->assertEquals(array('event_id'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('event_id' => 0)));
		$this->assertFalse($result);
		$this->assertEquals(array('event_id'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('position' => -2)));
		$this->assertFalse($result);
		$this->assertEquals(array('position'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('position' => 128)));
		$this->assertFalse($result);
		$this->assertEquals(array('position'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('sponsor_count' => 'abc')));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsor_count'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('sponsor_count' => -1)));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsor_count'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save($data);
		$this->assertInternalType('array',$result);
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
