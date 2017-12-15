<?php
	App::uses('AppModel', 'Model');
	
	class ChannelRole extends AppModel 
	{
		public $name = 'ChannelRole';
		/*public $validate = array(
			'channel_name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'please provide a name'
				)
			),
			
			'channel_city' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'value required'
				)
			),
			'channel_head' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'value required'
				)
			),

		);*/
		
		/*public $belongsTo = array(
			'City' => array(
			'className'    => 'City',
			'foreignKey'   => 'city_id'
			),
			
			'User' => array(
			'className'    => 'User',
			'foreignKey'   => 'channel_head'
		)
	);*/

		
	}
?>