<?php
App::uses('Hotel', 'BostonConference.Model');

/**
 * Hotel Test Case
 *
 */
class HotelTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.hotel', 'plugin.boston_conference.event_hotel');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hotel = ClassRegistry::init('BostonConference.Hotel');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'name' => 'Test Hotel',
			'website' => 'http://www.example.com/',
			'address' => 'abc'
		);

		// Name is empty
		$result = $this->Hotel->save(array_merge($validData, array('name' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Hotel->validationErrors));

		// Name is too long
		$result = $this->Hotel->save(array_merge($validData,array('name' => str_pad('ab',65,'=-'))));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Hotel->validationErrors));

		// Website is too long
		$result = $this->Hotel->save(array_merge($validData,array('website' => str_pad($validData['website'],129,'a'))));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Hotel->validationErrors));

		// Website is not a valid URL
		$result = $this->Hotel->save(array_merge($validData,array('website' => 'bogus')));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Hotel->validationErrors));

		// Website is empty
		$result = $this->Hotel->save(array_merge($validData,array('website' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Hotel->validationErrors));

		// Address
		$result = $this->Hotel->save(array_merge($validData, array('address' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('address'),array_keys($this->Hotel->validationErrors));

		// Valid save
		$result = $this->Hotel->save($validData);
		$this->assertInternalType('array',$result);
	}
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hotel);

		parent::tearDown();
	}

}
