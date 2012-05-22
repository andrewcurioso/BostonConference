<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * EventHotels Controller
 *
 * @property EventHotel $EventHotel
 */
class EventHotelsController extends BostonConferenceAppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EventHotel->recursive = 0;
		$this->set('eventHotels', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->EventHotel->id = $id;
		if (!$this->EventHotel->exists()) {
			throw new NotFoundException(__('Invalid event hotel'));
		}
		$this->set('eventHotel', $this->EventHotel->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EventHotel->create();
			if ($this->EventHotel->save($this->request->data)) {
				$this->Session->setFlash(__('The event hotel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event hotel could not be saved. Please, try again.'));
			}
		}
		$events = $this->EventHotel->Event->find('list');
		$hotels = $this->EventHotel->Hotel->find('list');
		$this->set(compact('events', 'hotels'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->EventHotel->id = $id;
		if (!$this->EventHotel->exists()) {
			throw new NotFoundException(__('Invalid event hotel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EventHotel->save($this->request->data)) {
				$this->Session->setFlash(__('The event hotel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event hotel could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EventHotel->read(null, $id);
		}
		$events = $this->EventHotel->Event->find('list');
		$hotels = $this->EventHotel->Hotel->find('list');
		$this->set(compact('events', 'hotels'));
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
		$this->EventHotel->id = $id;
		if (!$this->EventHotel->exists()) {
			throw new NotFoundException(__('Invalid event hotel'));
		}
		if ($this->EventHotel->delete()) {
			$this->Session->setFlash(__('Event hotel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event hotel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
