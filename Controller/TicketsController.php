<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 */
class TicketsController extends BostonConferenceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session','BostonConference.Payments');

/**
 * Before filter
 *
 * @return void
 */
	public function beforeFilter() {
		$this->Auth->allow(array('checkout'));

		return parent::beforeFilter();
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {
			$countIsValid = false;

			foreach( $this->data['quantity'] as $quantity ) {
				if ( $quantity > 0 ) {
					$countIsValid = true;
					break;
				}
			}

			if ( $countIsValid ) {
				$this->Session->write('Ticket',$this->data);
				$this->redirect(array('action' => 'checkout'));
			} else {
				$this->Session->setFlash(__('Please select a valid quantity of tickets before continuing'));
			}
		}

		// Conditions to return TicketOptions that are within the specified start & end dates,
		// or that have no start date, or no end date
		$conditions = array(
							 array( 'OR' =>
								   array(
									'TicketOption.sale_start < NOW()',
									'TicketOption.sale_start IS NULL',
									)
								  ),
							 array( 'OR' =>
								   array(
									'TicketOption.sale_end > NOW()',
									'TicketOption.sale_end IS NULL'
									)
								   )
							);

		$this->set('ticketOptions', $this->Ticket->TicketOption->find('all',
																	  array('order'=>array('label'),
																			'conditions' => $conditions
																			)));


		$this->set('tickets', $this->Ticket->find('all',array(
			'order'=>array('Ticket.badge_name','Ticket.id'),
			'conditions'=>array('user_id' => $this->Auth->user('id'))
		)));
	}

/**
 * checkout method
 *
 * @return void
 */
	public function checkout() {
		if ( !$this->Auth->loggedIn() ) {
			$this->Session->setFlash(__('Please login before buying tickets'));
			$this->redirect($this->Auth->loginAction);
		}

		$ticket = $this->Session->read('Ticket');
		if ( !$ticket || !array_key_exists('quantity',$ticket) || !is_array($ticket['quantity']) ) {
			$this->Session->delete('Ticket');
			$this->redirect(array('action' => 'index'));
		}

		$options = $this->Ticket->TicketOption->find(
				'all',
				array(
					'order'=>array('label'),
					'conditions' => array( 'id' => array_keys($ticket['quantity']) )
				)
			);

		if ( count($options) != count($ticket['quantity']) ) {
			$this->Session->delete('Ticket');
			$this->Session->setFlash(__('An error occured processing your tickets'));
			$this->redirect(array('action' => 'index'));
		}

		$totalPrice = 0;

		foreach ( $options as $i => $option ) {
			foreach ( $ticket['quantity'] as $id => $quantity ) {
				if ( $option['TicketOption']['id'] == $id ) {
					$options[$i]['TicketOption']['quantity'] = $quantity;
					$totalPrice += $quantity * $option['TicketOption']['price'];
					break;
				}
			}
		}

		if ($this->request->is('post')) {

			$valid = true;
			$ticket['badge_name'] = array();

			$ticket['organization'] = $this->data['Ticket']['organization'];

			foreach( $this->data['Ticket'] as $key => $value ) {
				if ( preg_match('/badge_name_([0-9]+)_([0-9]+)/',$key,$m) == 1 ) {

					$valid = $valid && $this->Ticket->validateBadgeName($key,$value);

					if ( !array_key_exists($m[1],$ticket['badge_name']) )
						$ticket['badge_name'][$m[1]] = array($value);
					else
						$ticket['badge_name'][$m[1]][] = $value;
				}
			}

			if ( $valid ) {
				$this->Session->write('Ticket',$ticket);

				if ( $totalPrice > 0 ) {
					if ( !$this->Payments->process($totalPrice) ) {
						$this->Session->setFlash(__('There was an error processing your tickets'));
						$this->redirect(array('action' => 'index'));
					}
				}

				if ( $this->_completeRegistration() ) {
					$this->Session->setFlash(__('Thank you'));
				} else {
					$this->Session->setFlash(__('There was an error processing your tickets'));
				}
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('ticketOptions',$options);
		$this->set('totalPrice',$totalPrice);
	}

/**
 * confirm method
 *
 * @return void
 */
	public function confirm() {
		if ( $this->_completeRegistration(array($this->Payments,'confirm')) ) {
			$this->Session->setFlash(__('Thank you'));
		} else {
			$this->Session->setFlash(__('There was an error processing your tickets'));
		}

		$this->Session->delete('PayPal');
		$this->Session->delete('Ticket');

		$this->redirect(array('action' => 'index'));
	}

/**
 * cancel method
 *
 * @return void
 */
	public function cancel() {
		$this->Session->delete('PayPal');
		$this->Session->delete('Ticket');

		$this->Session->setFlash(__('Your ticket purchase has been canceled'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Ticket->recursive = 0;
		$this->set('tickets', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		$this->set('ticket', $this->Ticket->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Ticket->create();
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'));
			}
		}
		$users = $this->Ticket->User->find('list');
		$ticketOptions = $this->Ticket->TicketOption->find('list');
		$this->set(compact('users', 'ticketOptions'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ticket->read(null, $id);
		}
		$users = $this->Ticket->User->find('list');
		$ticketOptions = $this->Ticket->TicketOption->find('list');
		$this->set(compact('users', 'ticketOptions'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->Ticket->delete()) {
			$this->Session->setFlash(__('Ticket deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ticket was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * Completes registration.
 *
 * @return void
 */
	protected function _completeRegistration( $callback = null ) {

		if ( !($userId = $this->Auth->user('id')) )
			return false;

		$ticket = $this->Session->read('Ticket');
		if ( !$ticket || !array_key_exists('quantity',$ticket) || !is_array($ticket['quantity']) ) {
			$this->Session->delete('Ticket');
			$this->redirect(array('action' => 'index'));
		}

		$options = $this->Ticket->TicketOption->find(
				'all',
				array(
					'order'=>array('label'),
					'conditions' => array( 'id' => array_keys($ticket['quantity']) )
				)
			);

		if ( count($options) != count($ticket['quantity']) ) {
			$this->Session->delete('Ticket');
			$this->Session->setFlash(__('An error occured processing your tickets'));
			$this->redirect(array('action' => 'index'));
		}

		$organization = $ticket['organization'];

		$this->Ticket->begin();

		foreach ( $ticket['badge_name'] as $option => $names ) {

			foreach( $names as $name ) {
				$this->Ticket->create();
				$result = $this->Ticket->save(array(
					'ticket_option_id' => $option,
					'badge_name' => $name,
					'organization' => $organization,
					'user_id' => $userId,
					'paid' => 1
				));

				if ( !$result ) {
					$this->Ticket->rollback();
					return false;
				}
			}
		}

		if ( $callback && !call_user_func($callback) ) {
			$this->Ticket->rollback();
			return false;
		}

		$this->Ticket->commit();
		return true;
	}
}
