<?php
App::uses('Event', 'BostonConference.Model');

/**
 * Event Test Case
 *
 */
class EventTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.boston_conference.event');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Event = ClassRegistry::init('BostonConference.Event');
	}

/**
 * Test save and validation rules
 *
 * @returns void
 */
	public function testSave() {
		$result = $this->Event->save(array('name' => 'ab','description'=>''));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Event->validationErrors));

		$result = $this->Event->save(array('name' => str_pad('ab',257,'=-'),'description'=>''));
		$this->assertFalse($result);
		$this->assertEquals(array('name'),array_keys($this->Event->validationErrors));

		$result = $this->Event->save(array('name' => 'Test Event','description'=>''));
		$this->assertInternalType('array',$result);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Event);

		parent::tearDown();
	}

}
