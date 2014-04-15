<?php

class DefaultController extends CController
{
    
    	public $layout='/layouts/column1';
	
        public function actionIndex()
	{
		$this->render('index');
	}
}