<?php
App::uses('AppController', 'Controller');
/**
 * Carmodels Controller
 *
 * @property Carmodel $Carmodel
 * @property PaginatorComponent $Paginator
 */
class CarmodelsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Carmodel->recursive = 0;
		$this->Paginator->settings = array(
			'limit' => 10
		);
		$this->set('carmodels', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Carmodel->exists($id)) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $id));
		$this->set('carmodel', $this->Carmodel->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Carmodel->create();
			if ($this->Carmodel->save($this->request->data)) {
				$this->Session->setFlash(__('The carmodel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carmodel could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Carmodel->exists($id)) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Carmodel->save($this->request->data)) {
				$this->Session->setFlash(__('The carmodel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carmodel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $id));
			$this->request->data = $this->Carmodel->find('first', $options);
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Carmodel->id = $id;
		if (!$this->Carmodel->exists()) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Carmodel->delete()) {
			$this->Session->setFlash(__('The carmodel has been deleted.'));
		} else {
			$this->Session->setFlash(__('The carmodel could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
