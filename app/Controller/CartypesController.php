<?php
App::uses('AppController', 'Controller');
/**
 * Cartypes Controller
 *
 * @property Cartype $Cartype
 * @property PaginatorComponent $Paginator
 */
class CartypesController extends AppController {

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
		$this->Cartype->recursive = 0;
		$this->Paginator->settings = array(
			'limit' => 10
		);
		$this->set('cartypes', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Cartype->exists($id)) {
			throw new NotFoundException(__('Invalid cartype'));
		}
		$options = array('conditions' => array('Cartype.' . $this->Cartype->primaryKey => $id));
		$this->set('cartype', $this->Cartype->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cartype->create();
			if ($this->Cartype->save($this->request->data)) {
				$this->Session->setFlash(__('The cartype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cartype could not be saved. Please, try again.'));
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
		if (!$this->Cartype->exists($id)) {
			throw new NotFoundException(__('Invalid cartype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cartype->save($this->request->data)) {
				$this->Session->setFlash(__('The cartype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cartype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cartype.' . $this->Cartype->primaryKey => $id));
			$this->request->data = $this->Cartype->find('first', $options);
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
		$this->Cartype->id = $id;
		if (!$this->Cartype->exists()) {
			throw new NotFoundException(__('Invalid cartype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cartype->delete()) {
			$this->Session->setFlash(__('The cartype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cartype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
