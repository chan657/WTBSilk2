<?php

App::uses('AppModel', 'Model');

class DigBase extends AppModel {

    public $name = 'DigBase';
    
    public $belongsTo = array(
        'BaseType' => array(
            'className' => 'DigBaseType',            
            'foreignKey' => 'base_type'
        ),
       'DigBaseLinkCategory1' => array(
            'className' => 'DigBaseLinkCategory',            
            'foreignKey' => 'base_link1_category'
        ),
        'DigBaseLinkCategory2' => array(
            'className' => 'DigBaseLinkCategory',            
            'foreignKey' => 'base_link2_category'
        ),
        'DigBaseLinkCategory3' => array(
            'className' => 'DigBaseLinkCategory',            
            'foreignKey' => 'base_link3_category'
        ),
        'DigBaseUsageType' => array(
            'className' => 'DigBaseUsageType',            
            'foreignKey' => 'base_usage'
        ),
        'DigBaseUsageStatus' => array(
            'className' => 'DigBaseUsage',            
            'foreignKey' => 'base_usage_status'
        ),
        'BaseLink1Dofollow' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_link1_dofollow'
        ),
        'BaseLink2Dofollow' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_link2_dofollow'
        ),
        'BaseLink3Dofollow' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_link3_dofollow'
        ),
        'BaseUsedAs1' => array(
            'className' => 'DigBaseType',            
            'foreignKey' => 'base_used_as1'
        ),
        'BaseUsedAs2' => array(
            'className' => 'DigBaseType',            
            'foreignKey' => 'base_used_as2'
        ),
        'BaseUsedAs3' => array(
            'className' => 'DigBaseType',            
            'foreignKey' => 'base_used_as3'
        ),
        'DigBaseTargetGeography' => array(
            'className' => 'DigBaseTargetGeography',            
            'foreignKey' => 'base_target_geography'
        ),
        'DigBaseDofollow' => array(
            'className' => 'DigBaseDofollow',            
            'foreignKey' => 'base_dofollow'
        ),
        'BaseAutoApprove' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_auto_approved'
        ),
        'BaseLoginRequired' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_login_required'
        ),
        'BaseWithinComment' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_link_within_comment'
        ),
        'DigBaseUsedBy' => array(
            'className' => 'Channel',
            'fields' => array('channel_name'),
            'foreignKey' => 'base_used_by'
        ),
        'BasePP' => array(
            'className' => 'DigBaseDaAaClLrLookup',            
            'foreignKey' => 'base_pp'
        ),
    );

}

?>