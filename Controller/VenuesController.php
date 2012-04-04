<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * Venues Controller
 *
 * @property Venue $Venue
 */
class VenuesController extends BostonConferenceAppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Venue->recursive = 1;
		$this->set('venue', $this->Venue->forCurrentEvent());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Venue->recursive = 0;
		$this->set('venues', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		$this->set('venue', $this->Venue->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Venue->create();
			if ($this->Venue->save($this->request->data)) {
				$this->Session->setFlash(__('The venue has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venue could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Venue->save($this->request->data)) {
				$this->Session->setFlash(__('The venue has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venue could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Venue->read(null, $id);
		}
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
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		if ($this->Venue->delete()) {
			$this->Session->setFlash(__('Venue deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Venue was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
