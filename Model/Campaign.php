<?php

/**
 *
 * Roadbees Campaign Model
 *
 * the News model controlls all the datamanipulation for the news newsletter
 *
 * @copyright Copyright (c) 2011, Haithem bel haj <codebility.com>
 * @author Haithem bel haj <haythem.belhaj@gmail.com>
 * @link          http://roadbees.de
 * @since         Roadbees v 0.1
 */

class Campaign extends NewsletterAppModel {
	
	/**
	 *
	 *
	 *
	 */
	public $name = "Campaign";
	
	public $primaryKey = '_id';
	
	public $actsAs = array('Mongodb.SqlCompatible');
	
	 /**
	 *
	 *
	 */
	
	public $mongoSchema = array(
			'name' => array('type'=>'string'),
			'description' => array('type'=>'text'),
			'active' =>  array('type'=>'tinyint')			
	);
	
	/**
	 *
	 *
	 *
	 */
	public $validate = array(
		"name" => array(
					'rule' => 'notEmpty',
					'message' => 'Bitte gib ein Alias ein'
						),
		"name" => array(
					'rule' => 'isUnique',
					'message' => "Dieser Name ist schon vergeben"
								
					)
				);
}