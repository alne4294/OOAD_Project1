<?php

class ResponderController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
               
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		// $this->render('index');            
	}

	public function actionRecord($patientId)
	{
            
            if(!isset($patientId)) {
                
                echo "No patient ID was provided.";
                
            } else {
                
                $this->render('questions', array(
                    'patientId'=>$patientId,
                ));
            
            }
	}
        
	public function actionAdd()
	{
                
            $addingNewUser = isset($_POST['addingNewUser']) ? $_POST['addingNewUser'] : 'FALSE';

            $params = array();
               
            $params['first'] = isset($_POST['first']) ? $_POST['first'] : '';
            $params['last'] = isset($_POST['last']) ? $_POST['last'] : '';

            if($addingNewUser == 'TRUE') {
               
               $model = new Patient;
               $success = $model->add($params);
                  
               if($success) {
                   echo "Success!!";
               } else {
                   echo "Failed";
               }
                
            } else {
                
                $this->render('add');
                
            }
                         
	}
        
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        
        /**
         * This is what the responder will see upon
         * logging in.
         */
        public function actionSubmissions()
        {   
            $this->render(submissions);
             
        }
        
        public function getPatient($patientOrder)
        {
            
        }
}