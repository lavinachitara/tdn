<?php
App::uses('AppModel', 'Model');
/**
 * Car Model
 *
 * @property Carmodel $Carmodel
 * @property Carbrand $Carbrand
 * @property Testdrive $Testdrive
 */
class Car extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Carmodel' => array(
			'className' => 'Carmodel',
			'foreignKey' => 'carmodel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Carbrand' => array(
			'className' => 'Carbrand',
			'foreignKey' => 'carbrand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Testdrive' => array(
			'className' => 'Testdrive',
			'foreignKey' => 'car_id',
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
