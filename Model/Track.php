<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Track Model
 *
 * @property Talk $Talk
 */
class Track extends BostonConferenceAppModel {
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
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Track name cannot be empty',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',32),
				'message' => 'Track name cannot excede 32 characters',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'color' => array(
			'colorcode' => array(
				'rule' => '/^([0-9a-f]{3}){1,2}$/i',
				'message' => 'Color should be a valid HTML RGB color in hex (no # symbol). Ex: #ff0000.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'position' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Position must be numeric',
				'allowEmpty' => false,
				'required' => true,
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
		'Talk' => array(
			'className' => 'BostonConference.Talk',
			'foreignKey' => 'track_id',
			'dependent' => false,
		)
	);

}
