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
			'maxlength' => array(
				'rule' => array('maxlength',32),
				'message' => 'Label cannot excede 32 characters',
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
		),
		'position' => array(
			'between' => array(
				'rule' => array('between',0,127),
				'message' => 'Position must be between 0 and 127',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'sponsors_count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sponsor count must be numeric',
				'allowEmpty' => true,
				'required' => false,
			),
			'comparison' => array(
				'rule' => array('comparison','>',0),
				'message' => 'Sponsor count must be greater than 0',
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
			'className' => 'Event',
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
			'className' => 'Sponsor',
			'foreignKey' => 'sponsorship_level_id',
			'dependent' => true,
		)
	);

}
