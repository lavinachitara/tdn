<?php
App::uses('AppController', 'Controller');
/**
 * Resellers Controller
 *
 * @property Reseller $Reseller
 * @property PaginatorComponent $Paginator
 */
class ResellersController extends AppController {

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
		$this->Reseller->recursive = 0;
		$this->set('resellers', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Reseller->exists($id)) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		$options = array('conditions' => array('Reseller.' . $this->Reseller->primaryKey => $id));
		$this->set('reseller', $this->Reseller->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reseller->create();
			if ($this->Reseller->save($this->request->data)) {
				$this->Session->setFlash(__('The reseller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reseller could not be saved. Please, try again.'));
			}
		}
		$users = $this->Reseller->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Reseller->exists($id)) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reseller->save($this->request->data)) {
				$this->Session->setFlash(__('The reseller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reseller could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reseller.' . $this->Reseller->primaryKey => $id));
			$this->request->data = $this->Reseller->find('first', $options);
		}
		$users = $this->Reseller->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Reseller->id = $id;
		if (!$this->Reseller->exists()) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Reseller->delete()) {
			$this->Session->setFlash(__('The reseller has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reseller could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {

		if(!$this->Auth->user('isDealer'))
			throw new NotFoundException(__('Invalid Access'));

		$this->Reseller->recursive = 0;
		$this->set('resellers', $this->Paginator->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if(!$this->Auth->user('isDealer'))
			throw new NotFoundException(__('Invalid Access'));

		if (!$this->Reseller->exists($id)) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		$options = array('conditions' => array('Reseller.' . $this->Reseller->primaryKey => $id));
		$this->set('reseller', $this->Reseller->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {

		if(!$this->Auth->user('isDealer'))
			throw new NotFoundException(__('Invalid Access'));

		if ($this->request->is('post')) {
			$this->Reseller->create();
			if ($this->Reseller->save($this->request->data)) {
				$this->Session->setFlash(__('The reseller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reseller could not be saved. Please, try again.'));
			}
		}
		$users = $this->Reseller->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {

		if(!$this->Auth->user('isDealer'))
			throw new NotFoundException(__('Invalid Access'));

		if (!$this->Reseller->exists($id)) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reseller->save($this->request->data)) {
				$this->Session->setFlash(__('The reseller has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reseller could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reseller.' . $this->Reseller->primaryKey => $id));
			$this->request->data = $this->Reseller->find('first', $options);
		}
		$users = $this->Reseller->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {

		if(!$this->Auth->user('isDealer'))
			throw new NotFoundException(__('Invalid Access'));

		$this->Reseller->id = $id;
		if (!$this->Reseller->exists()) {
			throw new NotFoundException(__('Invalid reseller'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Reseller->delete()) {
			$this->Session->setFlash(__('The reseller has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reseller could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
