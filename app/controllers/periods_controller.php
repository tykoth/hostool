<?php
class PeriodsController extends AppController {
   var $name = 'Periods';
   
   function system_index()
   {
   	$this->set('periods', $this->Period->findAll());
   	$this->render("system_index");
   }
   
   /**
    * Simplesmente adiciona um novo período
    *
    */
   function system_add()
   {
   	if(!empty($this->data))
   	{
   		$this->Period->save($this->data);
		$this->system_index();
   	}
   }
   
   function system_edit($id = null)
   {
   	if($id !== null && empty($this->data))
   	{
   		$this->Period->id = $id;
   		$this->set('period', $this->Period->read());
   	}
   	else
   	{
   		$this->system_index();
   	}
   	
   }
   function system_del($id = null)
   {
   	if($id !== null && empty($this->data))
   	{
   		$this->Period->id = $id;
   		$this->Period->del();
   	}
   	else 
   	{
   		foreach($this->data as $data)
   		{
   			$this->Period->id = $data['Period']['id'];
   			$this->Period->del();
   		}
   	}
   	$this->system_index();
   }
   
   
}
?>