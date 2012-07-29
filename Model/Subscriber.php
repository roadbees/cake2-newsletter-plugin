<?php

/**
 *
 * Roadbees Subscriber Model
 *
 * the Subscriber model for the emaillist
 *
 * @copyright Copyright (c) 2011, Haithem bel haj <codebility.com>
 * @author Haithem bel haj <haythem.belhaj@gmail.com>
 * @link          http://roadbees.de
 * @since         Roadbees v 0.1
 */

class Subscriber extends NewsletterAppModel {

    /**
    * app-wide  name
    *
    * @var array
    * @access public
    */
	
    public $name = "Subscriber";
       
    /**
     *
     * @var string primarykey for mongodb
     */
    public  $primaryKey = '_id';
	
    /**
    * schema
    *
    * @var array
    * @access public
    */
    public $mongoSchema = array( 
        'email' => array('type' => 'string'),
        'campaigns' => array('type' => 'array'),
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime') 
    );
    
    
    public $validate = array(
        'email' => array('rule' => 'email','message' => "Bitte richtige Email eingeben"),
        'email'=> array('rule' => 'isUnique','message' => "Diese Email ist schon vergeben")
    );
    
    public function beforeSave(){
        //debug($this->data);
        $this->schema(true);
        return true;
    }

    
    
}
