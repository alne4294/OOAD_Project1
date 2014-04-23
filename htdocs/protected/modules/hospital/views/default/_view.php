<?php
/* @var $this PatientController */
/* @var $data Patient */
?>

<div class="view">

    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
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
                array(
                    'name'=>'last',
                    'value'=>$data->last,
                ),
            ),
    )); ?>
    
    
    

</div>