<?php
class Address extends AppModel {
	var $name = 'Address';
	
	var $belongsTo = array(
		'Client' =>
		array(
			'className'    => 'Client',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		)
	);   
}
?>