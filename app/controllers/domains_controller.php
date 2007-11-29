<?php
class DomainsController extends AppController {
   var $name = 'Domains';
//   var $uses = array('Client', 'Address');
//   var $scaffold;
   
   function system_index()
   {
   	$this->set('client_data', $this->Client->findAll());
//   	echo "<pre>";
//   	print_r($this->Client->findAll());
//   	die("</pre>");
   }
   
   function system_prospects()
   {
   	die("Loaded'");
   }
   
   function system_add()
   {
   	
   }
}
?>