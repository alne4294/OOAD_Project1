
<?php
$this->pageTitle=Yii::app()->name;
?>


<div id="frameLeft">
     
    <script type="text/javascript">
    function updateABlock(grid_id) {
 
        var keyId = $.fn.yiiGridView.getSelection(grid_id);
        keyId  = keyId[0]; //above function returns an array with single item, so get the value of the first item
 
        $.ajax({
//            url: '<?php echo $this->createUrl('PartUpdate'); ?>',
            url: 'http://snap.colorado.edu/index.php/hospital/default/PartUpdate/id/'+keyId,
//            data: {id: keyId},
            type: 'GET',
            success: function(data) {
                $('#frameRight').html(data);
            }
        });
    }
    </script>
    
    <br>
    <h5><em>Select row for detail view</em></h5>
    
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
                array('name'=>'dob','value'=>'$data->dob','htmlOptions'=>array('width'=>'100px')),
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
            'selectionChanged'=>'updateABlock',//selectRow,//'CHtml::link(CHtml::encode($data->id), array(\'index\', \'id\'=>$data->id))',//
        ));
    ?>
</div>

<div id="frameRight">
    
    <br>
    <h2>ID# </h2>
    
    <?php 
    $this->widget('zii.widgets.CDetailView', array(
            'data'=>$dataProvider,
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