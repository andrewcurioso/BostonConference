<?php
App::uses('Venue', 'BostonConference.Model');

/**
 * Venue Test Case
 *
 */
class VenueTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.venue', 'plugin.boston_conference.event');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Venue = ClassRegistry::init('BostonConference.Venue');
	}
/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'name' => 'Test Venue',
			'website' => 'http://www.example.com/',
			'transportation_instructions' => '',
			'address' => ''
		);

		// Name is too short
		$result = $this->Venue->save(array_merge($validData, array('name' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Venue->validationErrors));

		// Name is too long
		$result = $this->Venue->save(array_merge($validData,array('name' => str_pad('ab',129,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Venue->validationErrors));

		// Website is too long
		$result = $this->Venue->save(array_merge($validData,array('website' => str_pad($validData['website'],129,'a'))));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Venue->validationErrors));

		// Website is not a valid URL
		$result = $this->Venue->save(array_merge($validData,array('website' => 'bogus')));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Venue->validationErrors));

		// Valid save - website is empty
		$result = $this->Venue->save(array_merge($validData,array('website' => '')));
		$this->assertInternalType('array',$result);

		// Valid save
		$result = $this->Venue->save($validData);
		$this->assertInternalType('array',$result);
	}
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Venue);

		parent::tearDown();
	}

}
