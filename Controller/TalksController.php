<?php
App::uses('BostonConferenceAppController', 'BostonConference.Controller');
/**
 * Talks Controller
 *
 * @property Talk $Talk
 */
class TalksController extends BostonConferenceAppController {

/**
 * helpers
 *
 * @var array
 */
	public $helpers = array('BostonConference.Schedule');

/**
 * index method
 *
 * @return void
 */
	public function schedule() {
		$tracks = array();
		$talks = $this->Talk->forCurrentEvent();

		foreach( $talks as $track ) {
			if ( $track['Track']['id'] )
				$tracks[$track['Track']['id']] = $track['Track'];
		}

		$this->set('tracks', array_values($tracks));
		$this->set('talks', $talks);
	}


	public function index() {
		$talks = $this->Talk->forCurrentEvent( true, array( 'Talk.speaker_id not' => null ));
		$this->set('talks', $talks);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Talk->recursive = 0;
		$this->set('talks', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Talk->id = $id;
		if (!$this->Talk->exists()) {
			throw new NotFoundException(__('Invalid talk'));
		}
		$this->set('talk', $this->Talk->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Talk->create();
			if ($this->Talk->save($this->request->data)) {
				$this->Session->setFlash(__('The talk has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The talk could not be saved. Please, try again.'));
			}
		}
		$events = $this->Talk->Event->find('list');
		$speakers = $this->Talk->Speaker->find('list');
		$tracks = $this->Talk->Track->find('list');
		$this->set(compact('events', 'speakers', 'tracks'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Talk->id = $id;
		if (!$this->Talk->exists()) {
			throw new NotFoundException(__('Invalid talk'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Talk->save($this->request->data)) {
				$this->Session->setFlash(__('The talk has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The talk could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Talk->read(null, $id);
		}
		$events = $this->Talk->Event->find('list');
		$speakers = $this->Talk->Speaker->find('list');
		$tracks = $this->Talk->Track->find('list');
		$this->set(compact('events', 'speakers', 'tracks'));
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
		$this->Talk->id = $id;
		if (!$this->Talk->exists()) {
			throw new NotFoundException(__('Invalid talk'));
		}
		if ($this->Talk->delete()) {
			$this->Session->setFlash(__('Talk deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Talk was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
