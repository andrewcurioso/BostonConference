<?php
App::uses('News', 'BostonConference.Model');

/**
 * News Test Case
 *
 */
class NewsTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.news', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->News = ClassRegistry::init('BostonConference.News');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'title' => 'Lorem ipsum dolor sit amet',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		);

		// Invalid topic - Empty
		$result = $this->News->save(array_merge($validData,array('title' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('title'),array_keys($this->News->validationErrors));

		// Invalid title - Too long
		$result = $this->News->save(array_merge($validData,array('title' => str_pad($validData['title'],129,'~'))));
		$this->assertFalse($result);
		$this->assertEquals(array('title'),array_keys($this->News->validationErrors));

		// Invalid body - Empty
		$result = $this->News->save(array_merge($validData,array('body' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('body'),array_keys($this->News->validationErrors));

		// Valid save
		$this->News->create();
		$result = $this->News->save($validData);
		$this->assertInternalType('array',$result);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->News);

		parent::tearDown();
	}

}
