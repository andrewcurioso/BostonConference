<?php

if ( !Configure::read('BostonConference.timeFormat') )
	Configure::write('BostonConference.timeFormat', 'g:i a');

if ( !Configure::read('BostonConference.dateFormat') )
	Configure::write('BostonConference.dateFormat', 'l, F jS, Y');

if ( !Configure::read('BostonConference.Elements') )
	Configure::write('BostonConference.Elements.News.index', array('Welcome'));

if ( !Configure::read('BostonConference.Sponsors') )
	Configure::write('BostonConference.Sponsors', array('sponsorshipRequests'=>true));


class BostonConferenceAppController extends AppController {

/**
 * helpers
 *
 * @var array
 */
	public $helpers = array('BostonConference.ContentManagement', 'BostonConference.Gravatar');

/**
 * components
 *
 * @var array
 */
	public $components = array('BostonConference.Menu');

/**
 * Called before the controller action.  You can use this method to configure and customize components
 * or perform logic that needs to happen before each controller action.
 * Does conference initialization.
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->set('is_admin_area',$this->params['admin']);

		if ( $this->params['admin'] ) {
			$this->set('skinny_sidebar',true);
		}
	}

/**
 * Called after the controller action is run, but before the view is rendered. You can use this method
 * to perform logic or set view variables that are required on every request.
 *
 * @return void
 */
	public function beforeRender() {
		$this->set('element_path', array( preg_replace('/Controller$/','',get_class($this)), $this->action ));

		parent::beforeRender();
	}

}
