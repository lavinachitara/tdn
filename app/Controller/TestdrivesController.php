<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Testdrives Controller
 *
 * @property Testdrive $Testdrive
 * @property PaginatorComponent $Paginator
 */
class TestdrivesController extends AppController {

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
	 /*
	public function beforeFilter() {
		parent::beforeFilter();
		
		if($this->Auth->loggedIn()){
			if(!$this->Auth->user('isAdmin') && !$this->Auth->user('isDealer'))
			{
				$deny_user_action = Configure::read('deny_user_action'); 
				$action = strtolower($this->request->action);	
				if(in_array($action,$deny_user_action))
				{
					$this->redirect('listrequests');
				}
			}
		}
	}
	*/
	
	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Testdrive->recursive = 0;
		$this->set('testdrives', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Testdrive->exists($id)) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		$options = array('conditions' => array('Testdrive.' . $this->Testdrive->primaryKey => $id));
		$this->set('testdrive', $this->Testdrive->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Testdrive->create();
			if ($this->Testdrive->save($this->request->data)) {
				$this->Session->setFlash(__('The testdrive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testdrive could not be saved. Please, try again.'));
			}
		}
		$carmodels = $this->Testdrive->Carmodel->find('list');
		$users = $this->Testdrive->User->find('list');
		$this->set(compact('carmodels', 'users'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Testdrive->exists($id)) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Testdrive->save($this->request->data)) {
				$this->Session->setFlash(__('The testdrive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testdrive could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Testdrive.' . $this->Testdrive->primaryKey => $id));
			$this->request->data = $this->Testdrive->find('first', $options);
		}
		$carmodels = $this->Testdrive->Carmodel->find('list');
		$users = $this->Testdrive->User->find('list');
		$this->set(compact('carmodels', 'users'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Testdrive->id = $id;
		if (!$this->Testdrive->exists()) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Testdrive->delete()) {
			$this->Session->setFlash(__('The testdrive has been deleted.'));
		} else {
			$this->Session->setFlash(__('The testdrive could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	/**
	 * _getlatlong method
	 * getting lattitude and logitude
	 * @param string $city
	 * @return $lat, $long
	 */
	public function _getlatlong($city) {
		$geocode_stats = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=". $city ."&sensor=false");

$output_deals = json_decode($geocode_stats);
// print_r($output_deals);die;
$latLng = $output_deals->results[0]->geometry->location;
return $latLng;
// $lat = $latLng['lat'];
// $lng = $latLng['lng'];	
	}

	/**
	 * confirmation method
	 * show city
	 * @return void
	 */
	public function confirmation() {

		$city = $this->Session->read('getCity');
		$contact_no = $this->Session->read('user_contact_no');
		if($city != '' )
		{
			$this->set('city', $city);
			$this->set('contact_no', $contact_no);
		}
	}


	
	/**
	 * findCity method
	 * show city
	 * @return string city
	 */
	public function _findCity($phoneno) {

		$userName = Configure::read('user_name');
		$userPassword = Configure::read('user_password'); 
		$api_url =  Configure::read('api_1881_url');
		$api_url .= 'userName='. $userName . '&password=' . $userPassword;
		$api_url .= '&msisdn=' . $phoneno .'&level=1&phone='. $phoneno . '&pageSize=25&format=json';
		// echo $api_url . "<br>";
		// echo $url = "https://api.1881bedrift.no/search/search?userName=Thomasmoen&password=hov2tho3&msisdn=90624567&level=1&phone=90624567&pageSize=25&format=json";exit();

		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);

		// Will dump a beauty json :3
		$api_data = json_decode($result, true);
		//echo "<pre>";
		//print_r($api_data);
		//exit;
		$city = '';
		if(isset($api_data) && isset($api_data['Results']) && count($api_data['Results']) > 0)
		{
			$city = $api_data['Results'][0]['Addresses'][0]['City'];
		}
		return $city;
	}	

	/**
	 * landingpage method
	 *
	 * @return void
	 */
	public function landingpage($user_id, $model_id) {

		$this->layout = 'front';
		
		if (!$this->Testdrive->Carmodel->exists($model_id)) {
			throw new NotFoundException(__('Invalid carmodel'));
		}
		
		if ($this->request->is('post')) {
			
			$data = $this->request->data;
			
			//$data['Testdrive']['testdrivedate'] = DboSource::expression('NOW()');
			$data['Testdrive']['testdrivedate'] = date("Y-m-d", strtotime($data['Testdrive']['testdrivedate']));

			//echo '<pre>'; print_r($data); exit;
			$data['Testdrive']['carmodel_id'] = $model_id; 
			$data['Testdrive']['user_id'] = $user_id;
			//$data['Testdrive'][]
		
			if(isset($data['Testdrive']['customer_contact']) && $data['Testdrive']['customer_contact'] != '')
			{
				$contact_no = $data['Testdrive']['customer_contact'];

				$city = $this->_findCity($contact_no);
				
				if($city != '')
				{
					$this->Session->write('getCity', $city);

					$this->Session->write('user_contact_no', $contact_no);

					$this->Session->write('carmodel_id', $model_id);

					$this->Session->write('testdrivedate', date("Y-m-d", strtotime($data['Testdrive']['testdrivedate'])));

					$this->Session->write('user_id', $user_id);


					$this->redirect('confirmation');
				}	
				else
				{
					$this->Session->setFlash(__('Please, try by different contact number.'));
				}
				
				/*
				$this->Testdrive->create();
				if ($this->Testdrive->save($data)) {
					
					$dealerinfo = $this->Testdrive->Carmodel->find('first', array(
						'contain' => array(
							'Carbrand.User' => array(
								'conditions' => array('isDealer' => 1),
								'fields' => array('name', 'email')
							),
						),
						'conditions' => array('Carmodel.id' => $model_id),
					)); 
					
					if(count($dealerinfo) > 0)
					{
						$to_email = $dealerinfo['Carbrand']['User']['email'];
						$brand = $dealerinfo['Carbrand']['brandname'];
						$model = $dealerinfo['Carmodel']['modelname'];

						if($to_email != '' && $brand != '' && $model != '')
						{
							$Email = new CakeEmail('smtp');
							$Email->emailFormat('html');
							$Email->template('testdriverequest');
							$Email->viewVars(array('brand' => $brand, 'model' => $model, 'number' => $contact_no));
							$Email->to($to_email);
							$Email->subject('Request for test drive');
							//$message = "Hello, <br/> One test drive request from customer, <b>contact number:".$contact_no."</b>";
							$Email->send();

							$this->Session->write('SentMailStatus', true);
						}
					}
					
					$this->redirect('thankyou');
				}
				else {
					$this->set(__('The request could not be completed. Please, try again.'));
				}
				*/
			}
			else {
				$this->set(__('The request could not be completed. Please, try again.'));
			}
		}
		else
		{
			$this->Session->write('SentMailStatus', false);
			/*
			$options = array('conditions' => array('Carmodel.' . $this->Carmodel->primaryKey => $model_id));
			$this->set('carmodel', $this->Carmodel->find('first', $options));
			*/
		}
	}
	
	/**
	 * thankyou method
	 *
	 * @return void
	 */
	public function thankyou() {

		$city = $this->Session->read('getCity');

		$contact_no = $this->Session->read('user_contact_no');

		$model_id = $this->Session->read('carmodel_id');

		$testdrivedate = $this->Session->read('testdrivedate');

		$user_id = $this->Session->read('user_id');


		
		if(isset($city) && isset($contact_no) && isset($model_id) && isset($testdrivedate) && isset($user_id)){


			$cord = $this->_getlatlong($city);
			//print_r($cord); exit;
			$lat = $cord->lat; 
			$lng = $cord->lng;

			$data['Testdrive'] =  array('customer_city' => $city, 'user_id' => $user_id , 'testdrivedate' => $testdrivedate, 'carmodel_id' => $model_id , 'lat' => $lat , 'long' => $lng);
			$this->Testdrive->create();
				if ($this->Testdrive->save($data)) {
					
					$dealerinfo = $this->Testdrive->Carmodel->find('first', array(
						'contain' => array(
							'Carbrand.User' => array(
								'conditions' => array('isDealer' => 1),
								'fields' => array('name', 'email')
							),
						),
						'conditions' => array('Carmodel.id' => $model_id),
					)); 
					
					if(count($dealerinfo) > 0)
					{
						$to_email = $dealerinfo['Carbrand']['User']['email'];
						$brand = $dealerinfo['Carbrand']['brandname'];
						$model = $dealerinfo['Carmodel']['modelname'];

						if($to_email != '' && $brand != '' && $model != '')
						{
							$Email = new CakeEmail('smtp');
							$Email->emailFormat('html');
							$Email->template('testdriverequest');
							$Email->viewVars(array('brand' => $brand, 'model' => $model, 'number' => $contact_no));
							$Email->to($to_email);
							$Email->subject('Request for test drive');
							//$message = "Hello, <br/> One test drive request from customer, <b>contact number:".$contact_no."</b>";
							$Email->send();

							$this->Session->write('SentMailStatus', true);
						}
					}
					
					//$this->redirect('thankyou');
				}
				else {
					$this->set(__('The request could not be completed. Please, try again.'));
				}
		}

		$SentMailStatus = $this->Session->read('SentMailStatus');
		$this->layout = 'front';

		if($SentMailStatus)
		{
			$message = 'Your test drive request has been submitted.';
			$title = 'Thank you';
		}
		else
		{
			$message = 'Sorry!!! Please request for test drive.';
			$title = '';
		}
		
		$this->Session->write('SentMailStatus', false);

		$this->set(compact('message', 'title'));
	}

	/**
	 * admin_setstatus method
	 * @param Integer $id [testdrive id]
	 * @param Boolean $status [0/1]
	 * @param String $flag ['scheduled'/'bought']
	 * @return void
	 */
	public function admin_setstatus($id, $status=0, $flag) {
		
		if(!$this->Auth->user('isDealer'))
			$this->redirect('index');

		$this->Testdrive->id = $id;
		
		if (!$this->Testdrive->exists()) {
			throw new NotFoundException(__('Invalid Access!'));
		}
			
		$carmodel_id = $this->Testdrive->field('carmodel_id');
		$requestfordriverexists = $this->Testdrive->Carmodel->find('count', array(
			'recursive' => 0,
			'conditions' => array(
				'Carbrand.user_id' => $this->Auth->user('id'),
				'Carmodel.id' => $carmodel_id
			)
		));
		
		if(!$requestfordriverexists)
			throw new NotFoundException(__('Invalid Access!'));

		$options = array('Testdrive.' . $this->Testdrive->primaryKey => $id);
		
		$updateField = array();
		if($flag == 'scheduled')
		{
			$updateField = array('Testdrive.scheduled' => $status);

			if($status)
				$msg = "The test drive request has been scheduled";
			else
				$msg = "The test drive request has not been scheduled";
		}
		else if($flag == 'bought')
		{
			$updateField = array('Testdrive.bought' => $status);

			if($status)
				$msg = "The test drive request has been bought";
			else
				$msg = "The test drive request has not been bought";
		}
		
		if($this->Testdrive->updateAll($updateField, $options))
		{
			$this->Session->setFlash(__($msg));
		}
		else {
			$this->Session->setFlash(__('Please, try again.'));
		}
		
		return $this->redirect(array('action' => 'index'));
	}
		
	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		
		if(!$this->Auth->user('isDealer') && !$this->Auth->user('isAdmin') )
			$this->redirect('listrequests');
		
		$dconditions = array();

		$this->loadmodel('Carbrand');
		
		$alreadySet = false;
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			
			if(isset($data['Testdrive']['carbrand_id']) && $data['Testdrive']['carbrand_id'] != 0)
			{
				$dconditions['Carmodel.carbrand_id'] = $data['Testdrive']['carbrand_id'];
				$alreadySet = true;
			}
		}

		$conditions = array();
		if($this->Auth->user('isDealer'))
		{
			$conditions = array('Carbrand.user_id' => $this->Auth->user('id'));
		}

		$carbrands = $this->Carbrand->find('list', array('conditions' => $conditions));
		
		$this->set('carbrands', $carbrands);
		
		if(!$alreadySet)
		{
			$dealer_brand_ids = array_keys($carbrands); 
			$d_in = "";
			if(!empty($dealer_brand_ids))
			{
				if(count($dealer_brand_ids) > 1)
					$d_in = " IN ";
			}
			
			$dconditions['Carmodel.carbrand_id '.$d_in] = $dealer_brand_ids;
		}
		//echo '<pre>'; print_r($dconditions); exit;
		
		$this->Testdrive->contain(array('Carmodel.Carbrand', 'User'));
		
		$this->set('testdrives', $this->Testdrive->find('all', array('conditions' => $dconditions)));

	}

	/**
	 * ajaxtestdriverequests method
	 *
	 * @return void	
	 */
	public function ajaxtestdriverequests() {
		
		$this->layout = false;
		
		$conditions = array();

		if($this->request->is('ajax')){
			$data = $this->request->data;
			$base = $data['base'];
			
			//echo '<pre>'; print_r($data['from_date']); exit;
			
			if(isset($data['from_date']) && $data['from_date'] != '' && isset($data['to_date']) && $data['to_date'] != '' )
			{
				$conditions['AND'] = array(
					'Testdrive.testdrivedate >= ' => date('Y-m-d', strtotime($data['from_date'])),
                    'Testdrive.testdrivedate <= ' => date('Y-m-d', strtotime($data['to_date']))
                );
			}
			else if(isset($data['from_date']) && $data['from_date'] != ''){
				$conditions['Testdrive.testdrivedate'] = date('Y-m-d', strtotime($data['from_date']));
			}
			else if(isset($data['to_date']) && $data['to_date'] != ''){
				$conditions['Testdrive.testdrivedate'] = date('Y-m-d', strtotime($data['to_date']));
			}

			$sel_carmodels = array();
			if(isset($data['carmodel_ids']))
			{
				$carmodel_ids = $data['carmodel_ids'];
				$len = count($carmodel_ids);
				$cm_in = "";
				if($len > 0)
				{
					if($len > 1)
						$cm_in = "IN";
					
					$conditions['Testdrive.carmodel_id '.$cm_in] = $carmodel_ids;
				}

				$this->loadModel('Carmodel');
				$sel_carmodels = $this->Carmodel->find('list', array('conditions' => array('Carmodel.id' => $carmodel_ids)));
			}
			
			$options['recursive'] = -1;
			$options['conditions'] = $conditions;
			
			$group = array();
			if($base == 'day')
			{
				$options['group'] = array('Testdrive.carmodel_id', 'Testdrive.testdrivedate');
				$options['fields'] = array('count(carmodel_id) as totalrequests', 'Testdrive.*');
			}
			else if($base == 'month')
			{
				$options['group'] = array('Testdrive.carmodel_id', 'MONTH(Testdrive.testdrivedate)');
				$options['fields'] = array('count(carmodel_id) as totalrequests', 'MONTHNAME(Testdrive.testdrivedate) as monthName', 'Testdrive.*');
			}
			else if($base == 'year')
			{
				$options['group'] = array('Testdrive.carmodel_id', 'YEAR(Testdrive.testdrivedate)');
				$options['fields'] = array('count(carmodel_id) as totalrequests', 'YEAR(Testdrive.testdrivedate) as reqyear', 'Testdrive.*');
			}
			//echo '<pre>'; print_r($options); exit;
			$testdrive_req = $this->Testdrive->find('all', $options);
			//echo '<pre>'; print_r($testdrive_req); exit;
			$req_res = array();
			//first array is for carmodel id with name
			
			$xAixs = array();
			
			if($base == 'day')
			{
				$xAixsArr = array();
				foreach($testdrive_req as $req)
				{
					$req_res[$req['Testdrive']['carmodel_id']][$req['Testdrive']['testdrivedate']] = $req[0]['totalrequests'];
					array_push($xAixsArr,$req['Testdrive']['testdrivedate']);
				}
				
				$xAixs = array_unique($xAixsArr);
			}
			else if($base == 'month')
			{
				foreach($testdrive_req as $req)
				{
					$req_res[$req['Testdrive']['carmodel_id']][$req[0]['monthName']] = $req[0]['totalrequests'];
				}
			}
			else if($base == 'year')
			{
				$xAixsArr = array();
				foreach($testdrive_req as $req)
				{
					$req_res[$req['Testdrive']['carmodel_id']][$req[0]['reqyear']] = $req[0]['totalrequests'];
					array_push($xAixsArr,$req[0]['reqyear']);
				}
				$xAixs = array_unique($xAixsArr);
			}

			$res = array('carmodels' => $sel_carmodels, 'seriesdata' => $req_res, 'xAixs' => $xAixs);
			//echo '<pre>'; print_r($res); exit;
			echo json_encode($res);
			exit;
		}
	}

	public function admin_listrequests() {

		if($this->Auth->user('isDealer') || $this->Auth->user('isAdmin') )
			$this->redirect('index');

		$dconditions['Testdrive.user_id'] = $this->Auth->user('id');
		
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			
			if(isset($data['Testdrive']['carbrand_id']) && $data['Testdrive']['carbrand_id'] != 0)
			{
				$dconditions['Carmodel.carbrand_id'] = $data['Testdrive']['carbrand_id'];
			}
		}

		//$this->Testdrive->contain(array('Carmodel.Carbrand', 'User'));
		
		$options = array(
			'contain' => array('Carmodel.Carbrand', 'User'),
			'conditions' => $dconditions,
			'group' => 'Carmodel.id',
			'fields' => array('count(Carmodel.id) as totalrequests', 'Testdrive.*', 'Carmodel.*', 'User.*')
			//'fields' => array('Testdrive.id', 'Testdrive.customer_contact', 'Carmodel.modelname', 'User.name', 'count(Carmodel.id)')
		);
		//echo '<pre>'; print_r($options); exit;
		
		$this->set('testdrives', $this->Testdrive->find('all', $options));

		$this->loadModel('Carbrand');
		
		$carbrand_arr = $this->Carbrand->find('list');
		
		$this->set('carbrands', $carbrand_arr);
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->Testdrive->exists($id)) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		$options = array('conditions' => array('Testdrive.' . $this->Testdrive->primaryKey => $id));
		$this->set('testdrive', $this->Testdrive->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	 /*
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Testdrive->create();
			if ($this->Testdrive->save($this->request->data)) {
				$this->Session->setFlash(__('The testdrive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testdrive could not be saved. Please, try again.'));
			}
		}
		$carmodels = $this->Testdrive->Carmodel->find('list');
		$users = $this->Testdrive->User->find('list');
		$this->set(compact('carmodels', 'users'));
	}
	*/

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	 /*
	public function admin_edit($id = null) {
		if (!$this->Testdrive->exists($id)) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Testdrive->save($this->request->data)) {
				$this->Session->setFlash(__('The testdrive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testdrive could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Testdrive.' . $this->Testdrive->primaryKey => $id));
			$this->request->data = $this->Testdrive->find('first', $options);
		}
		$carmodels = $this->Testdrive->Carmodel->find('list');
		$users = $this->Testdrive->User->find('list');
		$this->set(compact('carmodels', 'users'));
	}
	*/

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Testdrive->id = $id;
		if (!$this->Testdrive->exists()) {
			throw new NotFoundException(__('Invalid testdrive'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Testdrive->delete()) {
			$this->Session->setFlash(__('The testdrive has been deleted.'));
		} else {
			$this->Session->setFlash(__('The testdrive could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
