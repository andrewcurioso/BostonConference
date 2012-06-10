<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * TicketOptions Controller
 *
 * @property TicketOption $TicketOption
 */
class TicketOptionsController extends BostonConferenceAppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->TicketOption->recursive = 0;
		$this->set('ticketOptions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->TicketOption->id = $id;
		if (!$this->TicketOption->exists()) {
			throw new NotFoundException(__('Invalid ticket option'));
		}
		$this->set('ticketOption', $this->TicketOption->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TicketOption->create();
			if ($this->TicketOption->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket option has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket option could not be saved. Please, try again.'));
			}
		}
		$events = $this->TicketOption->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->TicketOption->id = $id;
		if (!$this->TicketOption->exists()) {
			throw new NotFoundException(__('Invalid ticket option'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TicketOption->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket option has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket option could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TicketOption->read(null, $id);
		}
		$events = $this->TicketOption->Event->find('list');
		$this->set(compact('events'));
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
		$this->TicketOption->id = $id;
		if (!$this->TicketOption->exists()) {
			throw new NotFoundException(__('Invalid ticket option'));
		}
		if ($this->TicketOption->delete()) {
			$this->Session->setFlash(__('Ticket option deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ticket option was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
