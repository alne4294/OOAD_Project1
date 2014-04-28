<?php

class DefaultController extends Controller
{
    
    	public $layout='/layouts/column2';
        //public $menu=array();

        public function actionIndex()
	{
            
            $model=$this->loadModel($id);
            
            $dataProvider=new CActiveDataProvider(Patient::model(), array(
                    'keyAttribute'=>'id',//needed for gridview to know selection?
                    'pagination'=>array(
                            'pageSize'=>20,
                    ),
                    'sort'=>array(
                            'defaultOrder'=>array('timestamp'=>true),
                    ),
            ));
            
            //$dataProvider->unsetAttributes();
            
            if(isset($_GET['Patient']))
                $dataProvider->attributes=$_GET['Patient'];
	    
            $this->render('index', array(
                'model'=>$model, 'dataProvider'=>$dataProvider));
	}
        
         /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Patient the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		if($id==null)
                    $id=2;
                $model=Patient::model()->findByPk($id);
		if($model===null)
                    //$model=$dataProvider;
                    throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionPartUpdate($id = null) {
            $model = Patient::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');

            $this->renderPartial('_view', array('model' => $model));
            Yii::app()->end();
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
                                Yii::app()->user->setReturnUrl('index');
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