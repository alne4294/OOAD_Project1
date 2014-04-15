<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Patient
{
	public function __construct() {

        }
        
        public function add($params) {
            
            $command = Yii::app()->db->createCommand();
            
            $command->insert('patient', array(
                'first'=> $params['first'],
                'last'=> $params['last'],
            ));
    
            return true; // Should figure out if insert was successful and only return true if varified as successful.
        }
        
}