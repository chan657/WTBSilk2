<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

    //public $virtualFields = array('fname_lname' => 'concat(User.fname, "-", User.lname)');

    var $name = 'User';
    var $validate = array
        (
        /* 'username' => array(												// Field: username
          'notempty' => array(											// Identifier name: notempty
          'rule' => array('notempty'),								// Rule: notempty
          'message' => 'Please enter username',
          //'allowEmpty' => false,
          //'required' => false,
          //'last' => false, // Stop validation after this rule
          //'on' => 'update', // Limit validation to 'create' or 'update' operations
          ),

          'validChars' => array(
          'rule'    => '/^[a-z0-9]{6,}$/i',
          'message' => 'Username should only contain letters and number, min 6 characters'
          ),


          'usernameLength' => array('rule' => array('between', 6, 20),'message' => 'Username must be between 6-20 chars'),

          'isUnique' => array (
          'rule' => 'isUnique',
          'message' => 'This username already exists.'

          ),

          ), */

        /* 'password' => array(
          'notempty' => array(											// Identifier name: notempty
          'rule' => array('notempty'),								// Rule: notempty
          'message' => 'Please enter password',
          'allowEmpty' => false,
          'required' => true,
          //'last' => false, // Stop validation after this rule
          //'on' => 'update', // Limit validation to 'create' or 'update' operations
          ),
          'passwordLength' => array('rule' => array('between', 6, 30),'message' => 'Password  must be between 6-30 chars'),


          ), */



        /* 'confirm_password' => array(
          'notempty' => array(											// Identifier name: notempty
          'rule' => array('notempty'),								// Rule: notempty
          'message' => 'Please enter confrm password',
          'allowEmpty' => false,
          'required' => true,
          //'last' => false, // Stop validation after this rule
          'on' => 'update', // Limit validation to 'create' or 'update' operations
          ),

          //'checkPassword' => array(
          //				'rule' => array('checkPassword'),
          //				'message' => 'Password and confirm password mismatch.',
          //				'on' => 'update'
          //			),

          'passwordLength' => array('rule' => array('between', 6, 30),'message' => 'Password  must be between 6-30 chars'),
          //'passwordequal' => array('checkpasswords', 'message' => 'Passwords do not match')
          ), */


        'fname' => array(// Field: first_name
            'notempty' => array(// Identifier name: notempty
                'rule' => array('notempty'), // Rule: notempty
                'message' => 'Please enter first name',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        /*
          'validChars' => array(
          'rule'    => '/^[a-z. ]{2,}$/i',
          'message' => 'First name should only contain letters and dot(.), min 3 characters'
          ),
         */
        ),
        /*
          'fname' => array(												// Field: first_name
          'validChars' => array(
          'rule'    => '/^[a-z. ]{2,}$/i',
          'message' => 'Middle name should only contain letters and dot(.)'
          ),

          ),
         */
        'lname' => array(// Field: last_name
            'notempty' => array(// Identifier name: notempty
                'rule' => array('notempty'), // Rule: notempty
                'message' => 'Please enter last name',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        /*
          'validChars' => array(
          'rule'    => '/^[a-z. ]{2,}$/i',
          'message' => 'Last name should only contain letters and dot(.), min 3 characters'
          ),
         */
        ),
        'sex' => array(// Field: group_id
            'notempty' => array(// Identifier name: notempty
                'rule' => array('notempty'), // Rule: notempty
                'message' => 'Please select gender',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'company_email_id' => array(
            'idRule-1' => array(
                'on' => 'create',
                'rule' => 'uniqueUserEmail',
                'message' => 'This e-mail address already exists.',
                'last' => false
            ),
            'idRule-2' => array(
                'on' => 'create',
                'rule' => array('email'),
                'message' => 'Please enter a valid email address.',
                'last' => false
            ),
            'idRule-3' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a email address.',
                'last' => false
            ),
        ),
        /*
          'personal_email_id' => array(													// Field: email
          'validEmail' => array(												// Identifier name: email
          'rule' => array('email'),									// Rule: email
          'message' => 'Please enter a valid email address',
          'allowEmpty' => true,
          'required' => false,
          //'last' => false, // Stop validation after this rule
          //'on' => 'create', // Limit validation to 'create' or 'update' operations
          ),

          'isUniqueEmail' => array (
          'rule' => 'isUnique',
          'message' => 'This e-mail address already exists.'
          ),
          ),
         */
        'primary_mobile_number' => array(// Field: group_id
            'notempty' => array(// Identifier name: notempty
                'rule' => array('notempty'), // Rule: notempty
                'message' => 'Primary mobile number canot be blank',
            ),
        ),
    );

    public function uniqueUserEmail() {
        return ($this->find('count', array('conditions' => array('User.company_email_id' => $this->data['User']['company_email_id']))) == 0);
    }

    public function Username($user_id) {
        $user = $this->find('first', array('fields' => array('fname', 'mname', 'lname'), 'conditions' => array('User.id' => $user_id)));
        return $user['User']['fname'] . ' ' . $user['User']['mname'] . ' ' . $user['User']['lname'];
    }

    public function GetRealEasteEmail($user_id) {
        $user = $this->find('first', array('fields' => array('realestate_email'), 'conditions' => array('User.id' => $user_id)));
        return $user['User']['realestate_email'];
    }
    public function GetCompanyEmail($user_id) {
        $user = $this->find('first', array('fields' => array('company_email_id'), 'conditions' => array('User.id' => $user_id)));
        return $user['User']['company_email_id'];
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    var $belongsTo = array('Role', 'City',
        'PrimaryCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'primary_country_code'
        ),
        'SecondaryCode' => array(
            'className' => 'LookupValueLeadsCountry',
            'foreignKey' => 'secondary_country_code'
        ),
    );

    function checkPassword() {
        //echo $this->data['User']['password']." - ".$this->data['User']['confirm_password'];
        //echo strcmp($this->data['User']['password'],$this->data['User']['confirm_password']);
        //exit;
        if (strcmp($this->data['User']['password'], $this->data['User']['confirm_password']) == 0)
            return 0;
        else
            return -1;

        //return strcmp($this->data['User']['password'],$this->data['User']['confirm_password']);
    }

 

    /**

      405

     * Get the parent node

      406

     *

      407

     * reads the parent id and returns this node

      408

     *

      409

     * @param Model $Model Model instance

      410

     * @param integer|string $id The ID of the record to read

      411

     * @param string|array $fields

      412

     * @param integer $recursive The number of levels deep to fetch associated records

      413

     * @return array|boolean Array of data for the parent node

      414

     * @link http://book.cakephp.org/2.0/en/core-libraries/behaviors/tree.html#TreeBehavior::getParentNode

      415

     */
}

?>