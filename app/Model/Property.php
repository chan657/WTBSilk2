<?php

App::uses('AppModel', 'Model');

class Property extends AppModel {

    public $name = 'Property';
    public $validate = array(

    );
    public $belongsTo = array(
         'Suburb' => array(
            'className' => 'Suburb',
            'foreignKey' => 'suburb_id'
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
            'className' => 'LookupPropType',
            'foreignKey' => 'prop_type'
        ),
        'Category' => array(
            'className' => 'LookupPropCategory',
            'foreignKey' => 'prop_category'
        ),
        'UnitType' => array(
            'className' => 'LookupValueProjectUnitPreference',
            'foreignKey' => 'prop_unit_type'
        ),
    );

}

?>