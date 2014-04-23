
<div id="frameLeft">
    
    
     <script type="text/javascript">
        function selectRow(target_id) {
            alert($.fn.yiiGridView.getSelection(target_id));
            
            var id = $.fn.yiiGridView.getSelection(target_id);
            //$.fn.yiiGridView.update('patient',{ data: target_id });
            
            var action='index.php/hospital/default/id/'+id;
            /*
            $.getJSON(action, function(data) {
                alert(data.id);
                alert(data.last);
                $('#frameRight').html('<p> Name: ' + data.id + '</p>');
                $('#frameRight').append('<p>Last : ' + data.last+ '</p>');

            });*/
        }
    </script>  

    
    
    <?php
        $this->widget('zii.widgets.grid.CGridView',array(
            'id'=>'myGrid',
            'selectableRows'=>1,            
            'dataProvider'=>$dataProvider,
            //'filter'=>$model,
            'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'columns'=>array(
                array('name'=>'id', value=>'$data->id','htmlOptions'=>array('width'=>'40px')),
                array('name'=>'timestamp','value'=>'$data->timestamp','htmlOptions'=>array('width'=>'150px')),
                array('name'=>'last','value'=>'$data->last'),
                array('name'=>'first','value'=>'$data->first',),
                array('name'=>'dob','value'=>'$data->dob',),
                /*array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{received}{treated}',//View, Mark received, Mark treated
                    'view'=>array(
                             'url'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
                             //'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                             ),
                   'delete'=>array(
                             'url'=>'$this->grid->controller->createUrl("/History/delete", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                             ),
                 ),*/
            ),
            'selectionChanged'=>selectRow,//'CHtml::link(CHtml::encode($data->id), array(\'index\', \'id\'=>$data->id))',//
        ));
    ?>
</div>

<div id="frameRight">


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