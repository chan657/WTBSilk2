<?php

App::uses('AppModel', 'Model');

class BuilderAgreement extends AppModel {

    public $name = 'BuilderAgreement';
 /*
	
	public $hasAndBelongsToMany = array(
    'Project' =>
        array(
            'className' => 'Project',
            'joinTable' => 'project_agreements',
            'foreignKey' => 'project_agreement_builder_agreement_id',
            'associationForeignKey' => 'project_agreement_project_id',
            'unique' => true,
        )
);				

    
   
    public $hasMany = array(
			    'Amenity' => array(
				    'className' => 'Amenity',
				    'foreignKey'   => false,
				    'conditions' => 'Project.id = Amenity.project_id',
			    ),
				
			   );
			   */
    /*
    public $hasOne = 'Amenity';
    public $hasMany = array(
        'Amenity' => array(
            'className' => 'Amenity',
            'foreignKey' => 'project_id',
            'dependent' => false
        )
    );
    */    

}

?>