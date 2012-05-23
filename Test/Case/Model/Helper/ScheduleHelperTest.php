<?php

App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('ScheduleHelper', 'Plugin/BostonConference/View/Helper');

class ScheduleHelperTest extends CakeTestCase {

/**
 * Schedule stores the helper instance.
 *
 * @var ScheduleHelper
 */
 	protected $Schedule = null;

/**
 * Talk data used for test
 *
 * @var array
 */
	protected $_sampleTalk = array(
		'Talk' => Array
		(
			'id' => 3,
			'event_id' => 3,
			'speaker_id' => 0,
			'topic' => 'Registration',
			'abstract' => '',
			'start_time' => '2012-05-22 09:00:00',
			'duration' => 60,
			'approved' => 1,
			'track_id' => 0,
			'created' => '2012-05-23 01:06:54',
			'modified' => '2012-05-23 01:06:54',
		),

		'Speaker' => Array
		(
			'id' => '',
			'user_id' => '',
			'approved_talk_count' => '',
			'first_name' => '',
			'last_name' => '',
			'bio' => '',
			'website' => '',
			'featured' => '',
			'portrait_url' => '',
			'display_name' => '',
		),

		'Track' => Array
		(
			'id' => '',
			'name' => '',
			'color' => '',
			'position' => '',
			'talk_count' => '',
			'created' => '',
			'modified' => '',
		),
	);

/**
 * Setup the test.
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$Controller = new Controller();
		$View = new View($Controller);
		$this->Schedule = new ScheduleHelper($View);
	}

/**
 * Test the getTalksInBlock function.
 *
 * @return void
 */
	public function testGetTalksInBlock() {
		$talks = array(
			$this->_sampleTalk,
			$this->_sampleTalk,
			$this->_sampleTalk
		);

		$talks[2]['Talk']['start_time'] = '2012-05-22 10:00:00';

		$block = strtotime($this->_sampleTalk['Talk']['start_time']);

		$result = $this->Schedule->getTalksInBlock($block, $talks, 0);
		$this->assertInternalType('array',$result);
		$this->assertEquals(2, count($result));

		$result = $this->Schedule->getTalksInBlock($block, $talks, 1);
		$this->assertInternalType('array',$result);
		$this->assertEquals(1, count($result));

		$result = $this->Schedule->getTalksInBlock($block+60*60, $talks, 0);
		$this->assertInternalType('array',$result);
		$this->assertEquals(1, count($result));
	}

/**
 * Test the getTalkClass function.
 *
 * @return void
 */
	public function testGetTalkClass() {

		$result = $this->Schedule->getTalkClass($this->_sampleTalk,1,0);
		$this->assertEqual('minutes-60', $result);

		$result = $this->Schedule->getTalkClass($this->_sampleTalk,2,0);
		$this->assertContains('minutes-60', $result);
		$this->assertContains('double-block', $result);

		$result = $this->Schedule->getTalkClass($this->_sampleTalk,2,1);
		$this->assertContains('minutes-60', $result);
		$this->assertContains('double-block', $result);
		$this->assertContains('talk-2', $result);
		
		$withTrack = $this->_sampleTalk;
		$withTrack['Track']['id'] = 9;
		$result = $this->Schedule->getTalkClass($withTrack,1,0);
		$this->assertContains('minutes-60', $result);
		$this->assertContains('track-9', $result);
	}

/**
 * Test the calandar function.
 *
 * @return void
 */
	public function testCalandar() {
		$validData = array(
			$this->_sampleTalk
		);

		$result = $this->Schedule->calandar($validData);

		$this->assertContains('class="day"', $result);
		$this->assertContains('class="time"', $result);
		$this->assertContains($this->_sampleTalk['Talk']['topic'], $result);
	}
}
