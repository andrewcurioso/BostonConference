<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * Ticket Model
 *
 * @property User $User
 * @property TicketOption $TicketOption
 */
class Ticket extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'badge_name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'badge_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Badge name cannot be empty',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Badge name cannot excede 128 characters',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'organization' => array(
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Organization name cannot excede 128 characters',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'paid' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Paid must be true (1) or false(0)',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'TicketOption' => array(
			'className' => 'TicketOption',
			'foreignKey' => 'ticket_option_id',
			'counterCache' => true,
		)
	);
}
