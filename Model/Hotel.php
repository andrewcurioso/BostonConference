<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Hotel Model
 *
 * @property EventHotel $EventHotel
 */
class Hotel extends BostonConferenceAppModel {
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
				'message' => 'Please enter an name for this hotel',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',64),
				'message' => 'Hotel name cannot exceed 64 characters',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'website' => array(
			'url' => array(
				'rule' => array('url'),
				'message' => 'Please enter a valid hotel URL.',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',64),
				'message' => 'Hotel URL cannot exceed 64 characters',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter an address for the hotel',
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
		'EventHotel' => array(
			'className' => 'EventHotel',
			'foreignKey' => 'hotel_id',
			'dependent' => true,
		)
	);

}
