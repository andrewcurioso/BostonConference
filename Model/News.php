<?php
App::uses('BostonConferenceAppModel', 'BostonConference.Model');
/**
 * News Model
 *
 * @property User $User
 */
class News extends BostonConferenceAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a title.',
				'allowEmpty' => false,
				'required' =>true,
			),
			'maxlength' => array(
				'rule' => array('maxlength',128),
				'message' => 'Title cannot excede 128 characters.',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a article body.',
				'allowEmpty' => false,
				'required' =>true,
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
