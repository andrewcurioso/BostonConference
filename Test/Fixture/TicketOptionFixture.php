<?php
/**
 * TicketOptionFixture
 *
 */
class TicketOptionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'event_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'label' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ticket_count' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'available' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '7,2'),
		'refundable' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'sale_start' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'sale_end' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'event_id' => array('column' => 'event_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
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
			'label' => 'Lorem ipsum dolor sit amet',
			'ticket_count' => 1,
			'available' => 1,
			'price' => 1,
			'refundable' => 1,
			'sale_start' => '2012-06-10 15:36:11',
			'sale_end' => '2012-06-10 15:36:11',
			'created' => '2012-06-10 15:36:11',
			'modified' => '2012-06-10 15:36:11'
		),
	);
}
