<?php
class DomainController extends AppController {
   var $name = 'Domain';
   var $scaffold;
   
   function system_index()
   {
   	echo "<pre>";
   	print_r($this->Domain->findAll());
   	die("</pre>");
   }
   
   
}
?>