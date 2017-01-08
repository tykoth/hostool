<?php
class Client extends AppModel {
	var $name = 'Client';

	/**
	 * Indica��o de hasMany
	 */
	var $hasMany = array(
		/* Um 'client' possui v�rios dom�nios */
		'Domain' =>
		array(
			'className'    => 'Domain',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),
		
		/* Um 'client' possui v�rios endere�os */
		'Address' =>
		array(
			'className'    => 'Address',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
		
		/* Um 'client' possui v�rios emails */
		'Email' =>
		array(
			'className'    => 'Email',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
		
		/* Um 'client' possui v�rios telefones */
		'Phone' =>
		array(
			'className'    => 'Phone',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
	);
	
	/**
	 * Indica��o de hasOne
	 */
	var $hasOne = array(
		/* Um 'client' possui v�rios endere�os */
		'User' =>
		array(
			'className'    => 'User',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
		/* Um 'client' possui um email principal */
		'Email' =>
		array(
			'className'    => 'Email',
			'conditions'   => 'email_order = 1',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
	);
}
?>