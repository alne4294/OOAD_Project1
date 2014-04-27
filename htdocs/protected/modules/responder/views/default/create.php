<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<br>


<h1>Add Patient</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<br>