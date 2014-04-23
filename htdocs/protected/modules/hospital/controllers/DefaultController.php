<?php

class DefaultController extends CController
{
    
    	public $layout='/layouts/column1';

        public function actionIndex()
	{
            
            $model=$this->loadModel($id);
            //$dataProvider=new Patient();
            
           /*if(Yii::app()->request->isAjaxRequest){
               echo "I'm here!!!"; 
               $id = $_GET[0];
                $model=$this->loadModel($id);
                //$dataProvider->criteria = array('condition'=>'id='.$id);
                echo CJSON::encode($model);
            }*/
            
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
        
        public function actionObtainPatientInfo($id){
		//$response = Patient::model()->findAllByAttributes(array('id'=>$id));
                $model=$this->loadModel($id);
		header("Content-type: application/json");
		//echo CJSON::encode($model);

                $newmodel = CJSON::encode($model);
                $array = json_decode($newmodel, true);
                var_dump($array);
                /*
                //$this->render('index',array(
		//	'model'=>$model,
		//));
                
                return CJSON::encode($model);*/
	}
}