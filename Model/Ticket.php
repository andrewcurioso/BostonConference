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

/**
 * Validates a badge name and calls invalidate if appropriate.
 *
 * @param string $key The data key for the badge name.
 * @param string $value The value of the badge name.
 * @return boolean True if the badge name validates.
 */
	public function validateBadgeName($key,$value) {
		foreach ( $this->validate['badge_name'] as $rule ) {

			$params = $rule['rule'];
			$ruleName = array_shift($params);
			array_unshift($params,$value);

			$result = call_user_func_array(array('Validation', $ruleName), $params);

			if ( !$result ) {
				$this->invalidate($key,$rule['message']);
				return false;
			}
		}

		return true;
	}
}
