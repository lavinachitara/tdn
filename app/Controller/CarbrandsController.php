<?php
App::uses('AppController', 'Controller');
/**
 * Carbrands Controller
 *
 * @property Carbrand $Carbrand
 * @property PaginatorComponent $Paginator
 */
class CarbrandsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	
	/**
	 * beforeFilter method
	 *
	 * @return void
	 */
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Auth->loggedIn()){
			
			if(!$this->Auth->user('isAdmin'))
			{
				$deny_user_action = Configure::read('deny_user_action'); 
				$action = strtolower($this->request->action);	
				if(in_array($action,$deny_user_action))
				{
					$this->redirect(array('controller' => 'users', 'action' => 'mysettings'));
				}
			}
		}
	}
	

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Carbrand->recursive = 0;
		$this->Paginator->settings = array(
			'limit' => 10
		);
		$this->set('carbrands', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	 /*
	public function view($id = null) {
		if (!$this->Carbrand->exists($id)) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		$options = array('conditions' => array('Carbrand.' . $this->Carbrand->primaryKey => $id));
		$this->set('carbrand', $this->Carbrand->find('first', $options));
	}
	*/

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Carbrand->create();
			if ($this->Carbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The carbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carbrand could not be saved. Please, try again.'));
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
		if (!$this->Carbrand->exists($id)) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Carbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The carbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carbrand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Carbrand.' . $this->Carbrand->primaryKey => $id));
			$this->request->data = $this->Carbrand->find('first', $options);
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
		$this->Carbrand->id = $id;
		if (!$this->Carbrand->exists()) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Carbrand->delete()) {
			$this->Session->setFlash(__('The carbrand has been deleted.'));
		} else {
			$this->Session->setFlash(__('The carbrand could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Carbrand->recursive = 0;
		$conditions = array();
		if($this->Auth->user('isDealer'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}
		$this->set('carbrands', $this->paginate('Carbrand', $conditions));
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Carbrand->exists($id)) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		$options = array('conditions' => array('Carbrand.' . $this->Carbrand->primaryKey => $id));
		$this->set('carbrand', $this->Carbrand->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {

		if(!$this->Auth->user('isAdmin'))
			$this->redirect('index');

		if ($this->request->is('post')) {
			$this->Carbrand->create();
			if ($this->Carbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The carbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carbrand could not be saved. Please, try again.'));
			}
		}
		$users = $this->Carbrand->User->find('list', array('conditions' => array('isDealer' => 1)));
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

		if(!$this->Auth->user('isAdmin'))
			$this->redirect('index');

		if (!$this->Carbrand->exists($id)) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Carbrand->save($this->request->data)) {
				$this->Session->setFlash(__('The carbrand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carbrand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Carbrand.' . $this->Carbrand->primaryKey => $id));
			$this->request->data = $this->Carbrand->find('first', $options);
		}
		$users = $this->Carbrand->User->find('list', array('conditions' => array('isDealer' => 1)));
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
		$this->Carbrand->id = $id;
		if (!$this->Carbrand->exists()) {
			throw new NotFoundException(__('Invalid carbrand'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Carbrand->delete()) {
			$this->Session->setFlash(__('The carbrand has been deleted.'));
		} else {
			$this->Session->setFlash(__('The carbrand could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
