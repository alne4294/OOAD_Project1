<?php
/* @var $this PatientController */
/* @var $data Patient */
?>

<div class="view">
    
    <br>
    <h2> ID# <?php echo $model->id;?>: <?php echo $model->last;?>, <?php echo $model->first;?></h2>

    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'cssFile' => Yii::app()->theme->baseUrl . '/css/hospitaldvstyles.css',
//            'htmlOptions'=>array('width'=>'40px'),
            'attributes'=>array(
                    'id',
                    'name',
                    'last',
                    'first',
                    'dob',
                    'phone_primary',
                    'phone_secondary',
                    'phone_emergency',
                    'address',
                    'city',
                    'state',
                    'zip',
                    'country',
                    'timestamp',
            ),
    )); ?>
    
    
    

</div>