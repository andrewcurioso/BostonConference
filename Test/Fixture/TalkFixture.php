<?php
/**
 * TalkFixture
 *
 */
class TalkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'event_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'speaker_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'topic' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'abstract' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_time' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'end_time' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'approved' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'track_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'event_id' => array('column' => 'event_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'event_id' => 1,
			'speaker_id' => 1,
			'topic' => 'Lorem ipsum dolor sit amet',
			'abstract' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'start_time' => '2012-05-22 17:40:45',
			'end_time' => '2012-05-22 17:40:45',
			'approved' => 1,
			'track_id' => 1,
			'created' => '2012-05-22 17:40:45',
			'modified' => '2012-05-22 17:40:45'
		),
	);
}
