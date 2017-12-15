<?php

App::uses('AppModel', 'Model');

class Project extends AppModel {
    
    public $name = 'Project';
    public $validate = array(
        'project_name' => array(
            'Rule1' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter project name'
            ),
            'Rule2' => array(
                'rule' => 'isUnique',
                'message' => 'Project name already exists',
                'on' => 'create'
            ),
        ),
        'city_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide city name'
            )
        ),
        'builder_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide builder name'
            )
        ),
    );
    public $belongsTo = array(
        'Suburb' => array(
            'className' => 'Suburb',
            'foreignKey' => 'suburb_id'
        ),
        'Builder' => array(
            'className' => 'Builder',
            'foreignKey' => 'builder_id'
        ),
        'SecondaryBuilder' => array(
            'className' => 'Builder',
            'fields' => array('builder_name'),
            'foreignKey' => 'secondary_builder_id'
        ),
        'TertiaryBuilder' => array(
            'className' => 'Builder',
            'fields' => array('builder_name'),
            'foreignKey' => 'tertiary_builder_id'
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id'
        ),
        'Area' => array(
            'className' => 'Area',
            'foreignKey' => 'area_id'
        ),
        'Type' => array(
            'className' => 'ProjectType',
            'foreignKey' => 'type_id'
        ),
        'Phase' => array(
            'className' => 'Phase',
            'foreignKey' => 'phase_id'
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'Quality' => array(
            'className' => 'Quality',
            'foreignKey' => 'quality_id'
        ),
        'ConstructionStatus' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'construction_status'
        ),
        'FinanceStatus' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'bank_finance_status'
        ),
        'Marketing' => array(
            'className' => 'Marketing',
            'foreignKey' => 'marketing_id'
        ),
        'LookupValueStatus' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'proj_status'
        ),
        'Residetal' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'proj_residential'
        ),
        'Commercial' => array(
            'className' => 'LookupValueStatus',
            'foreignKey' => 'proj_commercial'
        ),
    );
    public $hasMany = array(
        'ProjectAgreement' => array(
            'className' => 'ProjectAgreement',
            'foreignKey' => 'project_agreement_project_id',
        ),
        'ProjectContact' => array(
            'className' => 'ProjectContact',
            'foreignKey' => 'project_contact_project_id',
            'conditions' => array('ProjectContact.project_contact_status' => '1')
        ),
        'ProjectUnit' => array(
            'className' => 'ProjectUnit',
            'foreignKey' => 'project_id',
            'conditions' => array('ProjectUnit.unit_status' => '1')
        ),
    );

    /*
      public $hasAndBelongsToMany = array(
      'BuilderAgreement' =>
      array(
      'className' => 'BuilderAgreement',
      'joinTable' => 'project_agreements',
      'foreignKey' => 'project_agreement_project_id',
      'associationForeignKey' => 'project_agreement_builder_agreement_id',
      'unique' => true,
      )
      );




     */
}

?>