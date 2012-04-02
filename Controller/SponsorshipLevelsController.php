<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * SponsorshipLevels Controller
 *
 * @property SponsorshipLevel $SponsorshipLevel
 */
class SponsorshipLevelsController extends BostonConferenceAppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SponsorshipLevel->recursive = 0;
		$this->set('sponsorshipLevels', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->SponsorshipLevel->id = $id;
		if (!$this->SponsorshipLevel->exists()) {
			throw new NotFoundException(__('Invalid sponsorship level'));
		}
		$this->set('sponsorshipLevel', $this->SponsorshipLevel->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SponsorshipLevel->create();
			if ($this->SponsorshipLevel->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsorship level has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsorship level could not be saved. Please, try again.'));
			}
		}
		$events = $this->SponsorshipLevel->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->SponsorshipLevel->id = $id;
		if (!$this->SponsorshipLevel->exists()) {
			throw new NotFoundException(__('Invalid sponsorship level'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SponsorshipLevel->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsorship level has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsorship level could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SponsorshipLevel->read(null, $id);
		}
		$events = $this->SponsorshipLevel->Event->find('list');
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
		$this->SponsorshipLevel->id = $id;
		if (!$this->SponsorshipLevel->exists()) {
			throw new NotFoundException(__('Invalid sponsorship level'));
		}
		if ($this->SponsorshipLevel->delete()) {
			$this->Session->setFlash(__('Sponsorship level deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sponsorship level was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
