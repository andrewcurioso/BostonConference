<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * EventHotel Model
 *
 * @property Event $Event
 * @property Hotel $Hotel
 */
class EventHotel extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_rate' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Group rate must be yes or no',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Event' => array(
			'className' => 'BostonConference.Event',
			'foreignKey' => 'event_id',
		),
		'Hotel' => array(
			'className' => 'BostonConference.Hotel',
			'foreignKey' => 'hotel_id',
		)
	);
}
