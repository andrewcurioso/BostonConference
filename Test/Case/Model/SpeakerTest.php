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
	public $fixtures = array('plugin.boston_conference.speaker', 'app.user', 'plugin.boston_conference.talk');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Speaker = ClassRegistry::init('BostonConference.Speaker');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'user_id' => 0,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'bio' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'website' => '',
			'featured' => 1,
			'portrait_url' => ''
		);

		
		// First name - Empty
		$result = $this->Speaker->save(array_merge($validData,array('first_name' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('first_name'),array_keys($this->Speaker->validationErrors));

		// First name - Too long
		$result = $this->Speaker->save(array_merge($validData,array('first_name' => str_pad($validData['first_name'],33,'~'))));
		$this->assertFalse($result);
		$this->assertEquals(array('first_name'),array_keys($this->Speaker->validationErrors));

		// Last name - Empty
		$result = $this->Speaker->save(array_merge($validData,array('last_name' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('last_name'),array_keys($this->Speaker->validationErrors));

		// Last name - Too long
		$result = $this->Speaker->save(array_merge($validData,array('last_name' => str_pad($validData['last_name'],33,'~'))));
		$this->assertFalse($result);
		$this->assertEquals(array('last_name'),array_keys($this->Speaker->validationErrors));

		// Website - Not a URL
		$result = $this->Speaker->save(array_merge($validData,array('website' => 'bogus' )));
		$this->assertFalse($result);
		$this->assertEquals(array('website'),array_keys($this->Speaker->validationErrors));

		// Portrait - Not a URL
		$result = $this->Speaker->save(array_merge($validData,array('portrait_url' => 'bogus' )));
		$this->assertFalse($result);
		$this->assertEquals(array('portrait_url'),array_keys($this->Speaker->validationErrors));

		// Featured - not a boolean
		$result = $this->Speaker->save(array_merge($validData,array('featured' => '2' )));
		$this->assertFalse($result);
		$this->assertEquals(array('featured'),array_keys($this->Speaker->validationErrors));

		// Valid save
		$this->Speaker->create();
		$result = $this->Speaker->save($validData);
		$this->assertInternalType('array',$result);

		// Valid save - Website
		$this->Speaker->create();
		$result = $this->Speaker->save(array_merge($validData,array('website' => 'http://www.example.com')));
		$this->assertInternalType('array',$result);

		// Valid save - Portrait
		$this->Speaker->create();
		$result = $this->Speaker->save(array_merge($validData,array('protrait_url' => 'http://www.example.com')));
		$this->assertInternalType('array',$result);
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
