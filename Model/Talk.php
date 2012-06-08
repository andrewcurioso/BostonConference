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
		'duration' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Duration must be a valid number.',
				'allowEmpty' => true,
				'required' => false,
			),
			'comparison' => array(
				'rule' => array('comparison','>',0),
				'message' => 'Duration must be greatre than 0.',
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

/**
 * Gets the talks for the current event.
 *
 * @param boolean $approved True to get only sponsors that have been approved or otherwise false.
 * @param array $conditions optional array of conditions
 * @returns array The talks for the current event.
 */
	public function forCurrentEvent($approved = true, $conditions = array()) {
		if ( !($event = $this->Event->current()) )
			return array();

		$defaultConditions = array(
			'Talk.event_id' => $event['Event']['id']
		);

		$conditions = array_merge( $conditions, $defaultConditions );

		if ( $approved )
			$conditions['Talk.approved'] = 1;

		$this->contain(array('Track','Speaker'));

		return $this->find('all', array(
			'conditions' => $conditions,
			'order' => 'start_time'
		));
	}
}
