<?php
class ClientsController extends AppController {
	var $name = 'Clients';
	var $uses = array('Client', 'Address', 'Email', 'Phone', 'User', 'Domain');
	
	var $helpers = array('Html','Javascript','Ajax','Pagination');
	var $components = array('Pagination');

	function system_index()
	{
		$criteria = null;
		list($order, $limit, $page) = $this->Pagination->init($criteria, null, array('show' => 10));
		$this->set('client_data', $this->Client->findAll($criteria, NULL, $order, $limit, $page));
		
		/*
		$criteria="WHERE user_id = ".$this->Session->read("User");
	list($order,$limit,$page) = $this->Pagination->init($criteria);
	$profiles = $this->Profile->findAll($criteria, NULL, $order, $limit, $page);
	$this->set('profiles', $profiles);
	*/
		//   	echo "<pre>";
//		print_r($this->Client->findAll());
		//   	die("</pre>");
	}

	function system_prospects()
	{
		die("Loaded'");
	}

	function system_add()
	{
		if(!empty($this->data['Client']) && !empty($this->data['User'])) {
			// Tratar dados antes de inserir.
			$this->data['Client']['birthdate'] = datetosql($this->data['Client']['birthdate']);
			
		
//			die($this->data['Client']['birthdate']);
//			$this->Client->Address->multisave(); exit;
			if ($this->Client->save($this->data))
			{
				// Saves multiplos (hasMany)
				$this->Client->Address->multisave($this->data, 'client_id', $this->Client->id);
				$this->Client->Email->multisave($this->data, 'client_id', $this->Client->id);
				$this->Client->Phone->multisave($this->data, 'client_id', $this->Client->id);
				
				// Save unico (hasOne)
				$this->data['User']['client_id'] = $this->Client->id;
				$this->Client->User->save($this->data['User']);
				
//				if($this->Client->Address->save($this->data['Address']));
//				$this->User->client_id = $this->Address->client_id = 
//				$this->Email->client_id = $this->Phone->client_id = $this->Client->id;
//				if(
//					$this->User->save($this->data) && 
//					$this->Address->save($this->data) && 
//					$this->Email->save($this->data) && 
//					$this->Phone->save($this->data)					
//				)
				
				
				$this->Session->setFlash('Adicionado com sucesso');
			}
//			echo "\nDepois de salvar:" . $this->Client->id;
			exit;
		}
	}
	function system_add_email()
	{
		if(!empty($this->data['Email']))
		{
			
		}
	}


}
?>