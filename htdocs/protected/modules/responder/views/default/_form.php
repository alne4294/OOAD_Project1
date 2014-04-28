<?php
/* @var $this PatientController */
/* @var $model Patient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'last'); ?>
		<?php echo $form->textField($model,'last',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'last'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first'); ?>
		<?php echo $form->textField($model,'first',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'first'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Date of Birth'); ?>
		<?php echo $form->textField($model,'dob',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_primary'); ?>
		<?php echo $form->textField($model,'phone_primary',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone_primary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_secondary'); ?>
		<?php echo $form->textField($model,'phone_secondary',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone_secondary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_emergency'); ?>
		<?php echo $form->textField($model,'phone_emergency',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone_emergency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->