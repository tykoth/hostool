<?php
class ProductsController extends AppController {
   var $name = 'Products';
   var $uses = array('Period');
   
   function system_index()
   {
   	
   }
   
   function system_add()
   {
   	
   }
   function system_get_pricings($pricing_type = 0)
   {
   	$this->set('pricing_type', $pricing_type);
   	if($pricing_type == 2)
   	{
   		$this->set('periods', $this->Period->findAll());
   	}
   }
}
?>