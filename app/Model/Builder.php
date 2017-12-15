<?php
	App::uses('AppModel', 'Model');
	
	class Builder extends AppModel {
		public $name = 'Builder';
		
		public $validate = array(
			'builder_name' => array(
				'Rule1' => array(
					'rule' => array('notempty'),
					'message' => 'Please enter builder name'
				),
				'Rule2' => array(
					'rule' => 'isUnique',
					'message' => 'Builder name already exists',
					'on' => 'create'
				),
			),
		
			'builder_primarycity' => array(
				'rule' => array('notempty'),								// Rule: notempty
				'message' => 'Primary city can not be blank',
			),
		
			'builder_highendresidential' => array(
				'rule' => array('notempty'),								// Rule: notempty
				'message' => 'Highend residential can not be blank',
			),
			
	
			
			
		
);
		
public $belongsTo = array(
       
	'Residental' => array(
            'className'    => 'LookupValueStatus',
            'foreignKey'   => 'builder_residential'
        ),
	'Highend' => array(
            'className'    => 'LookupValueStatus',
            'foreignKey'   => 'builder_highendresidential'
        ),
	'Commercial' => array(
            'className'    => 'LookupValueStatus',
            'foreignKey'   => 'builder_commercial'
        ),
	'City' => array(
	    'fields' => 'city_name',		
            'className'    => 'City',
            'foreignKey'   => 'builder_primarycity'
        ),
    'SecondaryCity' => array(
	    'fields' => 'city_name',		
            'className'    => 'City',
            'foreignKey'   => 'builder_secondarycity'
        ),
	'TertiaryCity' => array(
	    'fields' => 'city_name',		
            'className'    => 'City',
            'foreignKey'   => 'builder_tertiarycity'
        ),
	'City4' => array(
	    'fields' => 'city_name',		
            'className'    => 'City',
            'foreignKey'   => 'city_4'
        ),
	'City5' => array(
	    'fields' => 'city_name',		
            'className'    => 'City',
            'foreignKey'   => 'city_5'
        ),	
		/*				
	'Agreement' => 	array(
						'className'    => 'BuilderAgreement',
						'foreignKey' => false,
						'conditions' => 'Builder.id = Agreement.builder_agreement_builder_id',

		),
	*/	

	'BuilderStatus' => 	array(
            'className'    => 'LookupValueStatus',
            'foreignKey'   => 'builder_status'
        ),
		
	/*'ActionItemBuilder' =>  array(
						'className'    => 'ActionItem',
						'foreignKey' => false,
						'conditions' => 'Builder.id = ActionItemBuilder.builder_id',
						),*/
	'BoardNumber' => 	array(
            'className'    => 'LookupValueLeadsCountry',
            'foreignKey'   => 'builder_boardnumber_code'
        ),						
						
	
	/*				
	'BuilderContact' => array(
					'className'    => 'BuilderContact',
					'foreignKey' => false,
					'conditions' => 'Builder.id = BuilderContact.builder_contact_builder_id',
					),	
	'ContactStatus' =>  array(
						'className'    => 'LookupBuilderContactStatus',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_status = ContactStatus.id',

					),	
	'LookupBuilderContactInitiatedBy' =>  array(
						'className'    => 'LookupBuilderContactInitiatedBy',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_intiated_by_id = LookupBuilderContactInitiatedBy.id',

					),	
	'LookupBuilderContactManagedBy' =>  array(
						'className'    => 'LookupBuilderContactManagedBy',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_managed_by_id = LookupBuilderContactManagedBy.id',

					),	
	'BuilderContactCompanyCity' =>  array(
						'className'    => 'city',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_company_city = BuilderContactCompanyCity.id',

					),
	'LookupBuilderContactPreparedBy' =>  array(
						'className'    => 'LookupBuilderContactPreparedBy',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_prepared_by_id = LookupBuilderContactPreparedBy.id',

					),
	'BuilderContactMobileCode' =>  array(
						'className'    => 'LookupValueLeadsCountry',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_mobile_country_code = BuilderContactMobileCode.id',

					),
	'BuilderContactSecondaryMobileCode' =>  array(
						'className'    => 'LookupValueLeadsCountry',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_secondary_mobile_country_code = BuilderContactSecondaryMobileCode.id',

					),	
	'BuilderContactLanCode' =>  array(
						'className'    => 'LookupValueLeadsCountry',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_lan_no_country_code = BuilderContactLanCode.id',

					),																										
	

					),	
	'BuilderContactLevel' =>  array(
						'className'    => 'LookupBuilderContactLevel',
						'foreignKey' => false,
						'conditions' => 'BuilderContact.builder_contact_level = BuilderContactLevel.id',

					),	
		*/																																	
/*	'PrimaryCode' => array(
					'className'    => 'LookupValueLeadsCountry',
					'foreignKey'   => 'builder_primary_mobile_code'
					),
					
	'SecondaryCode' => array(
					'className'    => 'LookupValueLeadsCountry',
					'foreignKey'   => 'builder_secondary_mobile_code'
					),*/	
															
    );
	
	var $hasMany = array(   
        'BuilderAgreement' => array(
                    'className' => 'BuilderAgreement',
                    'foreignKey' => 'builder_agreement_builder_id',
		  
                    ),
		'BuilderContact' => array(
                    'className' => 'BuilderContact',
					'foreignKey' => 'builder_contact_builder_id',
                    ),	
				
					/*
		'BuilderAgreementContact' => array(
                    'className' => 'BuilderContact',
					'joinTable' => 'builder_agreements',
					'foreignKey' => 'builder_contact_builder_id',
					'associationForeignKey' => 'builder_contact_builder_id',
					'conditions' => 'BuilderAgreementContact.builder_agreement_contact_id = builder_contacts.id',
					'with' => 'BuilderContact',
					//'associationForeignKey' => 'builder_agreement_builder_id',
					
                    ),
					*/					
	);	

	
}
?>