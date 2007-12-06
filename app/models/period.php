<?php
class Period extends AppModel {
   var $name = 'Period';
   
   function afterFind($results)
   {
   	/**
   	 * Este foreach faz com que o $period_type seja substituido pelo seu label corrente.
   	 */
   	foreach ($results as $key => $val) 
   	{
   		switch($results[$key]['Period']['period_type'])
   		{
   			case 1:
   					$period_type_label = "Dia(s)"; 
   					$period_type_string = "day"; 
   			break;
   			case 2:
   					$period_type_label = "Semana(s)"; 
   					$period_type_string = "week"; 
   			break;
   			case 3:
   					$period_type_label = "Mes(es)"; 
   					$period_type_string = "month"; 
   			break;
   			case 4:
   					$period_type_label = "Ano(s)"; 
   					$period_type_string = "year"; 
   			break;
   		}
   		$results[$key]['Period']['period_type_label'] = $period_type_label;   		
   		$results[$key]['Period']['period_type_string'] = $period_type_string;   		
   	}
   	return $results;
   }
}
?>