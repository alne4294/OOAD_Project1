
<?php
$this->pageTitle=Yii::app()->name;
?>


<div id="frameLeft">
     
    <script type="text/javascript">
    function updateABlock(grid_id) {
        
        var keyId = $.fn.yiiGridView.getSelection(grid_id);
        keyId  = keyId[0]; //above function returns an array with single item, so get the value of the first item
 
        $.ajax({
            url: 'http://snap.colorado.edu/index.php/hospital/default/PartUpdate/id/'+keyId,
            type: 'GET',
            success: function(data) {
                $('#frameRight').html(data);
                
                $.ajax({
                    url: 'http://snap.colorado.edu/index.php/hospital/default/ImageUpdate/id/'+keyId,
                    type: 'GET',
                    success: function(imageData) {
                        $('#frameSecondMiddle').html(imageData);
                        
                        var request = $.ajax({
                            url: 'http://snap.colorado.edu/index.php/hospital/default/showyes?patientId='+keyId,
                            type: 'GET',
                            success: function(questionData) {
                                $('#frameMiddle').html(questionData);
                            }
                        });
        //              request.abort();
                    }
                });
                
            }
        });
        
        document.getElementById("content").innerHTML = response.html;
        document.title = response.pageTitle;
        window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
    }
    </script>
    
    <FORM>
    <INPUT TYPE="button" style="background-color:lightgray" onClick="history.go(0)" VALUE="Reset Form">
    </FORM>
    
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
            'selectionChanged'=>'updateABlock',
        ));
    ?>
</div>

<div id="frameSecondMiddle">
    <!--<h2>Hi there</h2>-->
    
</div>

<div id="frameMiddle">
    <!--<h2>Hi there</h2>-->
    
</div>

<div id="frameRight">
    
<!--    <br>
    <h2>ID# </h2>-->
    
    <?php 
//    $this->widget('zii.widgets.CDetailView', array(
//            'data'=>$dataProvider,
//        'cssFile' => Yii::app()->theme->baseUrl . '/css/hospitaldvstyles.css',
////            'htmlOptions'=>array('width'=>'40px'),
//            'attributes'=>array(
//                    'id',
//                    'name',
//                    'last',
//                    'first',
//                    'dob',
//                    'phone_primary',
//                    'phone_secondary',
//                    'phone_emergency',
//                    'address',
//                    'city',
//                    'state',
//                    'zip',
//                    'country',
//                    'timestamp',
//            ),
//    )); ?>
</div>