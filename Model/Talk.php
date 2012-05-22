<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Talk Model
 *
 * @property Event $Event
 * @property Speaker $Speaker
 * @property Track $Track
 */
class Talk extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'topic';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'topic' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a topic name.',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Topic name cannot excede 128 characters.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'start_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Start time must be a valid date and time.',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'end_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'End time must be a valid date and time.',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'approved' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Approved must be yes or no.',
				'allowEmpty' => true,
				'required' => false,
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
			'dependant' => false,
		),
		'Speaker' => array(
			'className' => 'BostonConference.Speaker',
			'foreignKey' => 'speaker_id',
			'order' => 'last_name',
			'dependant' => false,
		),
		'Track' => array(
			'className' => 'BostonConference.Track',
			'foreignKey' => 'track_id',
			'dependant' => false,
		)
	);
}
