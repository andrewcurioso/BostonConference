<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * Speakers Controller
 *
 * @property Speaker $Speaker
 */
class SpeakersController extends BostonConferenceAppController {

/**
 * index method.
 * Displays all approved speakers.
 *
 * @return void
 */
	public function index() {
		$this->set('speakers', $this->Speaker->find('all', array('conditions'=>array('Speaker.featured'=>'1'))));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Speaker->recursive = 0;
		$this->set('speakers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		$this->set('speaker', $this->Speaker->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Speaker->create();
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		}
		$users = $this->Speaker->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Speaker->read(null, $id);
		}
		$users = $this->Speaker->User->find('list');
		$this->set(compact('users'));
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
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->Speaker->delete()) {
			$this->Session->setFlash(__('Speaker deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Speaker was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
