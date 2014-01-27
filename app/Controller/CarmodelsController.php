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
	 * beforeFilter method
	 *
	 * @return void
	 */
	 
	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Auth->loggedIn()){
			if(!$this->Auth->user('isAdmin') && !$this->Auth->user('isDealer'))
			{
				$deny_user_action = Configure::read('deny_user_action'); 
				$action = strtolower($this->request->action);	
				if(in_array($action,$deny_user_action))
				{
					$this->redirect('listmodels');
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
		$this->Carmodel->recursive = 0;
		
		$this->Paginator->settings = array(
			'limit' => 0
		);

		$conditions = array('User.isAdmin' => 0);

		$this->set('users', $this->paginate('User',$conditions));

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
		$carbrands = $this->Carmodel->Carbrand->find('list');
		$this->set(compact('carbrands'));
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
		$carbrands = $this->Carmodel->Carbrand->find('list');
		$this->set(compact('carbrands'));
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

	/**
	 * admin_statistics method
	 *
	 * @return void
	 */
	public function admin_statistics() {
		
		$conditions = array();
		if($this->Auth->user('isDealer'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}
		$carbrands = $this->Carmodel->Carbrand->find('list', array('conditions' => $conditions));
		
		$this->set(compact('carbrands'));
		/*
		$options = array(
			'conditions' => $conditions,
			'group' => 'Carmodel.id',
			'fields' => array('count(Carmodel.id) as totalrequests', 'Testdrive.*', 'Carmodel.*')
			//'fields' => array('Testdrive.id', 'Testdrive.customer_contact', 'Carmodel.modelname', 'User.name', 'count(Carmodel.id)')
		);

		echo '<pre>'; print_r($this->Carmodel->find('all')); exit;
		//test drive request statistics
		
		echo '<pre>'; print_r( $this->Testdrive->find('all', $options)); exit;
		
		$this->set('testdrives', $this->Testdrive->find('all', $options));
		*/
	}
	
	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Carmodel->recursive = 0;
		$conditions = array();
		if($this->Auth->user('isDealer'))
		{
			$conditions['Carbrand.user_id'] = $this->Auth->user('id');
		}

		if($this->request->is('post')){
			$data = $this->request->data;
			//echo '<pre>'; print_r($data); exit;

			if(isset($data['Carmodel']['carbrand_id']) && $data['Carmodel']['carbrand_id'] != 0)
			{
				$conditions['Carbrand.id'] = $data['Carmodel']['carbrand_id'];
			}
		}

		//$this->set('carmodels', $this->paginate('Carmodel', $conditions));
		$this->set('carmodels', $this->Carmodel->find('all', array('conditions' => $conditions)));

		$conditions = array();
		if($this->Auth->user('isDealer'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}
		$carbrands = $this->Carmodel->Carbrand->find('list', array('conditions' => $conditions));
		
		$this->set(compact('carbrands'));
	}

	/**
	 * ajaxlistmodels method
	 *
	 * @return void	
	 */
	public function ajaxlistmodels() {
		
		$this->layout = false;
		
		$conditions = array();

		if($this->request->is('ajax')){
			$data = $this->request->data;
			//echo '<pre>'; print_r($data); exit;

			if(isset($data['carbrand_id']) && $data['carbrand_id'] != 0)
			{
				$conditions['carbrand_id'] = $data['carbrand_id'];
			}

			$carmodels = $this->Carmodel->find('list', array('conditions' => $conditions));
		
			echo json_encode($carmodels);
			exit;
		}
	}
	
	/**
	 * admin_listmodels method
	 *
	 * @return void	
	 */
	public function admin_listmodels() {
		//$this->Carmodel->recursive = 0;
		//$this->set('carmodels', $this->Paginator->paginate());
		
		$conditions = array();
		if($this->request->is('post')){
			$data = $this->request->data;
			//echo '<pre>'; print_r($data); exit;

			if(isset($data['Carmodel']['carbrand_id']) && $data['Carmodel']['carbrand_id'] != 0)
			{
				$conditions['Carbrand.id'] = $data['Carmodel']['carbrand_id'];
			}
		}

		$this->set('carmodels', $this->Carmodel->find('all', array('conditions' => $conditions)));
		
		$conditions = array();
		
		$carbrands = $this->Carmodel->Carbrand->find('list', array('conditions' => $conditions));
		
		$this->set(compact('carbrands'));
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Carmodel->exists($id)) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $id));
		$this->set('carmodel', $this->Carmodel->find('first', $options));
	}

	

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Carmodel->create();
			if ($this->Carmodel->save($this->request->data)) {
				$this->Session->setFlash(__('The carmodel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The carmodel could not be saved. Please, try again.'));
			}
		}

		$conditions = array();
		if(!$this->Auth->user('isAdmin'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}
		$carbrands = $this->Carmodel->Carbrand->find('list', array('conditions' => $conditions));
		$this->set(compact('carbrands'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
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
			
			if($this->Auth->user('isAdmin'))
			{
				$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $id));
				$this->request->data = $this->Carmodel->find('first', $options);
			}
			else
			{
				$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $id, 'Carbrand.user_id' => $this->Auth->user('id')));
				$data = $this->Carmodel->find('first', $options);
				if(count($data) > 0)
					$this->request->data = $data;
				else
					$this->redirect('index');
			}
		}

		$conditions = array();
		if(!$this->Auth->user('isAdmin'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}
		$carbrands = $this->Carmodel->Carbrand->find('list', array('conditions' => $conditions));
		$this->set(compact('carbrands'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Carmodel->id = $id;
		if (!$this->Carmodel->exists()) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		$deleteFlag = true;
		if(!$this->Auth->user('isAdmin'))
		{
			$res = $this->Carmodel->find('first', array('conditions' => array('Carmodel.id' => $id, 'Carbrand.user_id' => $this->Auth->user('id'))));
			if(empty($res))
				$deleteFlag = false;
		}

		if($deleteFlag)
		{
			$this->request->onlyAllow('post', 'delete');
			if ($this->Carmodel->delete()) {
				$this->Session->setFlash(__('The carmodel has been deleted.'));
			} else {
				$this->Session->setFlash(__('The carmodel could not be deleted. Please, try again.'));
			}
		}
		else
		{
			$this->Session->setFlash(__('The carmodel could not be deleted.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
