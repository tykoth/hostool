<?php
class Client extends AppModel {
	var $name = 'Client';

	/**
	 * Indicação de hasMany
	 */
	var $hasMany = array(
		/* Um 'client' possui vários domínios */
		'Domain' =>
		array(
			'className'    => 'Domain',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),
		
		/* Um 'client' possui vários endereços */
		'Address' =>
		array(
			'className'    => 'Address',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
		
		/* Um 'client' possui vários emails */
		'Email' =>
		array(
			'className'    => 'Email',
			'conditions'   => '',
			'order'        => '',
			'dependent'    =>  true,
			'foreignKey'   => 'client_id'
		),/**/
		
		/* Um 'client' possui vários telefones */
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
	 * Indicação de hasOne
	 */
	var $hasOne = array(
		/* Um 'client' possui vários endereços */
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