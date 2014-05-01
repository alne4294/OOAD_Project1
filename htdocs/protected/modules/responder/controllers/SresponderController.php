<?php

class SresponderController extends Controller
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
        
	public function actionUploadphoto()
        {
            
            define("IMAGE_SAVE_LOCATION", '/var/www/htdocs/images/patient_photos/');
            define("IMAGE_EXTENSION", '.jpg');

            $errorMessages = array();

            if(isset($_POST['patientId']) && $_POST['patientId'] != '') {
                
                $patientId = $_POST['patientId'];

                $newImagePath = IMAGE_SAVE_LOCATION .  $_POST['patientId'] . IMAGE_EXTENSION;

                // Move image from where Apache automatically puts it into a new location where browser can retrieve it by patientId.
                $imageMoveStatus = rename($_FILES['file']['tmp_name'], $newImagePath);

                if(!$imageMoveStatus) {
                    $errorMessages[] = "Image failed to upload image.";
                }
            } else {
                $errorMessages[] = "No patientId was given image upload.";
            }
            
            $response = $this->showQuestions($errorMessages, $patientId);

            echo $response;
            
	}
        
	public function actionRecord()
        {
            
            // USER TO SEE QUESTIONS IN A WEB PAGE. RETURNS HTML.
            
            $params = array();
            
            $action = isset($_POST['action']) ? $_POST['action'] : null;
            $patientId = isset($_POST['patientId']) ? $_POST['patientId'] : null;
            $questionId = isset($_POST['questionId']) ? $_POST['questionId'] : null;

            $errorMessages = array();
            
            if(!isset($action)) {
                $errorMessages[] = "No patient action was provided.";
            }
            
            if(!isset($patientId)) {
                $errorMessages[] = "No patient ID was provided.";
            }
            
            if(!isset($questionId)) {
                $errorMessages[] = "No question id was provided.";
            }

            switch ($action) {
                
                case 'VIEW-MARKED-QUESTIONS':
                                        
                    $response = $this->showQuestions($errorMessages, $patientId);
                    
                    break;
                
                case 'MARK-YES':
                    
                    $response = $this->markQuestionYesForPatient($_POST['patientId'], $_POST['questionId']);
                    
                    break;
                
                case 'REMOVE-YES-MARK':
                    
                    $response = $this->removeYesForPatient($patientId, $questionId);
                        
                    break;
                
                default:
                    
                    $response = $this->showQuestions($errorMessages, $patientId);
                    
                    break;
            }
                        
            echo $response;
            
	}
        
        private function showQuestions($errorMessages, $patientId) {
            
            $questionModel = new Squestion;

            $questionTreeHtml = $questionModel->buildQuestionTree($this);

            $this->render('questions', array(
                'errorMessages' => $errorMessages,
                'patientId' => $patientId,
                'questionTreeHtml' => $questionTreeHtml
            ));
            
        }
        
        private function markQuestionYesForPatient($patientId, $questionId)
        {
            
            $patientModel = new Spatient;
            
            $response = $patientModel->markQuestionYesForPatient($patientId, $questionId);
            
            return $response;
           
        }
        
        private function removeYesForPatient($patientId, $questionId) 
        {

        }
        
	public function actionAddPatient()
	{
            
            $addingNewUser = isset($_POST['addingNewUser']) ? $_POST['addingNewUser'] : 'FALSE';

            $params = array();
            
            $params['first'] = isset($_POST['first']) ? $_POST['first'] : '';
            $params['last'] = isset($_POST['last']) ? $_POST['last'] : '';

            if($addingNewUser == 'TRUE') {
               
               $model = new Patient;
               $success = $model->add($params);
                  
               if($success) {
                   echo "Success!";
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

}