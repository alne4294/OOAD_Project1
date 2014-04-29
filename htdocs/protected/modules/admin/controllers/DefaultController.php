<?php

class DefaultController extends Controller
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
                <li>
                    <input type=\"text\" name=\"update[$id]\" value=\"$name\" /> 
                    | <input type=\"checkbox\" name=\"delete[]\" value=\"$id\"/> Delete
                    | Add Child: <input type=\"text\" name=\"add[$id]\" value=\"\" />";
            
            return $html;
        }
        
        public function getEndHTml($question) {
            
            $html = "
                </li>";     
            
            return $html;
            
        }
        
	public function actionManageQuestions()
	{
            // This method functions as a router.
            
            $questionModel = new Squestion;

            if(isset($_POST['newTopLevelName']) && $_POST['newTopLevelName'] != '') {
                $success = $questionModel->addTopLevel($_POST['newTopLevelName']); // $name is the text of the question
            }
            
            if(is_array($_POST['update']) && count($_POST['newTopLevelName']) > 0) {
                foreach($_POST['update'] as $id => $name) {
                    $success = $questionModel->updateQuestion($id, $name);
                }
            }
            
            if(is_array($_POST['delete']) && count($_POST['delete']) > 0) {
                foreach($_POST['delete'] as $id) {
                    $success = $questionModel->deleteQuestion($id);
                }
            }
            
            if(is_array($_POST['add']) && count($_POST['add']) > 0) {
                foreach($_POST['add'] as $parent => $name) {
                    if(trim($name) != '') {
                        $success = $questionModel->addQuestion($parent, $name);
                    }
                }
            }
            
            $questionTreeHtml = $questionModel->buildQuestionTree($this);
            
            // Always view questions after performing actions.
            $this->render('questions', array(
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

        
                	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                                Yii::app()->user->setReturnUrl('managequestions');
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}