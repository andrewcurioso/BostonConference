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
			'className' => 'BostonConference.TicketOption',
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

/**
 * Completes registration.
 *
 * @param string $userId The user id the tickets belong to.
 * @param array $data The ticket data to save.
 * @param Callback $callback An optional callback to confirm that the save should happen.
 * @return void 
 */
	public function completeRegistration( $userId, $data, $callback = null ) {

		if ( !$data || !array_key_exists('quantity',$data) || !is_array($data['quantity']) ) {
			return false;
		}

		$this->query('LOCK TABLES events as Event WRITE, ticket_options as TicketOption WRITE, tickets as Ticket WRITE');

		$this->TicketOption->recursive = -1;
		$options = $this->TicketOption->find(
				'all',
				array(
					'order'=>array('label'),
					'conditions' => array( 'TicketOption.id' => array_keys($data['quantity']) )
				)
			);

		if ( count($options) != count($data['quantity']) ) {
			return false;
		}

		$eventQuantities = array();

		foreach( $options as $ticketOption ) {
			$id = $ticketOption['TicketOption']['id'];

			if ( $ticketOption['TicketOption']['available'] !== null )
				$canBuy = $ticketOption['TicketOption']['available']-$ticketOption['TicketOption']['ticket_count'];
			else
				$canBuy = 999;

			if ( $canBuy < $data['quantity'][$id] ) {
				$this->query('UNLOCK TABLES');
				return false;
			}

			$eventId = $ticketOption['TicketOption']['event_id'];

			if ( !array_key_exists($eventId,$eventQuantities) )
				$eventQuantities[$eventId]  = $data['quantity'][$id];
			else
				$eventQuantities[$eventId] += $data['quantity'][$id];
		}

		$organization = $data['organization'];

		$this->begin();

		foreach ( $data['badge_name'] as $option => $names ) {

			foreach( $names as $name ) {
				$this->create();
				$result = $this->save(array(
					'ticket_option_id' => $option,
					'badge_name' => $name,
					'organization' => $organization,
					'user_id' => $userId,
					'paid' => 1
				));

				if ( !$result ) {
					$this->rollback();
					$this->query('UNLOCK TABLES');
					return false;
				}
			}
		}

		$events = $this->TicketOption->Event->find('all',array('conditions'=>array('Event.id' => array_keys($eventQuantities))));

		foreach( $events as $event ) {
			$newTotal = $event['Event']['ticket_count'] + $eventQuantities[$event['Event']['id']];

			if ( $event['Event']['available_tickets'] !== null ) {
				if ( $event['Event']['available_tickets'] < $newTotal ) {
					$this->rollback();
					$this->query('UNLOCK TABLES');
					return false;
				}
			}

			$this->TicketOption->Event->id = $event['Event']['id'];
			$this->TicketOption->Event->saveField('ticket_count',$newTotal);
		}

		if ( $callback && !call_user_func($callback) ) {
			$this->rollback();
			$this->query('UNLOCK TABLES');
			return false;
		}

		$this->commit();
		$this->query('UNLOCK TABLES');
		return true;
	}
}
