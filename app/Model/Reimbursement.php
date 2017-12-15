<?php
/*
 * Model/Event.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
 App::uses('AppModel', 'Model');
class Reimbursement extends Model {
	var $name = 'Reimbursement';
	//var $displayField = 'description';
	var $validate = array();
	
	public $belongsTo = array(
	
		'Activity' => array(
					'className' => 'Event',
					'foreignKey' => 'reimbursement_event_id'
				  ),
		'ExpenseDetails' =>  array(
						'className'    => 'LookupValueActivityDetail',
						'foreignKey' => false,
						'conditions' => 'Activity.event_type_desc = ExpenseDetails.id',	
				),	
		'ProjectSite' =>  array(
						'fields' => array('project_name'),
						'className'    => 'Project',
						'foreignKey' => false,
						'conditions' => 'Activity.site_visit_project_id = ProjectSite.id',	
				),				  
	  	'SubmittedBy' => array(
					'fields' => array('fname','mname','lname'),
					'className' => 'User',
					'foreignKey' => 'created_by'
				  ),	  	  
		'Level' => array(
					'className'    => 'LookupValueActivityLevel',
					'foreignKey' => 'reimbursement_level',
					
				  ),

		'Type' => array(
					'className' => 'LookupValueReimbursementType_1',
					'foreignKey' => 'reimbursement_type_1'
				  ),
		'For' => array(
					'className' => 'LookupValueReimbursementType_2',
					'foreignKey' => 'reimbursement_type_2'
				  ),		  		  		  		  		  		  		  		  		  		  
	
	);

}
?>
