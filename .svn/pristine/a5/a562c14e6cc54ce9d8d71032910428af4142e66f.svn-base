<?php
App::uses('AppController', 'Controller');
/**
 * Userbrands Controller
 *
 * @property Userbrand $Userbrand
 * @property PaginatorComponent $Paginator
 */
class UserbrandsController extends AppController {

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
		$this->Userbrand->recursive = 0;
		$this->set('userbrands', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userbrand->exists($id)) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		$options = array('conditions' => array('Userbrand.' . $this->Userbrand->primaryKey => $id));
		$this->set('userbrand', $this->Userbrand->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userbrand->create();
			if ($this->Userbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The userbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userbrand could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userbrand->User->find('list');
		$carbrands = $this->Userbrand->Carbrand->find('list');
		$this->set(compact('users', 'carbrands'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userbrand->exists($id)) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The userbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userbrand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userbrand.' . $this->Userbrand->primaryKey => $id));
			$this->request->data = $this->Userbrand->find('first', $options);
		}
		$users = $this->Userbrand->User->find('list');
		$carbrands = $this->Userbrand->Carbrand->find('list');
		$this->set(compact('users', 'carbrands'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userbrand->id = $id;
		if (!$this->Userbrand->exists()) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userbrand->delete()) {
			$this->Session->setFlash(__('The userbrand has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userbrand could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Userbrand->recursive = 0;
		$this->set('userbrands', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Userbrand->exists($id)) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		$options = array('conditions' => array('Userbrand.' . $this->Userbrand->primaryKey => $id));
		$this->set('userbrand', $this->Userbrand->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Userbrand->create();
			if ($this->Userbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The userbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userbrand could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userbrand->User->find('list');
		$carbrands = $this->Userbrand->Carbrand->find('list');
		$this->set(compact('users', 'carbrands'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Userbrand->exists($id)) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The userbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userbrand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userbrand.' . $this->Userbrand->primaryKey => $id));
			$this->request->data = $this->Userbrand->find('first', $options);
		}
		$users = $this->Userbrand->User->find('list');
		$carbrands = $this->Userbrand->Carbrand->find('list');
		$this->set(compact('users', 'carbrands'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Userbrand->id = $id;
		if (!$this->Userbrand->exists()) {
			throw new NotFoundException(__('Invalid userbrand'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userbrand->delete()) {
			$this->Session->setFlash(__('The userbrand has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userbrand could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
