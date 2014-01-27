<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
					$this->redirect('mysettings');
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
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {

			$params = array('User.username' => $this->request->data['User']['username']);

			if($this->User->isUnique($params))
			{
				if (!empty($this->request->data['User']['password'])) {

					$this->User->create();
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('The user has been saved.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
					}
				}
				else{
					$this->Session->setFlash(__('Please enter password'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$params = array('User.username' => $this->request->data['User']['username']);

			if($this->User->isUnique($params, $id))
			{
				if($this->request->data['User']['password'] == '')
					unset($this->request->data['User']['password']);

				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	
	/**
	 * logout method
	 *
	 * @return void
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * admin_signup method
	 *
	 * @return void
	 */
	public function admin_signup() {

		$this->layout = 'signup';
		
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			$data['User']['isAdmin'] = 0;
			$data['User']['isDealer'] = 0;
			$data['User']['isActive'] = 0;

			$params = array('User.username' => $data['User']['username']);

			if($this->User->isUnique($params))
			{
				if (!empty($data['User']['password'])) {

					$this->User->create();
					if ($this->User->save($data)) {
						$this->Session->setFlash(__('Registration successful.'));
						return $this->redirect(array('action' => 'login'));
					} else {
						$this->Session->setFlash(__('Registration unsuccessful. Please, try again.'));
					}
				}
				else{
					$this->Session->setFlash(__('Please enter password'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
			}
		}
	}

	/**
	 * login method
	 *
	 * @return void
	 */
	public function admin_login() {

		$this->layout = 'login';
		
		if($this->request->is('post')){
			
			if($this->Auth->login()){

				//check for publisher is active or not
				if(!$this->Auth->user('isAdmin') && !$this->Auth->user('isDealer') && !$this->Auth->user('isActive'))
				{
					$this->Session->setFlash(__('Your account has not been activated.'));
					$this->admin_logout();
				}
				else
				{
					$this->redirect(array('controller' => 'carmodels'));
				}
				//echo $this->Auth->redirect();exit;
				//print_r($this->Auth->user('isAdmin'));exit;
				//$this->redirect($this->Auth->redirect());
				//$this->redirect('mysettings');
				
			}else{
				$this->Session->setFlash(__('Invalid username and password, try again'));
			}
		}
		else{
			if($this->Auth->loggedIn())
				$this->redirect('index');
		}
	}

	/**
	 * logout method
	 *
	 * @return void
	 */
	public function admin_logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * mysettings method
	 *
	 * @throws NotFoundException
	 * @param void
	 * @return void
	 */
    public function admin_mysettings() {
		
		/*
		Php mail functionality is working by below code
		http://blog.techwheels.net/send-email-from-localhost-wamp-server-using-sendmail/
		for using mail function of php we need to setup sendmail manually in windows
		*/
		/*
		$to = "lavina.chitara@pixelcrayons.com";
		$subject = "Test my mail";
		$message = "Hello! This is my simple email message.";
		$from = "lavina.chitara27@gmail.com";
		$headers = "From:" . $from;
		if(mail($to,$subject,$message,$headers))
			echo "Mail Sent.";
		else
			echo "Main not sent";
		exit;
		*/
		
		/*
		For below code no need of sendmail folder to be added in php.ini
		*/
		/* working
		$Email = new CakeEmail('smtp');
		$Email->to('lavina.chitara@pixelcrayons.com');
		$Email->subject('test213 subject');
		$Email->send('Test213 message');
		exit;
		*/

		if(!$this->Auth->loggedIn())
			$this->redirect('login');

		$id = $this->Auth->user('id');
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Don\'t have permission'));
		}

		$this->User->id = $id;
                
		if ($this->request->is(array('post', 'put'))) 
		{
                    
			$params = array('User.username' => $this->request->data['User']['username']);
			
			if($this->User->isUnique($params,$id))
			{
				if($this->request->data['User']['password'] == '')
					unset($this->request->data['User']['password']);

				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The profile settings have been saved.'));
				} 
				else 
				{
					$this->Session->setFlash(__('The profile settings could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
			}
        }

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->request->data =  $this->User->find('first', $options);
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->User->recursive = 0;

		$conditions = array('User.isDealer' => 1);

		$this->Paginator->settings = array(
			'limit' => 10
		);

		$this->set('users', $this->paginate('User',$conditions));
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id, 'User.isAdmin' => 0, 'User.isDealer' => 1));

		$user = $this->User->find('first', $options);
		
		if(empty($user))
			throw new NotFoundException(__('Invalid user'));

		$this->set('user', $user);
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			$data['User']['isAdmin'] = 0;
			$data['User']['isDealer'] = 1;

			$params = array('User.username' => $data['User']['username']);

			if($this->User->isUnique($params))
			{
				if (!empty($data['User']['password'])) {

					$this->User->create();
					if ($this->User->save($data)) {
						$this->Session->setFlash(__('The user has been saved.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
					}
				}
				else{
					$this->Session->setFlash(__('Please enter password'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
			}
		}

	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$data = $this->request->data;
			$data['User']['isAdmin'] = 0;
			$data['User']['isDealer'] = 1;

			$params = array('User.username' => $data['User']['username']);

			if($this->User->isUnique($params, $id))
			{
				if($data['User']['password'] == '')
					unset($data['User']['password']);

				if ($this->User->save($data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Session->setFlash(__('Username already exists. Please, try by different username.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id, 'User.isAdmin' => 0, 'User.isDealer' => 1));
			$user = $this->User->find('first', $options);

			if(empty($user))
				throw new NotFoundException(__('Invalid user'));

			$this->request->data = $user;
		}
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id, 'User.isAdmin' => 0, 'User.isDealer' => 1));
			
		$user = $this->User->find('first', $options);

		if(empty($user))
			throw new NotFoundException(__('Invalid user'));

		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
