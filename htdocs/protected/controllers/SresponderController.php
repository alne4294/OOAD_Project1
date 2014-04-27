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
        
        public function getStartGroupHtml() {
            
            $html = "<ul>";
            
            return $html;
        }
        
        public function getEndGroupHtml() {
            
            $html = "</ul>";
            
            return $html;
        }
        
        public function addHtmlToQuestion($question) // $name is the text of the question
        {
            $id = $question['id'];
            $name = $question['name'];
            
            $html = "
                <li>
                    <input type=\"text\" name=\"update[$id]\" value=\"$name\" /> 
                    | <input type=\"checkbox\" name=\"delete[]\" value=\"$id\"/> Delete
                    | Add Child: <input type=\"text\" name=\"add[$id]\" value=\"\" />  
                </li>";
            
            $html2 = "
                <li>
                    $name  
                </li>";
            
            return $html;
        }
        
	public function actionRecord()
        {
            
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
                                        
                    $this->showQuestions($errorMessages, $patientId);
                    
                    break;
                
                case 'MARK-YES':
                    
                    markQuestionYesForPatient($patientId, $questionId);

                    break;
                
                case 'REMOVE-YES-MARK':
                    
                    markRemoveYesForPatient($patientId, $questionId);
                        
                    break;
                
                default:
                    
                    $this->showQuestions($errorMessages, $patientId);
                    
                    break;
            }
            
	}
        
        public function showQuestions($errorMessages, $patientId) {
            
            // $questionTreeHtml = $questionModel->buildQuestionTree($this);

            $this->render('questions', array(
                'errorMessages' => $errorMessages,
                'patientId' => $patientId
                // 'questionTreeHtml' => $questionTreeHtml
            ));
            
        }
        
        public function markQuestionYesForPatient($patientId, $questionId)
        {
            
        }
        
        public function markRemoveYesForPatient($patientId, $questionId) 
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