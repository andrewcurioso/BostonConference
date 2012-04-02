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
			'maxlength' => array(
				'rule' => array('maxlength',256),
				'message' => 'Event name cannot excede 256 characters',
				'allowEmpty' => false,
				'required' => true
			),
			'minlength' => array(
				'rule' => array('minlength',3),
				'message' => 'Event name must be at least three characters',
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
			'className' => 'SponsorshipLevel',
			'foreignKey' => 'sponsorship_level_id',
			'dependent' => true,
		)
	);
}
