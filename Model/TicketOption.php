<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * TicketOption Model
 *
 * @property Event $Event
 * @property Ticket $Ticket
 */
class TicketOption extends BostonConferenceAppModel {
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
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Label cannot be empty',
				'allowEmpty' => false,
				'required' => true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Label cannot excede 128 characters',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'available' => array(
			'comparison' => array(
				'rule' => array('comparison','>',-1),
				'message' => 'Available must be a positive integer',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'price' => array(
			'comparison' => array(
				'rule' => array('comparison','>',-1),
				'message' => 'Price must be a positive number.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'refundable' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Refundable must be true (1) or false (0)',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'sale_start' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Sale start must be a date and time',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'sale_end' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Sale end must be a date and time',
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
		'Ticket' => array(
			'className' => 'Ticket',
			'foreignKey' => 'ticket_option_id',
			'dependent' => false,
		)
	);

}
