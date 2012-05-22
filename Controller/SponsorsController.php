<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends BostonConferenceAppController {

/**
 * before_filter method
 *
 */
	public function beforeFilter() {
		if ( property_exists($this,'Auth') )
			$this->Auth->allow('request');

		parent::beforeFilter();
	}

/**
 * index method.
 * Displays all approved sponsors.
 *
 * @return void
 */
	public function index() {
		$this->set('sponsorshipLevels', $this->Sponsor->forCurrentEvent());
	}

/**
 * request method.
 * Form used to request more information about sponsorships.
 *
 * @return void
 */
	public function request() {
		if ($this->request->is('post')) {

			if ( array_key_exists($this->Sponsor->alias,$this->request->data) )
				$this->request->data[$this->Sponsor->alias]['approved'] = 0;
			else
				$this->request->data['approved'] = 0;

			$this->Sponsor->create();
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('Your request has been submitted. We will get back to you shortly.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Your request could not be submitted. Please, try again.'));
			}
		}

		$this->_setBudgetOptions();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Sponsor->recursive = 0;
		$this->set('sponsors', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		$this->set('sponsor', $this->Sponsor->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Sponsor->create();
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		}

		$this->_setBudgetOptions();
		$sponsorshipLevels = $this->Sponsor->SponsorshipLevel->find('list');
		$this->set(compact('sponsorshipLevels'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sponsor->read(null, $id);
		}

		$this->_setBudgetOptions();
		$sponsorshipLevels = $this->Sponsor->SponsorshipLevel->find('list');
		$this->set(compact('sponsorshipLevels'));
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->Sponsor->delete()) {
			$this->Session->setFlash(__('Sponsor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sponsor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * Sets the budget options for the view
 *
 * @returns void
 */
	protected function _setBudgetOptions() {
		$this->set('budgetOptions',array(
			'-1000'  => 'Less than $1,000',
			'2500'  => 'Up to $2,500',
			'5000'  => 'Up to $5,000',
			'10000' => 'Up to $10,000',
			'99999' => 'Greater than $10,000',
			'0'     => 'Prefer not to say'
		));
	}
}
