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
			'foreignKey' => 'sponsorship_level_id',
			'dependent' => true,
		)
	);
}
