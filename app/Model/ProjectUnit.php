<?php

App::uses('AppModel', 'Model');

class ProjectUnit extends AppModel {

    public $name = 'ProjectUnit';
    /* 		public $validate = array(
      'unit_name' => array(
      'required' => array(
      'rule' => array('notEmpty'),
      'message' => 'please provide a unit name'
      )
      ),

      ); */
    public $belongsTo = array(
        'UnitType' => array(
            'className' => 'LookupValueProjectUnitPreference',
            'foreignKey' => 'unit_type'
        ),
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id'
        ),
        'FirstAttach' => array(
            'className' => 'LookupValueProjectAttache',
            'foreignKey' => 'unit_downpayment_attached_to_construction'
        ),
        'SecondAttach' => array(
            'className' => 'LookupValueProjectAttache',
            'foreignKey' => 'unit_second_payment_attached_to_construction'
        ),
        'ThirdAttach' => array(
            'className' => 'LookupValueProjectAttache',
            'foreignKey' => 'unit_third_payment_attached_to_construction'
        ),
        'CommissionBasedOn' => array(
            'className' => 'LookupUnitCommissionBasedOn',
            'foreignKey' => 'unit_commission_based_on'
        ),
        'CommissionEvent' => array(
            'className' => 'LookupUnitCommissionEvent',
            'foreignKey' => 'unit_commission_event'
        ),
        'ProjectCity' => array(
            'fields' => array('city_name'),
            'className' => 'City',
            'foreignKey' => false,
            'conditions' => 'Project.city_id = ProjectCity.id'
        ),
        'ProjectSuburb' => array(
            'fields' => array('suburb_name'),
            'className' => 'Suburb',
            'foreignKey' => false,
            'conditions' => 'Project.suburb_id = ProjectSuburb.id'
        ),
        'ProjectArea' => array(
            'fields' => array('area_name'),
            'className' => 'Area',
            'foreignKey' => false,
            'conditions' => 'Project.area_id = ProjectArea.id'
        ),
    );

}

?>