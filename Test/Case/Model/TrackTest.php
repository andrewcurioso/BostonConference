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
	public $fixtures = array('plugin.boston_conference.track', 'plugin.boston_conference.talk');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Track = ClassRegistry::init('BostonConference.Track');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'name' => 'Lorem ipsum dolor sit amet',
			'color' => 'FFF',
			'position' => 1,
		);

		// Invalid name - Empty
		$result = $this->Track->save(array_merge($validData,array('name' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Track->validationErrors));

		// Invalid name - Too long
		$result = $this->Track->save(array_merge($validData,array('name' => str_pad($validData['name'],33,'~'))));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Track->validationErrors));

		// Invalid color
		$result = $this->Track->save(array_merge($validData,array('color' => 'ffff')));
		$this->assertFalse($result);
		$this->assertEquals(array('color'),array_keys($this->Track->validationErrors));

		// Invalid position - Empty
		$result = $this->Track->save(array_merge($validData,array('position' => null)));
		$this->assertFalse($result);
		$this->assertEquals(array('position'),array_keys($this->Track->validationErrors));

		// Invalid position - Non-numeric
		$result = $this->Track->save(array_merge($validData,array('position' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('position'),array_keys($this->Track->validationErrors));

		// Valid save
		$this->Track->create();
		$result = $this->Track->save($validData);
		$this->assertInternalType('array',$result);

		// Valid save - Short color
		$this->Track->create();
		$result = $this->Track->save(array_merge($validData,array('color' => 'fff')));
		$this->assertInternalType('array',$result);

		// Valid save - Long color
		$this->Track->create();
		$result = $this->Track->save(array_merge($validData,array('color' => '000fff')));
		$this->assertInternalType('array',$result);

		// Valid save - No color
		$this->Track->create();
		$result = $this->Track->save(array_merge($validData,array('color' => '')));
		$this->assertInternalType('array',$result);

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
