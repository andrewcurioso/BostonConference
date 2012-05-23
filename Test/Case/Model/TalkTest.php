<?php
App::uses('Talk', 'BostonConference.Model');

/**
 * Talk Test Case
 *
 */
class TalkTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.talk', 'plugin.boston_conference.event', 'plugin.boston_conference.speaker', 'plugin.boston_conference.track');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Talk = ClassRegistry::init('BostonConference.Talk');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$validData = array(
			'event_id' => 1,
			'speaker_id' => 1,
			'topic' => 'Lorem ipsum dolor sit amet',
			'abstract' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'start_time' => '2012-05-22 17:40:45',
			'duration' => 60,
			'approved' => 1,
			'track_id' => 1,
		);

		// Invalid name - Empty
		$result = $this->Talk->save(array_merge($validData,array('topic' => '')));
		$this->assertFalse($result);
		$this->assertEquals(array('topic'),array_keys($this->Talk->validationErrors));

		// Invalid topic - Too long
		$result = $this->Talk->save(array_merge($validData,array('topic' => str_pad($validData['topic'],129,'~'))));
		$this->assertFalse($result);
		$this->assertEquals(array('topic'),array_keys($this->Talk->validationErrors));

		// Duration - Not numeric
		$result = $this->Talk->save(array_merge($validData,array('duration' => 'a')));
		$this->assertFalse($result);
		$this->assertEquals(array('duration'),array_keys($this->Talk->validationErrors));

		// Duration - Negative
		$result = $this->Talk->save(array_merge($validData,array('duration' => '-1')));
		$this->assertFalse($result);
		$this->assertEquals(array('duration'),array_keys($this->Talk->validationErrors));

		// Approved - not a boolean
		$result = $this->Talk->save(array_merge($validData,array('approved' => '2' )));
		$this->assertFalse($result);
		$this->assertEquals(array('approved'),array_keys($this->Talk->validationErrors));

		// Valid save
		$this->Talk->create();
		$result = $this->Talk->save($validData);
		$this->assertInternalType('array',$result);
	}

/**
 * Test forCurrentEvent
 *
 * @return void
 */
	public function testForCurrentEvent() {
		$result = $this->Talk->forCurrentEvent();
		$this->assertInternalType('array',$result);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Talk);

		parent::tearDown();
	}

}
