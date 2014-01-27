<?php
App::uses('AppModel', 'Model');
/**
 * Carbrand Model
 *
 * @property Userbrand $Userbrand
 * @property Carmodel $Carmodel
 */
class Carbrand extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'brandname';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'brandname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasOne associations
	 *
	 * @var array
	 */
	/*
	public $hasOne = array(
		'Userbrand' => array(
			'className' => 'Userbrand',
			'foreignKey' => 'carbrand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	*/

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
		),
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Carmodel' => array(
			'className' => 'Carmodel',
			'foreignKey' => 'carbrand_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
