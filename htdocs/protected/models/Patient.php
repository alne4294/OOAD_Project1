<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Patient
{
	public function __construct() {
            error_log("inside model constructor \n", 3, '/tmp/log.txt');
        }
        
        public function add($params) {
            error_log("inside add function of model\n", 3, '/tmp/log.txt');
        }
        
}