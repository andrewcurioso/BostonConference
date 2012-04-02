<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Sponsor Model
 *
 * @property SponsorshipLevel $SponsorshipLevel
 */
class Sponsor extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'organization';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'organization' => array(
			'between' => array(
				'rule' => array('between',2,128),
				'message' => 'Organization name must be between 2 and 128 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'website' => array(
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Website address cannot excede 128 characters',
				'allowEmpty' => false,
				'required' => true
			),
			'url' => array(
				'rule' => array('url'),
				'message' => 'Website address must be a valid URL',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'logo_url' => array(
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Logo URL cannot excede 128 characters',
				'allowEmpty' => true,
				'required' => false
			),
		),
		'contact_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Contact name is required',
				'allowEmpty' => false,
				'required' => true
			),
			'maxlength' => array(
				'rule' => array('maxlength',64),
				'message' => 'Contact name cannot excede 64 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'contact_email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Contact email is required',
				'allowEmpty' => false,
				'required' => true
			),
			'maxlength' => array(
				'rule' => array('maxlength',64),
				'message' => 'Contact email cannot excede 64 characters',
				'allowEmpty' => false,
				'required' => true
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Contact email address must be a valid email address',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'contact_phone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Contact phone is required',
				'allowEmpty' => false,
				'required' => true
			),
			'maxlength' => array(
				'rule' => array('maxlength',16),
				'message' => 'Contact pone cannot excede 16 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'budget' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Budget must be numeric',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'approved' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Enabled must be either yes (1) or no (0)',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'sponsorship_level_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sponsorship level must be numeric',
				'allowEmpty' =>true,
				'required' => true
			),
			'comparison' => array(
				'rule' => array('comparison','>=',0),
				'message' => 'Sponsorship Level ID must be a positive integer',
				'allowEmpty' => false,
				'required' => true,
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
		'SponsorshipLevel' => array(
			'className' => 'BostonConference.SponsorshipLevel',
			'foreignKey' => 'sponsorship_level_id',
		)
	);
}
