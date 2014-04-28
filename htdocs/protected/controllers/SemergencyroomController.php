
<?php

class SemergencyroomController extends Controller
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
        
        public function getStartGroupHtml($question) {
            
            $html = "<ul>";
            
            return $html;
        }
        
        public function getEndGroupHtml($question) {
            
            $html = "</ul>";
            
            return $html;
        }
        
        public function getStartHTml($question) {
            
            $id = $question['id'];
            $name = $question['name'];
            
            $html = "
                <li><a id=\"$id\">$name</a>";
            
            return $html;
        }
        
        public function getEndHTml($question) {
            
            $html = "
                </li>";     
            
            return $html;
            
        }
        
        public function actionGetyes($patientId) {
            
            // FOR AJAX CALL, RETURNS JSON.
            
            $patientModel = new Spatient;
            
            $patientsArray = $patientModel->getAnsweredYesQuestionsForPatient($patientId);
            
            $patientsJsonString = json_encode($patientsArray);
                
            echo $patientsJsonString;
            
        }
        
        public function actionShowyes($patientId) {
            
            $errorMessages = array();
            
            $questionModel = new Squestion;

            $questionTreeHtml = $questionModel->buildQuestionTree($this);

            $this->render('questions', array(
                'errorMessages' => $errorMessages,
                'patientId' => $patientId,
                'questionTreeHtml' => $questionTreeHtml
            ));
            
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

}