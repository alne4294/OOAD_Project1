<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
//$this->breadcrumbs=array(
//	'Login',
//);
?>

<style type="text/css">
.wrapper {
    text-align: center;
}
.divider{
    width:5px;
    height:auto;
    display:inline-block;
}
</style>

<h1>Member's Area</h1>


<div class="wrapper">
<?php echo CHtml::button('Responder Login', array(
    "style"=>"background-color:darkred;color:white;width:140px;height:40px;", 
    'onclick' => 'js:document.location.href="http://snap.colorado.edu/index.php/responder/default/login"')); ?>

<?php echo CHtml::button('Hospital Login', array(
    "style"=>"background-color:darkred;color:white;width:140px;height:40px;", 
    'onclick' => 'js:document.location.href="http://snap.colorado.edu/index.php/hospital/default/login"')); ?>

<?php echo CHtml::button('Administrator Login', array(
    "style"=>"background-color:darkred;color:white;width:140px;height:40px;", 
    'onclick' => 'js:document.location.href="http://snap.colorado.edu/index.php/admin/default/login"')); ?>
</div>

