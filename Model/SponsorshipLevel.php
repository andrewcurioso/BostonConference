<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * SponsorshipLevel Model
 *
 * @property Event $Event
 * @property Sponsor $Sponsor
 */
class SponsorshipLevel extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'label';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'label' => array(
			'between' => array(
				'rule' => array('between',3,32),
				'message' => 'Label must be between 3 and 32 characters long',
				'allowEmpty' => false,
				'required' => false
			),
		),
		'event_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Event ID must be numeric',
				'allowEmpty' => false,
				'required' => true,
			),
			'comparison' => array(
				'rule' => array('comparison','>',0),
				'message' => 'Event ID must be greater than 0',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'position' => array(
			'comparison' => array(
				'rule' => array('comparison','>=',0),
				'message' => 'Position must be a positive integer',
				'allowEmpty' => false,
				'required' => true,
			),
			'comparison-2' => array(
				'rule' => array('comparison','<=',127),
				'message' => 'Position must be less than 128',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'sponsor_count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sponsor count must be numeric',
				'allowEmpty' => true,
				'required' => false,
			),
			'comparison' => array(
				'rule' => array('comparison','>=',0),
				'message' => 'Sponsor count must be a positive integer',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Sponsor' => array(
			'className' => 'BostonConference.Sponsor',
			'foreignKey' => 'sponsorship_level_id',
			'dependent' => true,
		)
	);

}
