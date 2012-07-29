<?php

/**
 *
 * Roadbees News Model
 *
 * the News model controlls all the datamanipulation for the news newsletter
 *
 * @copyright Copyright (c) 2011, Haithem bel haj <codebility.com>
 * @author Haithem bel haj <haythem.belhaj@gmail.com>
 * @link          http://roadbees.de
 * @since         Roadbees v 0.1
 */

class Newsletter extends NewsletterAppModel {

    /**
    * app-wide  name
    *
    * @var array
    * @access public
    */
	
    public $name = "Newsletter";
    
    var $primaryKey = '_id';


    public $hasAndBelongsToMany = array('Campaign' => array('className' => 'Campaign'));
    
    /**
    * schema
    *
    * @var array
    * @access public
    */

    public $mongoSchema = array(
        'title' =>  array('type'=>'string'),
		'content'=> array('type'=>'string'),
        'campaigns' => array('type' => 'array'),
		'created'=> array('type'=>'datetime'),
		'modified'=> array('type'=>'datetime'),
        'published' => array('type' => 'tinyint')
    );
    
    
    var $validate = array(
		'title' => array(
		    'rule' => 'isUnique',
		    'message' => "Der Title ist schon vergeben"
		)
    );
    
    
    public function incrementCounter(){
    	$counter = $this->field("viewCounter");
    	$this->set("viewCounter", $counter +1);
    	$this->save();
    }

    public function beforeSave(){   
        return true;
    }
    
    
   
}
