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
 * view method.
 * Displays talk by id.
 *
 * @return void
 */
	public function view( $id ) {
		$talk = $this->Talk->forCurrentEvent( true, array( 'Talk.id' => $id ));
		$this->set('talks', $talk);
		$this->render('index');
	}

/**
 * admin_add_multiple method
 *
 * @return void
 */
	public function admin_add_multiple() {

		if ($this->request->is('post')) {

			$this->Talk->set($this->request->data);
			if ($this->Talk->validates( )) {

				$originalData = $this->request->data;
				$start = strtotime($this->Talk->deconstruct('start_time', $this->request->data['Talk']['start_of_day']));
				$end = strtotime("-{$this->request->data['Talk']['duration']} minutes",
								 strtotime($this->Talk->deconstruct('start_time', array_merge(
														  $this->request->data['Talk']['start_of_day'],
														  $this->request->data['Talk']['end_of_day']
														  ))));
				$interval = $this->request->data['Talk']['interval'];
				$counter = 0;
				$data = array();

				while( $start <= $end ) {
					$counter++;

					// Set new start time
					$this->Talk->set( 'start_time', date('Y-m-d H:i', $start));

					// Append index to topic name
					$this->Talk->set( 'topic', "{$this->request->data['Talk']['topic']} : {$counter}");

					// Store
					$data[] = $this->Talk->data;

					// Next start time
					$start = strtotime( "+{$interval} minutes", $start );
				}

				// saveMany
				if( $counter && $this->Talk->saveMany( $data ) ) {
					$this->Session->setFlash(__("{$counter} talks have been created"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The talks could not be created. Please, try again.'));
				}
			} else {
				$this->Session->setFlash(__('The talks could not be created. Please, try again.'));
			}
		}

		$events = $this->Talk->Event->find('list');
		$speakers = $this->Talk->Speaker->find('list');
		$tracks = $this->Talk->Track->find('list');
		$this->set(compact('events', 'speakers', 'tracks'));
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
