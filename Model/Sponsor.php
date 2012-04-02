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
		'sponsorship_level_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sponsorship level must be numeric',
				'allowEmpty' => false,
				'required' => true
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
