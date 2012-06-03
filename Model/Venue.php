<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Venue Model
 *
 * @property Event $Event
 */
class Venue extends BostonConferenceAppModel {
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
				'rule' => array('between',2,128),
				'message' => 'Venue name must be between 2 and 128 characters.',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'website' => array(
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Venue website cannot excede 128 characters',
				'allowEmpty' => true,
				'required' => true
			),
			'url' => array(
				'rule' => array('url'),
				'message' => 'Venue website must be a valid URL',
				'allowEmpty' => true,
				'required' => true
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Event' => array(
			'className' => 'BostonConference.Event',
			'foreignKey' => 'venue_id',
			'dependent' => false
		)
	);

/**
 * Gets the venue for the current event.
 *
 * @returns array The venue for the current event.
 */
	public function forCurrentEvent() {
		if ( !($event = $this->Event->current()) && !$event['Event']['venue_id'] )
			return null;

		$this->contain( array( 'Event' => array( 'EventHotel' => array( 'Hotel' ) ) ) );

		$ret = $this->find('first', array( 'conditions' => array('Venue.id' => $event['Event']['venue_id']) ));
		$ret['Event'] = $ret['Event'][0];

		return $ret;
	}

}
