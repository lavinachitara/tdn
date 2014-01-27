<?php
App::uses('AppModel', 'Model');
/**
 * Cartype Model
 *
 * @property Car $Car
 */
class Cartype extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'typename';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'typename' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Car' => array(
			'className' => 'Car',
			'foreignKey' => 'cartype_id',
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
