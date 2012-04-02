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
		$this->Sponsor = ClassRegistry::init('BostonConference.Sponsor');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$data = array(
			'organization' => 'Acme Inc.',
			'website' => 'http://www.example.com/',
			'logo_url' => '/img/example.png',
			'sponsorship_level_id' => 1
		);

		$result = $this->SponsorshipLevel->save(array_merge($data,array('organization' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('organization'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('organization' => str_pad('ab',129,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('organization'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('website' => 'abcd')));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('website' => str_pad($data['website'],129,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('website' => NULL)));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('sponsorship_level_id' => 'abc')));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsorship_level_id'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('sponsorship_level_id' => 0)));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsorship_level_id'),array_keys($this->SponsorshipLevel->validationErrors));

		$result = $this->SponsorshipLevel->save(array_merge($data,array('logo_url' => '')));
		$this->assertInternalType('array',$result);

		$result = $this->SponsorshipLevel->save($data);
		$this->assertInternalType('array',$result);
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
