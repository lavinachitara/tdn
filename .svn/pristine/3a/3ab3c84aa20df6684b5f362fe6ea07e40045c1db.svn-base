<?php
App::uses('AppController', 'Controller');
/**
 * Cars Controller
 *
 * @property Car $Car
 * @property PaginatorComponent $Paginator
 */
class CarsController extends AppController {

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
				if($action != 'index' && in_array($action,$deny_user_action))
				{
					$this->redirect('index');
				}
			}
		}
	}

	/**
	 * lists method
	 *
	 * @return void
	 */
	public function lists() {
		$this->layout = 'front';
		$this->Car->recursive = 0;
		$this->set('cars', $this->Paginator->paginate());
	}

	/**
	 * landingpage method
	 *
	 * @return void
	 */
	public function landingpage($id) {
		if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}
		
		if ($this->request->is('post')) {
			$this->loadModel('Testdrive');
			$data = $this->request->data;
			$data['Testdrive']['car_id'] = $id; 
		
			$this->Testdrive->create();
			if ($this->Testdrive->save($data)) {
				$this->redirect('thankyou');
			} else {
				$this->set('ses_message', 'The request could not be completed. Please, try again.');
			}
		}
		else
		{
			$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
			$this->set('car', $this->Car->find('first', $options));
		}
	}

	/**
	 * thankyou method
	 *
	 * @return void
	 */
	public function thankyou() {
		
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Car->recursive = 0;
		$this->set('cars', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}
		$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
		$this->set('car', $this->Car->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Car->create();
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		}
		
		$carbrands = $this->Car->Carbrand->find('list');
		
		$carmodels = array();

		if(count($carbrands) > 0)
		{
			foreach($carbrands as $cb_id=>$name)
			{
				$carmodels = $this->Car->Carmodel->find('list', array('conditions' => array('carbrand_id' => $cb_id)));
				break;
			}
		}
		
		$this->set(compact('carbrands', 'carmodels'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Car->exists($id)) {
			throw new NotFoundException(__('Invalid car'));
		}

		$options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
		$car = $this->Car->find('first', $options);
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Car->save($this->request->data)) {
				$this->Session->setFlash(__('The car has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $car;
		}
		
		$carbrands = $this->Car->Carbrand->find('list');
		
		$cb_id = $car['Carbrand']['id'];
		$carmodels = $this->Car->Carmodel->find('list', array('conditions' => array('carbrand_id' => $cb_id)));

		$this->set(compact('carbrands', 'carmodels'));
		
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Car->delete()) {
			$this->Session->setFlash(__('The car has been deleted.'));
		} else {
			$this->Session->setFlash(__('The car could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
