<?php

$this->pageTitle=Yii::app()->name . ' - Answer Medical Questions About Patient';
$this->breadcrumbs=array(
	'Add Patient',
);
?>

<h1>Add Patient</h1>

<form method="post" action="#">
    
    <input type="hidden" name="addingNewUser" value="TRUE" />
    
    First <input type="text" name="first" />
    <br />
    Last <input type="text" name="last" />
    <br />
    
    <input type ="submit" value="Add Patient" />
           
</form>

