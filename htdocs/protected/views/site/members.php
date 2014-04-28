<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
//$this->breadcrumbs=array(
//	'Login',
//);
?>

<h1>Member's Area</h1>

<?php echo CHtml::button('Responder Login', array('onclick' => 
    'js:document.location.href="http://snap.colorado.edu/index.php/responder/default/login"')); ?>
<br>
<?php echo CHtml::button('Hospital Login', array('onclick' => 
    'js:document.location.href="http://snap.colorado.edu/index.php/hospital/default/login"')); ?>
<br>
<?php echo CHtml::button('Administrator Login', array('onclick' => 
    'js:document.location.href="http://snap.colorado.edu/index.php/admin/default/login"')); ?>


