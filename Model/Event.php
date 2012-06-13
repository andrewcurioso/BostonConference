<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Event Model
 *
 */
class Event extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'between' => array(
				'rule' => array('between',3,256),
				'message' => 'Event name must be between 3 and 256 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'available_tickets' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Available tickets must be a number',
				'allowEmpty' => true,
				'required' => false
			),
			'comparison' => array(
				'rule' => array('comparison','>',-1),
				'message' => 'Available tickets must be a positive integer',
				'allowEmpty' => true,
				'required' => false
			),
		)
	);
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SponsorshipLevel' => array(
			'className' => 'BostonConference.SponsorshipLevel',
			'foreignKey' => 'event_id',
			'dependent' => true,
		),
		'EventHotel' => array(
			'className' => 'BostonConference.EventHotel',
			'foreignKey' => 'event_id',
			'dependent' => true,
		)
	);
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Venue' => array(
			'className' => 'BostonConference.Venue',
			'foreignKey' => 'venue_id'
		)
	);
/**
 * Gets the currently event.
 * This will typically be the next event but could be the previous event if
 * there isn't any next event.
 *
 * @returns array The current event.
 */
	public function current() {
		$this->contain();
		return $this->find('first', array(
			'order' => array( 'Event.start_date < NOW()', 'Event.start_date' )
		));
	}
}
