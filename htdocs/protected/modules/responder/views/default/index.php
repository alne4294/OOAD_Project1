<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<h2>Recent Submissions</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patient-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', value=>'$data->id','htmlOptions'=>array('width'=>'25px')),
//		'name',
                array('name'=>'timestamp','value'=>'$data->timestamp','htmlOptions'=>array('width'=>'80px')),
                array('name'=>'last','value'=>'$data->last'),
                array('name'=>'first','value'=>'$data->first',),
//		'phone_primary',
		/*
		'phone_secondary',
		'phone_emergency',
		'address',
		'city',
		'state',
		'zip',
		'country',
		'timestamp',
		*/
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
//                    'htmlOptions'=>array('style'=>'width:5px'),
		),
	),
)); ?>