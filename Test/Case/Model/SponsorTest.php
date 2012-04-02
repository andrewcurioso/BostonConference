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
	public $fixtures = array(
				'plugin.boston_conference.sponsor',
				'plugin.boston_conference.sponsorship_level'
				);

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
			'contact_name' => 'Andrew',
			'contact_email' => 'example@example.com',
			'contact_phone' => '1 (555) 5555',
			'budget' => 0,
			'notes' => '',
			'logo_url' => '/img/example.png',
			'sponsorship_level_id' => 1,
			'approved' => 1
		);

		// Organization too short
		$result = $this->Sponsor->save(array_merge($data,array('organization' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('organization'),array_keys($this->Sponsor->validationErrors));

		// Organizatio too long
		$result = $this->Sponsor->save(array_merge($data,array('organization' => str_pad('ab',129,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('organization'),array_keys($this->Sponsor->validationErrors));

		// Website not a URL
		$result = $this->Sponsor->save(array_merge($data,array('website' => 'abcd')));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Sponsor->validationErrors));

		// Website too long
		$result = $this->Sponsor->save(array_merge($data,array('website' => str_pad($data['website'],129,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Sponsor->validationErrors));

		// Website is null
		$result = $this->Sponsor->save(array_merge($data,array('website' => null)));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Sponsor->validationErrors));

		// Contact name is empty
		$result = $this->Sponsor->save(array_merge($data,array('contact_name' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_name'),array_keys($this->Sponsor->validationErrors));

		// Contact name is too long
		$result = $this->Sponsor->save(array_merge($data,array('contact_name' => str_pad($data['contact_name'],65,'a'))));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_name'),array_keys($this->Sponsor->validationErrors));

		// Contact email is empty
		$result = $this->Sponsor->save(array_merge($data,array('contact_email' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_email'),array_keys($this->Sponsor->validationErrors));

		// Contact email not an email
		$result = $this->Sponsor->save(array_merge($data,array('contact_email' => 'abcd')));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_email'),array_keys($this->Sponsor->validationErrors));

		// Contact email too long
		$result = $this->Sponsor->save(array_merge($data,array('contact_email' => str_pad($data['contact_email'],65,'1',STR_PAD_LEFT))));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_email'),array_keys($this->Sponsor->validationErrors));

		// Contact phone empty
		$result = $this->Sponsor->save(array_merge($data,array('contact_phone' => '' )));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_phone'),array_keys($this->Sponsor->validationErrors));

		// Contact phone too long
		$result = $this->Sponsor->save(array_merge($data,array('contact_phone' => str_pad($data['contact_phone'],17,'1',STR_PAD_LEFT))));
		$this->assertFalse($result);
		$this->assertEquals(array('contact_phone'),array_keys($this->Sponsor->validationErrors));

		// Budget not numeric
		$result = $this->Sponsor->save(array_merge($data,array('budget' => 'abc')));
		$this->assertFalse($result);
		$this->assertEquals(array('budget'),array_keys($this->Sponsor->validationErrors));

		// Sponsorship level not numeric
		$result = $this->Sponsor->save(array_merge($data,array('sponsorship_level_id' => 'abc')));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsorship_level_id'),array_keys($this->Sponsor->validationErrors));

		// Sponsorship level < 0
		$result = $this->Sponsor->save(array_merge($data,array('sponsorship_level_id' => -1)));
		$this->assertFalse($result);
		$this->assertEquals(array('sponsorship_level_id'),array_keys($this->Sponsor->validationErrors));

		// Approved is not a boolean
		$result = $this->Sponsor->save(array_merge($data,array('approved' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('approved'),array_keys($this->Sponsor->validationErrors));


		// Successful save
		$result = $this->Sponsor->save(array_merge($data,array('logo_url' => '')));
		$this->assertInternalType('array',$result);

		$result = $this->Sponsor->save($data);
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
